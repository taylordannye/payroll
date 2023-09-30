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
        Schema::create('identification_verification', function (Blueprint $table) {
            $table->id('user_id')->nullable();
            $table->string('identification_type')->default('national_id');
            $table->string('identification_number')->nullable();
            $table->timestamp('identification_verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identification_verification');
    }
};
