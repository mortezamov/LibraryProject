<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BorrowRequest;
use App\Http\Resources\BorrowCollection;
use App\Http\Resources\BorrowResource;
use App\Jobs\SendAlertEmailJob;
use App\Jobs\SendBorrowBackEmailJob;
use App\Jobs\SendBorrowEmailJob;
use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return BorrowCollection
     */
    public function index(): BorrowCollection
    {
        return new BorrowCollection(Borrow::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BorrowRequest $request
     * @return BorrowResource
     */
    public function store(BorrowRequest $request): BorrowResource
    {
        $book = Book::query()
            ->where('id',$request->book_id)
            ->first();

        if($book->borrowed)
        {
            throw new NotFoundHttpException('This book already borrowed.');
        }
        $book->borrowed = true;
        $book->save();

        $borrow = new Borrow();
        $borrow->fill($request->all());
        $borrow->booker_id = Auth::id();
        $borrow->borrow_date = now();
        $borrow->should_return_at = now()->addDays($request->days_counts)->endOfDay();
        $borrow->save();

        dispatch(new SendBorrowEmailJob($borrow->id))->delay(now()->addSeconds(10));
        dispatch(new SendAlertEmailJob($borrow->id))->delay($borrow->should_return_at->subHours(4));

        return new BorrowResource($borrow);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return BorrowCollection
     */
    public function show($id): BorrowCollection
    {
        $book = Book::find($id);
        $borrow = Borrow::query()
            ->where('book_id',$book->id)
            ->get();

        return new BorrowCollection($borrow);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BorrowRequest $request
     * @param Borrow $borrow
     * @return BorrowResource
     */
    public function update(BorrowRequest $request,Borrow $borrow): BorrowResource
    {
        $borrow->fill($request->all());
        $borrow->should_return_at = ($borrow->borrow_date)->addDays($request->days_counts)->endOfDay();
        $borrow->save();

        return new BorrowResource($borrow);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Borrow $borrow
     * @return BorrowResource
     */
    public function destroy(Borrow $borrow): BorrowResource
    {
        $borrow->delete();

        return new BorrowResource($borrow);
    }

    public function return_book(Borrow $borrow): BorrowResource
    {
        if($borrow->borrow_back_date){
            throw new NotFoundHttpException('This book already returned');
        }

        $borrow->borrow_back_date = now();
        $borrow->save();
        $book = $borrow->book;
        $book->borrowed = false;
        $book->save();

        dispatch(new SendBorrowBackEmailJob($borrow->id))->delay(now()->addSeconds(10));
        return new BorrowResource($borrow);
    }
}
