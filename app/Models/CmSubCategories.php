<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmSubCategories extends Model
{
    use HasFactory;
    protected $table='cm_sub_categories';
    protected $primaryKey='id';
    public function cmCategories()
    {
        return $this->belongsTo(CmCategories::class);
    }
    public function commonMistakes()
    {
        return $this->hasMany(CommonMistakes::class);
    }
}
