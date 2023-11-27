<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'photo',
        'status',
    ];

    public function userblog()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_blog');
    }
}
