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
        Schema::create('student_classes_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained()->onDelete('cascade');
            $table->string('year')->nullable();
            $table->string('course_title')->nullable();
            $table->string('teacher_name')->nullable();
            $table->char('final_grade')->nullable();
            $table->enum('interest',['High','Low','Medium']);
            $table->enum('teaching_style',['High','Low','Medium']);
            $table->enum('content',['High','Low','Medium']);
            $table->float('gpa')->default(0.00);
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
        Schema::dropIfExists('student_classes_grades');
    }
};
