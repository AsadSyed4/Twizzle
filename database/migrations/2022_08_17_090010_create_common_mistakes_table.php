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
        Schema::create('common_mistakes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cm_categories_id')->constrained()->onDelete('cascade');
            $table->foreignId('cm_sub_categories_id')->constrained()->onDelete('cascade');
            $table->text('content')->nullable()->default(NULL);
            $table->enum('status',['Active','Deleted'])->default('Active');
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
        Schema::dropIfExists('common_mistakes');
    }
};
