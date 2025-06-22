<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chatbot extends Model
{
    protected $fillable = [
        'keyword',
        'answer'
    ];

    protected $casts = [
        'keyword' => 'array'
    ];
}
