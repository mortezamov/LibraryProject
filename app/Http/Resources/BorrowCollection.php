<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable as ArrayableAlias;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class BorrowCollection extends ResourceCollection
{
    public $collection = BorrowResource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => parent::toArray($request),
            'message' => 'salam'
        ];
    }
}
