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
        // Drop the foreign key constraints first
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['deleted_by']);
            $table->dropForeign(['student_id']);
        });
        
        // Drop the column
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('deleted_by');
        });
        
        // Add a new column
        Schema::table('documents', function (Blueprint $table) {
            $table->unsignedBigInteger('deleted_by')->nullable()->after('added_by');
        });

        // Add a foreign key relationship
        Schema::table('documents', function (Blueprint $table) {
            $table->foreign('deleted_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('student_id')
                ->references('student_id')
                ->on('students')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};