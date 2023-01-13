<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssayGrading extends Model
{
    use HasFactory;
    
    public function eassay()
    {
        return $this->belongsTo('\App\Models\EassyModel','essay_id','id');
    }
    public function users()
    {
        return $this->eassay->users;
    }
    public function admins()
    {
        return $this->belongsTo(Admins::class);
    }
}
