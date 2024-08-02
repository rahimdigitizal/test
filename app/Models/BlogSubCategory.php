<?php

namespace App\Models;

use App\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSubCategory extends Model
{
    use HasFactory;

    public function blogs(){
        $this->hasMany(Blog::class);
    }
    public function blog_category(){
        $this->belongsTo(Category::class);
    }
}
