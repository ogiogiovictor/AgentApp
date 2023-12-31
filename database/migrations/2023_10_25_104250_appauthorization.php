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
        Schema::create('app_authorization', function (Blueprint $table) {
            $table->id();
            $table->string('domain_name')->index()->nullable();
            $table->string('ip_address')->index()->nullable();
            $table->string('app_secret')->index()->nullable(); // Changed column name to use underscore instead of dash
            $table->string('app_token')->nullable();
            $table->string('app_name')->nullable(); // Changed column name to use underscore instead of camel case
            $table->enum('status', ['on', 'off'])->default('off');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_authorization');
    }
};
