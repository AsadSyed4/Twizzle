<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipsCategories extends Model
{
    use HasFactory;
    protected $table='tips_categories';
    protected $primaryKey='id';
    public function tipsSubCategories()
    {
        return $this->hasMany(TipsSubCategories::class);
    }
    public function tips()
    {
        return $this->hasMany(Tips::class);
    }
}
