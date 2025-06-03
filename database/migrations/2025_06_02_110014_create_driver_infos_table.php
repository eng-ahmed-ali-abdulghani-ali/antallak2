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
        Schema::create('driver_info', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->comment('Reference to the user account')
                ->references('id')->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('supervisor_id')
                ->comment('Reference to the supervisor user')
                ->references('id')->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('city_id')
                ->comment('City where the driver is registered')
                ->references('id')->on('cities')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->comment('Vehicle category')
                ->constrained('categories')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('brand_id')
                ->comment('Vehicle brand')
                ->constrained('brands')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->boolean('appearance_status')
                ->default(true)
                ->comment('Driver is currently available or appearing');

            $table->decimal('latitude', 10, 7)->comment('Driver current latitude');
            $table->decimal('longitude', 10, 7)->comment('Driver current longitude');

            $table->dateTime('recorded_at')->comment('Timestamp of current location update');

            $table->string('stcpay_number')->comment('STC Pay number');
            $table->string('nationality')->comment('Driver nationality');

            $table->date('date_of_birth')->comment('Date of birth');
            $table->string('iqama_number')->comment('Iqama/residency number');
            $table->date('iqama_expiry')->comment('Iqama expiry date');
            $table->date('driving_license_expiry')->comment('Driving license expiry date');

            $table->boolean('under_kafala')->default(false)->comment('Whether driver is under sponsorship');

            $table->string('vehicle_name')->comment('Vehicle name or make');
            $table->year('vehicle_model_year')->comment('Year of vehicle model');
            $table->string('number_plate')->comment('Vehicle plate number');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_infos');
    }
};
