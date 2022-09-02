<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int|mixed|string|null $booker_id
 */
class Borrow extends Model
{
    use HasFactory;

    protected $fillable = ['book_id'];
    protected $dates = ['should_return_at','borrow_date'];

    public function booker(): BelongsTo
    {
        return $this->belongsTo(Booker::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
