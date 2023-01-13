<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminEvents extends Model
{
    use HasFactory;

    public function admins()
    {
        return $this->belongsTo(Admins::class);
    }

    public function event_categories()
    {
        return $this->belongsTo(EventCategories::class);
    }
}
