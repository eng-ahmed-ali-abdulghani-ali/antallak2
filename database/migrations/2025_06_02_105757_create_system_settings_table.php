<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();


            $table->string('key')->index()
                ->comment('The  key identifier for the setting');


            $table->text('value')
                ->comment('The corresponding value for the setting');


            $table->string('type')->default('string')
                ->comment('The data type of the setting value (e.g., string, integer, json)');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
