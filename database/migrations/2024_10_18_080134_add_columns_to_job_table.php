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
        Schema::table('job', function (Blueprint $table) {
            $table->integer('min_salary')->nullable(); // الحد الأدنى للراتب
            $table->integer('max_salary')->nullable(); // الحد الأقصى للراتب
            $table->enum('job_type', ['full_time', 'part_time', 'remote', 'temporary'])->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
        {
        Schema::table('job', function (Blueprint $table) {
            //
        });
    }
};
