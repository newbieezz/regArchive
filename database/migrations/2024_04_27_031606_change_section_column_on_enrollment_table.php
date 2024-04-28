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
        // Check if the column already exists before adding it
        if (!Schema::hasColumn('enrollments', 'section_id')) {
            // Add a new column
            Schema::table('enrollments', function (Blueprint $table) {
                $table->unsignedBigInteger('section_id')->after('major_id');
            });

            // Drop the old column if it exists
            if (Schema::hasColumn('enrollments', 'section')) {
                Schema::table('enrollments', function (Blueprint $table) {
                    $table->dropColumn('section');
                });
            }

            // Add a foreign key relationship
            Schema::table('enrollments', function (Blueprint $table) {
                $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
                // Replace 'related_table_name' with the name of the related table
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the foreign key relationship
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropForeign(['section_id']);
        });

        // Recreate the old column if it existed before
        if (Schema::hasColumn('enrollments', 'section')) {
            Schema::table('enrollments', function (Blueprint $table) {
                $table->unsignedBigInteger('section')->after('major_id');
            });
        }

        // Drop the new column if it was added
        if (Schema::hasColumn('enrollments', 'section_id')) {
            Schema::table('enrollments', function (Blueprint $table) {
                $table->dropColumn('section_id');
            });
        }
    }
};
