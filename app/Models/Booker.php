<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booker extends Model
{
    use HasFactory;

    /**
     * @var \Illuminate\Support\Carbon|mixed
     */
    protected $fillable = ['full_name','Email'];

    public function books(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Book::class,'booker_id');
    }


    public function borrow(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Borrow::class);
    }
}
