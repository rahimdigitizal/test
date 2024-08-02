<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    public function blogs(){
        $this->hasMany(Blog::class);
    }

    public function blog_sub_categories(){
        $this->hasMany(BlogSubCategory::class);
    }
}
