<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DislikesAnswersModel extends Model
{
    use HasFactory;
    protected $table='answer_dis_likes';
    protected $primaryKey='id';
}
