<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TestQuestions;

class Tests extends Model
{
    use HasFactory;
    protected $table='tests';
    protected $primaryKey='id';

    public function questions()
    {
        return $this->hasMany(TestQuestions::class);
    }

    public function sections()
    {
        return $this->hasMany(TestsSections::class);
    }
}
