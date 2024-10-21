<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('event_id')->unsigned();
            $table->foreign('event_id')
                ->references('id')
                ->on('events');
            $table->bigInteger('admin_id')->unsigned();
            $table->foreign('admin_id')
                ->references('id')
                ->on('admins');
            $table->dateTime('date');
            $table->string('place');
            $table->string('contact_person');
            $table->string('phone_number');
            $table->string('description');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
