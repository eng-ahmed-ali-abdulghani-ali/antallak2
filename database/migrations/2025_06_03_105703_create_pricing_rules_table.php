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
        Schema::create('pricing_rules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('city_id')
                ->comment('Reference to the city where the rule applies')
                ->constrained('cities')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->comment('Reference to the vehicle category')
                ->constrained('categories')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->decimal('base_fare', 8, 2)
                ->comment('Initial base fare before distance or time charges');

            $table->decimal('cost_per_km', 8, 2)
                ->comment('Cost added per kilometer');

            $table->decimal('cost_per_minute', 8, 2)
                ->comment('Cost added per minute of the ride');

            $table->decimal('minimum_fare', 8, 2)
                ->comment('Minimum fare charged even for short trips');

            $table->time('start_time')
                ->comment('Time of day when this rule starts to apply');

            $table->time('end_time')
                ->comment('Time of day when this rule stops applying');

            $table->json('days_of_week')
                ->comment('List of applicable days (e.g., ["monday", "friday"] or ["all"])');

            $table->boolean('is_active')
                ->default(true)
                ->comment('Indicates if this pricing rule is currently active');

            $table->timestamps();

            $table->softDeletes()
                ->comment('Soft delete timestamp (for reversible deletions)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_rules');
    }
};
