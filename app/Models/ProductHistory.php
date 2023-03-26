<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{
    use HasFactory;


    protected $fillable = [
        'product_id',
        'user_id',
        'prev_value',
        'new_value',
    ];
}
