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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('trip_id')
                ->comment('Reference to the related trip')
                ->constrained('trips')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->integer('delivery_item_count')
                ->comment('Number of items to be delivered');

            $table->decimal('estimated_weight', 8, 2)
                ->comment('Estimated total weight of the delivery in kilograms');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
