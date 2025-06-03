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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->comment('The user who submitted the complaint')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('trip_id')
                ->comment('The trip related to the complaint')
                ->constrained('trips')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('content')
                ->comment('Complaint content ');


            $table->enum('status', ['pending', 'in_progress', 'resolved', 'rejected'])
                ->default('pending')
                ->comment('Current status of the complaint');

            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
