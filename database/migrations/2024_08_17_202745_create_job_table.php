<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Company;
use App\Models\Category;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('job')) {
            Schema::create('job', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->unsignedBigInteger('company_id');
                $table->unsignedBigInteger('category_id');
                $table->text('Requirments');
                $table->string('Location');
                $table->timestamps();
            });
        }

        // Schema::create('job', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('title');
            
        //     $table->foreignId('company_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
        //     $table->foreignId('category_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

        //     $table->text('Requirments');
        //     $table->string('Location');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job');
    }
};
