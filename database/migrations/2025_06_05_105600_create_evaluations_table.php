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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();

            $table->unsignedTinyInteger('rate')
                ->comment('Rating given by the user (1 to 5)');

            $table->foreignId('user_id')
                ->comment('The ID of the user who submitted the evaluation')
                ->references('id')->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('trip_id')
                ->comment('The ID of the trip being evaluated')
                ->references('id')->on('trips')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
