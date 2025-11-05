<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->enum('display_type', ['image', 'icon'])->default('icon');
            $table->string('icon')->nullable();
            $table->string('main_icon')->nullable();
            $table->string('image_url')->nullable();
            $table->string('duration')->nullable();
            $table->enum('type', ['wahana', 'fasilitas'])->default('wahana');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
