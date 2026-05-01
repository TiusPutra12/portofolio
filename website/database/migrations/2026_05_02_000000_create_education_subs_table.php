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
        Schema::create('education_subs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('education_id')->constrained('education')->onDelete('cascade');
            $table->string('institution');
            $table->integer('start_year');
            $table->integer('end_year')->nullable();
            $table->string('supervisor')->nullable();
            $table->string('status')->default('Proses'); // Lulus / Proses
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_subs');
    }
};
