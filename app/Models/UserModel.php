<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    protected $table='users';
    protected $primaryKey='id';

    public function user_profile()
    {
        return $this->hasOne('\App\Models\UserProfileModel','user_id','id');
    }
}
