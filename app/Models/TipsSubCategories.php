<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipsSubCategories extends Model
{
    use HasFactory;
    protected $table='tips_sub_categories';
    protected $primaryKey='id';
    public function tipsCategories()
    {
        return $this->belongsTo(TipsCategories::class);
    }
    public function tips()
    {
        return $this->hasMany(Tips::class);
    }
}
