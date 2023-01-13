<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikesQuestionsModel extends Model
{
    use HasFactory;
    protected $table='question_likes';
    protected $primaryKey='id';
}
