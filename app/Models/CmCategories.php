<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmCategories extends Model
{
    use HasFactory;
    protected $table='cm_categories';
    protected $primaryKey='id';
    public function cmSubCategories()
    {
        return $this->hasMany(CmSubCategories::class);
    }
    public function commonMistakes()
    {
        return $this->hasMany(CommonMistakes::class);
    }
}
