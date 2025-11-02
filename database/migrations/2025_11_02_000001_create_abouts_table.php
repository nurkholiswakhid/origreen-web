<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->text('description1');
            $table->text('description2');
            $table->string('stats_visitor');
            $table->string('stats_rating');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('abouts');
    }
};
