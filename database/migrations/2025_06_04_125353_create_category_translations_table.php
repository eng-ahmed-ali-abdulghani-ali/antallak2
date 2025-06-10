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
        Schema::create('category_translations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')->constrained('categories')  // Explicit table name (good for clarity and portability)
            ->onDelete('cascade');     // Ensures child rows are deleted when parent is deleted

            $table->string('name')->comment('Unique name of the category translation');

            $table->string('locale')->comment('Locale code, en, ar');

            $table->unique(['category_id', 'locale'], 'category_locale_unique');

            // Ensures each service has only one translation per locale
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_translations');
    }
};
