<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            // First migrate existing data
            DB::statement("
                UPDATE abouts
                SET stats_visitor = JSON_OBJECT(
                    'icon', 'fas fa-users',
                    'title', 'Total Pengunjung',
                    'value', stats_visitor,
                    'color', 'text-green-500'
                ),
                stats_rating = JSON_OBJECT(
                    'icon', 'fas fa-star',
                    'title', 'Rating',
                    'value', stats_rating,
                    'color', 'text-yellow-400'
                )
            ");

            // Change column types to JSON
            $table->json('stats_visitor')->change();
            $table->json('stats_rating')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            // Extract the value from JSON before changing column type
            DB::statement("
                UPDATE abouts
                SET stats_visitor = JSON_UNQUOTE(JSON_EXTRACT(stats_visitor, '$.value')),
                stats_rating = JSON_UNQUOTE(JSON_EXTRACT(stats_rating, '$.value'))
            ");

            // Change back to string type
            $table->string('stats_visitor')->change();
            $table->string('stats_rating')->change();
        });
    }
};
