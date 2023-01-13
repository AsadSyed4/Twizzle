<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityQuestionsModel extends Model
{
    use HasFactory;
    protected $table='community_questions';
    protected $primaryKey='id';

    public function community_question_types()
    {
        return $this->belongsTo('\App\Models\CommunityQuestionTypesModel','qestion_type_id','id');
    }

    public function users()
    {
        return $this->belongsTo('\App\Models\UserModel','user_id','id');
    }

    public function admins()
    {
        return $this->belongsTo('\App\Models\Admins','admins_id','id');
    }

    public function answers()
    {
        return $this->hasMany('\App\Models\CommunityQuestionAnswersModel','question_id','id');
    }
}
