<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogerInterst extends Model
{
    use HasFactory;
    protected $fillable = [
        'bloger_id',
        'category_id'
    ];

}
