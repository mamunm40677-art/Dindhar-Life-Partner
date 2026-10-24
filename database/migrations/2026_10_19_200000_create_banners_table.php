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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text', 255)->nullable();
            $table->string('title', 255);
            $table->text('subtitle')->nullable();
            $table->string('image_url', 500)->nullable();
            $table->string('image_caption', 255)->nullable();
            $table->string('button1_text', 120)->nullable();
            $table->string('button1_link', 255)->nullable();
            $table->string('button2_text', 120)->nullable();
            $table->string('button2_link', 255)->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
