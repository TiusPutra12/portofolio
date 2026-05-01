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
        Schema::table('education_subs', function (Blueprint $table) {
            $table->date('start_date')->nullable()->after('institution');
            $table->date('end_date')->nullable()->after('start_date');
            $table->text('description')->nullable()->after('status');
            
            // We can keep start_year/end_year for now or drop them. 
            // I'll keep them but make them nullable so we don't break existing data if any, 
            // though we just created this table.
            $table->integer('start_year')->nullable()->change();
            $table->integer('end_year')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('education_subs', function (Blueprint $table) {
            $table->dropColumn(['start_date', 'end_date', 'description']);
            $table->integer('start_year')->nullable(false)->change();
        });
    }
};
