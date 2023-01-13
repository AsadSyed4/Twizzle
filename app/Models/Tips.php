<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tips extends Model
{
    use HasFactory;
    protected $table='tips';
    protected $primaryKey='id';
    public function tipsCategories()
    {
        return $this->belongsTo(TipsCategories::class);
    }
    public function tipsSubCategories()
    {
        return $this->belongsTo(TipsSubCategories::class);
    }
}
