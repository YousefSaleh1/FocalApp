<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CompanyJob;
use Illuminate\Http\Request;
use App\Models\JobSeeker;
class FilteringController extends Controller
{
// فلترة بيانات الموظفين
    public function filtere(Request $request)
    {
        // عملية التحقق من صحة البيانات
        $validatedData = $request->validate([
            'experience' => 'required',
            'field_of_work' => 'required|string',
            'job_title' => 'required|string',
            'job_level' => 'required|string',
            'gender' => 'required|string',
            'work_type' => 'required|string',
            'education_level' => 'required|string',
            'salary_range' => 'required|string',
        ]);

        // الحصول على قيم البحث من المستخدم
        $experience = $validatedData['experience'];
        $field_of_work = $validatedData['field_of_work'];
        $job_title = $validatedData['job_title'];
        $job_level = $validatedData['job_level'];
        $gender = $validatedData['gender'];
        $work_type = $validatedData['work_type'];
        $education_level = $validatedData['education_level'];
        $salary_range = $validatedData['salary_range'];
        // تحديد شروط الفلترة
        $conditions = [];
        if ($experience) {
            $conditions[] = ['experience', '>=', $experience];
        }
        if ($field_of_work) {
            $conditions[] = ['field_of_work', '=', $field_of_work];
        }
        if ($job_title) {
            $conditions[] = ['job_title', '=', $job_title];
        }
        if ($job_level) {
            $conditions[] = ['job_level', '=', $job_level];
        }
        if ($gender) {
            $conditions[] = ['gender', '=', $gender];
        }
        if ($work_type) {
            $conditions[] = ['work_type', '=', $work_type];
        }
        if ($education_level) {
            $conditions[] = ['education_level', '=', $education_level];
        }
        if ($salary_range) {
            $conditions[] = ['salary_range', '=', $salary_range];
        }
        // تنفيذ فلترة البيانات باستخدام المودل
        $filteredData = JobSeeker::where($conditions)->get();

    // التحقق مما إذا كان هناك نتائج تطابق المعايير المحددة
    if ($filteredData->isEmpty()) {
        return response()->json(['message' => 'لا توجد نتائج تطابق المعايير المحددة']);
    } else {
        return response()->json($filteredData,200);
    }
    }

    // فلترة بيانات الشركات
    public function filterj(Request $request)
    {
        // عملية التحقق من صحة البيانات
        $validatedData = $request->validate([
            'experience'      => 'required',
            'job_type'        => 'required|string',
            'job_title'       => 'required|string',
            'job_level'       => 'required|string',
            'gender'          => 'required|string',
            'work_hour'       => 'required|string',
            'language'        => 'required|string',
            'salary_range'    => 'required|string',
            'education_level' => 'required|string',
        ]);

        // الحصول على قيم البحث من المستخدم
        $experience = $validatedData['experience'];
        $job_type = $validatedData['job_type'];
        $job_title = $validatedData['job_title'];
        $job_level = $validatedData['job_level'];
        $gender = $validatedData['gender'];
        $work_hour = $validatedData['work_hour'];
        $education_level = $validatedData['education_level'];
        $salary_range = $validatedData['salary_range'];
        // تحديد شروط الفلترة
        $conditions = [];
        if ($experience) {
            $conditions[] = ['experience', '>=', $experience];
        }
        if ($job_type) {
            $conditions[] = ['job_type', '=', $job_type];
        }
        if ($job_title) {
            $conditions[] = ['job_title', '=', $job_title];
        }
        if ($job_level) {
            $conditions[] = ['job_level', '=', $job_level];
        }
        if ($gender) {
            $conditions[] = ['gender', '=', $gender];
        }
        if ($work_hour) {
            $conditions[] = ['work_hour', '=', $work_hour];
        }
        if ($education_level) {
            $conditions[] = ['education_level', '=', $education_level];
        }
        if ($salary_range) {
            $conditions[] = ['salary_range', '=', $salary_range];
        }
        // تنفيذ فلترة البيانات باستخدام المودل
        $filteredData = CompanyJob::where($conditions)->get();
    // التحقق مما إذا كان هناك نتائج تطابق المعايير المحددة
    if ($filteredData->isEmpty()) {
        return response()->json(['message' => 'لا توجد نتائج تطابق المعايير المحددة']);
    } else {
        return response()->json($filteredData,200);
    }
    }
    public function filterSearch (Request $request){
        $validatedData = $request->validate([
            'job_role'      => 'required|string',
            'field_of_work' => 'required|string',
        ]);
        $field_of_work = $validatedData['field_of_work'];
        $job_role = $validatedData['job_role'];
        // تنفيذ فلترة البيانات باستخدام المودل
        //$filteredData = Job::where($job_role)->get();
        $filteredData = JobSeeker::where($field_of_work)->get();
    // التحقق مما إذا كان هناك نتائج تطابق المعايير المحددة
    if ($filteredData->isEmpty()) {
        return response()->json(['message' => 'لا توجد نتائج تطابق المعايير المحددة']);
    } else {
        return response()->json($filteredData,200);
    }

    }
}


