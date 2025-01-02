<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the foreign key constraint explicitly
            $table->dropForeign('users_department_id_foreign');
        });

        // Perform column modification
        Schema::table('users', function (Blueprint $table) {
            $table->json('department_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        // Revert to bigint and recreate foreign key
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('department_id')->nullable()->change();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
        });
    }
};
