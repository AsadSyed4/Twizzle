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
        Schema::create('student_extra_curriculars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained()->onDelete('cascade');
            $table->string('organization')->nullable();
            $table->text('duties_responsibilities')->nullable();            
            $table->enum('interest',['High','Low','Medium']);
            $table->enum('teaching_style',['High','Low','Medium']);
            $table->enum('content',['High','Low','Medium']);            
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
        Schema::dropIfExists('student_extra_curriculars');
    }
};
