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
        Schema::create('job_seekers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('job_title');
            $table->string('address')->nullable();
            $table->date('Date_of_birth')->nullable();
            $table->enum('gender',['male','female','no_profrence'])->nullable();
            $table->enum('field_of_work',['UI/UX','graphicDesign','flutter','frontend_developer','digital_marketing','backend_developer']);
            $table->enum('job_level',['beginner','junior','mid','Senior','expert'])->nullable();
            $table->string('experience')->nullable();
            $table->enum('work_type',['full Time','partTime','Remotely','trainee']);
            $table->enum('education_level',['highSchoolDiploma','collegeDegree','MasterDegree','A Ph.D'])->nullable();
            $table->enum('current_Job_Status',['openToWork','emlpoyee'])->nullable();

            $table->enum('salary_range',['500000-10000000','10000000-1500000','1500000-2000000','2000000-2500000'])->nullable();
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_seekers');
    }
};
