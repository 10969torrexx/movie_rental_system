<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rents extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 
        'movie_id', 
        'quantity',
        'total_price',
        'payment',
        'change',
        'from',
        'until',
    ];
}
