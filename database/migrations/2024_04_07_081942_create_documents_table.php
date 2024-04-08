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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('type');
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('deleted_by');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');

            $table->foreign('type')
                ->references('id')
                ->on('document_categories')
                ->onDelete('cascade');

            $table->foreign('added_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        
            $table->foreign('deleted_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
