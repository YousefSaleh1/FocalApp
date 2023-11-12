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
        Schema::create('business_owners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('company_name');
            $table->string('company_field');
            $table->foreignId('city_id')->constrained('city')->cascadeOnDelete();
            $table->string('company_size')->nullable();
            $table->date('year_founded')->nullable();
            $table->string('company_logo');
            $table->string('responsible_job_role');
            $table->integer('company_number');
            $table->string('website');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_owners');
    }
};
