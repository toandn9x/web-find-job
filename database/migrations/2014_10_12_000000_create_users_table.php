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
            $table->id();
            $table->string('type_login')->default('normal');
            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->index();
            $table->string('password')->nullable();
            $table->integer('status')->default(0);
            $table->rememberToken()->nullable();
            $table->timestamps();
            $table->text('token')->nullable();
            $table->dateTime('time_life_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
