<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DislikesQuestionsModel extends Model
{
    use HasFactory;
    protected $table='question_dis_likes';
    protected $primaryKey='id';
}
