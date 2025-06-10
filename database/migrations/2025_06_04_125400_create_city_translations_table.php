<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('city_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained('cities')  // Explicit table name (good for clarity and portability)
            ->onDelete('cascade');     // Ensures child rows are deleted when parent is deleted

            $table->string('name')->comment('Unique name of the City translation');

            $table->string('locale')->comment('Locale code, en, ar');

            $table->unique(['city_id', 'locale'], 'city_locale_unique');
            // Ensures each service has only one translation per locale
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('city_translations');
    }
};
