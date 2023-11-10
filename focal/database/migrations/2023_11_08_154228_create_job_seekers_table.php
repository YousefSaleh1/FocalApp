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
            $table->forignId('user_id')->constrained('users');
            $table->string('job_title');
            $table->string('address');
            $table->date('Date_of_birth');
            $table->enum('gender',['male','female','no_profrence']);
            $table->string('photo');
            $table->enum('field_of_work',['UI/UX','graphicDesign','flutter','frontend_developer','digital_marketing','backend_developer']);
            $table->enum('job_level',['beginner','junior','mid','Senior','expert']);
            $table->string('experience');
            $table->enum('work_type',['full Time','partTime','Remotely','trainee']);
            $table->enum('education_level',['highSchoolDiploma','collegeDegree','MasterDegree','A Ph.D']);
            $table->enum('current_Job_Status',['openToWork','emlpoyee']);
            $table->enum('salary_range');
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
