<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('service_translations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_id')->constrained('services')  // Explicit table name (good for clarity and portability)
                ->onDelete('cascade');     // Ensures child rows are deleted when parent is deleted

            $table->string('name')->unique()->comment('Unique name of the service translation');

            $table->string('locale')->comment('Locale code, en, ar');

            $table->unique(['service_id', 'locale'], 'service_locale_unique');
            // Ensures each service has only one translation per locale

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('service_translations');
    }
};
