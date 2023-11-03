<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations. 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
     */
    public function up(): void
    {
        Schema::create('agency', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ceo_name')->nullable();
            $table->string('ceo_phone')->nullable();
            $table->string('ceo_email')->nullable();
            $table->string('no_sub_agenets')->nullable();
            $table->datetime('date_of_enga;gement');
            $table->string('agency_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agency');
    }
};
