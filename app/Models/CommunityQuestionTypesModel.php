<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityQuestionTypesModel extends Model
{
    use HasFactory;
    protected $table='community_question_types';
    protected $primaryKey='id';
}
