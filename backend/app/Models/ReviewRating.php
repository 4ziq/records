<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewRating extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewRatingFactory> */
    use HasFactory;

    protected $fillable = [
        'rating',
        'review'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
