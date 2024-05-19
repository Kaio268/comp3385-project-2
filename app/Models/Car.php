<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    // Define the relationship with the User model for favorited cars
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favourites', 'car_id', 'user_id');
    }
}
