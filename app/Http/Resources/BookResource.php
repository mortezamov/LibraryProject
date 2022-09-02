<?php

namespace App\Http\Resources;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Book $book */
        $book = $this->resource;
        $data = Arr::only($book->toArray(), [
            'id',
            'book_name',
            'booker_id',
            'borrowed',
        ]);
        return $data;
    }
}
