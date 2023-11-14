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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_job_id'); // Define an unsigned integer column for the foreign key.

            // Define the foreign key constraint.
            $table->foreign('company_job_id')
                  ->references('id') // Referencing the 'id' column.
                  ->on('company_jobs')    // In the 'users' table.
                  ->onDelete('cascade');
            //$table->foreignId('company_job_id')->constrained('company_jobs')->cascadeOnDelete();
            $table->text('question');
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
