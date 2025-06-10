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
        Schema::create('users', function (Blueprint $table) {
                $table->id(); // Primary key

                $table->string('name'); // Full name of the user

                $table->string('phone')->unique()
                    ->comment('Unique phone number for user');

                $table->dateTime('phone_verified_at')->nullable()
                    ->comment('Date and time when the phone number was verified');

                $table->enum('role', ['admin', 'client', 'driver', 'supervisor'])
                    ->default('client')
                    ->comment('User role: admin, client, driver, or supervisor');

                $table->boolean('is_active')
                    ->default(true)
                    ->comment('User account active status');

                $table->string('password')
                    ->comment('Hashed user password');

                $table->rememberToken(); // For "remember me" sessions

                $table->timestamps(); // created_at and updated_at

        });


        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('phone')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });


        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }


    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
