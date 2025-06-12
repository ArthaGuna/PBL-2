<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setelan extends Model
{
    use HasFactory;

    protected $table = 'setelans';

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];
}
