<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookDestroyRequest;
use App\Http\Requests\BookRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return BookCollection
     */
    public function index(Request $request): BookCollection
    {
        $search = $request->query->get('search');
        $books = Book::query()
            ->where('book_name','like','%' . $search . '%')
            ->get();
        return new BookCollection($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookRequest $request
     * @return BookResource
     */
    public function store(BookRequest $request): BookResource
    {
        $book = new Book();
        $book->fill($request->all());
        $book->booker_id = Auth::id();
        $book->save();

        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return BookResource
     */
    public function show(Book $book): BookResource
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookUpdateRequest $request
     * @param Book $book
     * @return BookResource
     */
    public function update(BookUpdateRequest $request, Book $book): BookResource
    {
        $book->fill($request->all());
        $book->save();

        return new BookResource($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BookDestroyRequest $request
     * @param Book $book
     * @return BookResource
     */
    public function destroy(BookDestroyRequest $request,Book $book): BookResource
    {
        $book->delete();
        return new BookResource($book);
    }
}
