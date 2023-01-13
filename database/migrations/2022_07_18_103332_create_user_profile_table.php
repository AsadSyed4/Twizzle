<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('f_name');
            $table->string('l_name');
            $table->string('state');
            $table->string('city');
            $table->string('zip');
            $table->year('current_year');
            $table->date('expected_graduation_date');
            $table->string('high_school_name');
            $table->enum('school_type',['Public','Private']);
            $table->string('school_rank');
            $table->enum('gender',['Male','Female','Prefer to not say']);
            $table->string('target_school');
            $table->enum('time_commitment',['hrs','wk']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profile');
    }
};
