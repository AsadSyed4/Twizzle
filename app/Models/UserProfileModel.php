<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfileModel extends Model
{
    use HasFactory;
    protected $table='user_profile';
    protected $primaryKey='id';

    public function setFNameAttribute($value){
        $this->attributes['f_name']=ucwords($value);
    }
    
    public function setLNameAttribute($value){
        $this->attributes['L_name']=ucwords($value);
    }
    public function getExpectedGraduationDateAttribute($value){
        return formatted_date($value,"d-M-Y");
    }

    public function users()
    {
        return $this->belongsTo('\App\Models\UserModel','user_id','id');
    }
}
