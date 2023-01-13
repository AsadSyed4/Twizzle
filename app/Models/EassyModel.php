<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EassyModel extends Model
{
    use HasFactory;
    protected $table='essay';
    protected $primaryKey='id';

    public function users()
    {
        return $this->belongsTo('\App\Models\User','user_id','id');
    }

    public function essay_grading()
    {
        return $this->hasOne('\App\Models\EssayGrading','essay_id','id');
    }

    public function subscription()
    {
        return $this->belongsTo('\App\Models\SubscriptionModel','subscription_id','id');
    }

    public function admins()
    {
        return $this->belongsTo('\App\Models\Admins','admins_id','id');
    }
}
