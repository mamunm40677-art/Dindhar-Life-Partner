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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('slug', 120)->unique();
            $table->string('subtitle', 255)->nullable();
            $table->string('badge', 60)->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('period', 60)->nullable()->default('/ আজীবন');
            $table->integer('connection_limit')->default(0);
            $table->json('features')->nullable();
            $table->boolean('is_popular')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->string('button_text', 100)->default('প্যাকেজ সাবস্ক্রাইব করুন');
            $table->string('button_link', 255)->default('/contact');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
