<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
       protected $fillable = [
        'name',
        'price',
        'status',
        'type',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query)
    {
        if (request('name')) {
            $query->where('name', request('name'));
        }

        if (request('user_id')) {
            $query->where('user_id', request('user_id'));
        }

        return $query;
    }

}
