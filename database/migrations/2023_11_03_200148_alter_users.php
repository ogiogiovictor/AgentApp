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
        Schema::table('users', function (Blueprint $table) {
            $table->string('agency_id')->after('id')->default('0');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->timestamp('date_of_engagement')->nullable();
        });

    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('agency_id');
        });
    }
};
