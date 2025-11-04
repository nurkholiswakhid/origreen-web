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
            // Add new description column
            $table->text('description')->nullable();
        });

        // First merge description1 and description2 into the new description column
        DB::statement("UPDATE abouts SET description = CASE
            WHEN description2 IS NOT NULL AND description2 != ''
            THEN CONCAT(description1, '\n\n', description2)
            ELSE description1
            END");

        Schema::table('abouts', function (Blueprint $table) {
            // Drop old columns after data has been migrated
            $table->dropColumn(['description1', 'description2']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            // Add back the old columns
            $table->text('description1')->nullable();
            $table->text('description2')->nullable();

            // Copy data back to first description field
            DB::statement("UPDATE abouts SET description1 = description");

            // Drop new column
            $table->dropColumn('description');
        });
    }
};
