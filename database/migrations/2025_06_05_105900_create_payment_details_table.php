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
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();

            $table->decimal('amount', 8, 2)
                ->comment('Amount paid for the trip');

            $table->string('transaction_reference')
                ->comment('External payment gateway transaction reference');

            $table->foreignId('trip_id')
                ->comment('Reference to the related trip')
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
        Schema::dropIfExists('payment_details');
    }
};
