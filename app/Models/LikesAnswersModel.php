<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikesAnswersModel extends Model
{
    use HasFactory;
    protected $table='answer_likes';
    protected $primaryKey='id';
}
