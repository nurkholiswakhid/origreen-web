<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image_url');
            $table->string('button1_text')->default('Jelajahi Wahana');
            $table->string('button1_url')->default('#wahana');
            $table->string('button2_text')->default('Lihat Lokasi');
            $table->string('button2_url')->default('#peta');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('banners');
    }
};
