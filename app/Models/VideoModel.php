<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoModel extends Model
{
    use HasFactory;
    protected $table='video';
    protected $primary_key='id';

    public function tutorials_categories()
    {
        return $this->belongsTo(TutorialsCategories::class);
    }
}
