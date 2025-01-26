<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('training_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('training_id')->unsigned();
            $table->foreign('training_id')
                ->references('id')
                ->on('trainings');
            $table->bigInteger('group_id')->unsigned();
            $table->foreign('group_id')
                ->references('id')
                ->on('groups');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_details');
    }
};
