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
            $table->string('name');
            $table->string('business_name');
            $table->enum('category', ['fnb', 'fashion', '']);
            $table->string('no_whatsapp');
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->boolean('request_activation')->default(false);
            $table->boolean('request_verification')->default(false);
            $table->timestamps();
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