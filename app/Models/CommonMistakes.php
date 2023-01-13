<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonMistakes extends Model
{
    use HasFactory;
    protected $table='common_mistakes';
    protected $primaryKey='id';
    public function cmCategories()
    {
        return $this->belongsTo(CmCategories::class);
    }
    public function cmSubCategories()
    {
        return $this->belongsTo(CmSubCategories::class);
    }
}
