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
        Schema::create('trip_logs', function (Blueprint $table) {
            $table->id();

            $table->enum('status', ['started', 'paused', 'resumed', 'completed', 'cancelled'])
                ->comment('Current status of the trip log (e.g., started, paused)');

            $table->text('notes')
                ->nullable()
                ->comment('Additional notes related to the trip');

            $table->dateTime('start_log')
                ->comment('Timestamp when this log entry started');

            $table->dateTime('end_log')
                ->comment('Timestamp when this log entry ended');

            $table->foreignId('trip_id')
                ->comment('Reference to the associated trip')
                ->constrained('trips')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->comment('User who created or is associated with this log')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->softDeletes()->comment('Soft delete timestamp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_logs');
    }
};
