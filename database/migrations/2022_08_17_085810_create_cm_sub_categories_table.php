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
        Schema::create('cm_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cm_categories_id')->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->enum('status',['Active','Deleted'])->nullable()->default('Active');
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
        Schema::dropIfExists('cm_sub_categories');
    }
};
