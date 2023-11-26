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
        Schema::create('company_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_owners_id')->constrained('business_owners')->cascadeOnDelete();
            $table->string('job_title');
            $table->enum('job_role',['BackEnd Dev','FrontEnd Dev','Graphics Designer','Content Creator','Digital Marketing']);
            $table->enum('job_level',['Beginner','Junior','Mid','Senior','Expert']);
            $table->string('experience');
            $table->enum('education_level',['highSchoolDiploma','collegeDegree','MasterDegree','A Ph.D']);
            $table->enum('language',['English','Arabic','French'])->nullable();
            $table->enum('age_range',['20-25','25-30','30-35','35-40']);
            $table->enum('gender',['male','female','no_profrence']);
            $table->enum('job_type',['full Time','partTime','Remotely','trainee']);
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
            $table->string('address')->nullable();
            $table->enum('work_hour',['One hour','Tow hours','Three hours','Four hours','Five hours','Six hours','Seven hours','Eight hours']);
            $table->enum('salary_range',['500000-10000000','10000000-1500000','1500000-2000000','2000000-2500000']);
            $table->boolean('help');
            $table->text('job_discription');
            $table->string('job_requirement');
            $table->enum('status',['Active','Closed','Waiting']);
            $table->text('cancel_desc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_jobs');
    }
};
