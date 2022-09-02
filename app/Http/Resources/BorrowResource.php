<?php

namespace App\Http\Resources;

use App\Models\Borrow;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class BorrowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Borrow $borrow */
        $borrow = $this -> resource;
        $data = Arr::only($borrow->toArray(), [
            'id',
            'booker_id',
            'book_id',
            'borrow_date',
            'should_return_at',
            'borrow_back_date',
        ]);
        return $data;
    }
}
