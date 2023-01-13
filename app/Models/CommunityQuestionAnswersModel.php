<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityQuestionAnswersModel extends Model
{
    use HasFactory;
    protected $table='community_question_answers';
    protected $primaryKey='id';

    public function users()
    {
        return $this->belongsTo('\App\Models\UsersModel','user_id','id');
    }
}
