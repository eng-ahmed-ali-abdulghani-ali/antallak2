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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_id')
                ->comment('Reference to the service name')
                ->references('id')->on('services')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('client_id')
                ->comment('Reference to the client user')
                ->references('id')->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();


            $table->foreignId('driver_id')
                ->comment('Reference to the driver user')
                ->references('id')->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('payment_method_id')
                ->comment('Reference to the payment method')
                ->references('id')->on('payment_methods')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->boolean('payment_status')
                ->default(false)
                ->comment('True if payment was completed');

            $table->foreignId('category_id')
                ->comment('Vehicle category for the trip')
                ->references('id')->on('categories')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('pricing_rule_id')
                ->comment('Pricing rule used for this trip')
                ->references('id')->on('pricing_rules')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->decimal('pickup_latitude', 10, 7)
                ->comment('Pickup location latitude');

            $table->decimal('pickup_longitude', 10, 7)
                ->comment('Pickup location longitude');

            $table->decimal('dropoff_latitude', 10, 7)
                ->comment('Drop-off location latitude');

            $table->decimal('dropoff_longitude', 10, 7)
                ->comment('Drop-off location longitude');

            $table->integer('estimated_duration')
                ->comment('Estimated duration in minutes');

            $table->decimal('total_amount', 8, 2)
                ->comment('Total fare charged for the trip');

            $table->decimal('driver_commission_percent',8,2)
                ->comment('Commission percentage for driver');

            $table->enum('trip_status', ['pending', 'accepted', 'in_progress', 'completed', 'cancelled'])
                ->default('pending')
                ->comment('Current status of the trip');

            $table->dateTime('start_time')->nullable()->comment('Trip start time');

            $table->dateTime('end_time')->nullable()->comment('Trip end time');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
