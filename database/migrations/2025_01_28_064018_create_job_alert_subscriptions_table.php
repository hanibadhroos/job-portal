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
        Schema::create('job_alert_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // علاقة مع المستخدم
            $table->json('categories')->nullable(); // الفئات المفضلة
            $table->string('location')->nullable(); // الموقع الجغرافي
            $table->enum('job_type', ['full_time', 'part_time', 'remote', 'temporary'])->nullable(); // نوع الوظيفة
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_alert_subscriptions');
    }
};
