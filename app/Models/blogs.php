<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blogs extends Model
{
    use HasFactory;

    public function blog_categories()
    {
        return $this->belongsTo(blogCategories::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class,'blogs_tags','blogs_id','tags_id');
    }
}
