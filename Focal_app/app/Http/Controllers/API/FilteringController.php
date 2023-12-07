<?php

namespace App\Http\Controllers\API;

use App\Models\Blog;
use App\Models\JobSeeker;
use App\Models\CompanyJob;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;

class FilteringController extends Controller
{
// فلترة بيانات الموظفين
    public function filtere(Request $request)
    {
        // عملية التحقق من صحة البيانات
        $validatedData = $request->validate([
            'job_title'          => ["sometimes", "string"],
            'gender'             => ["sometimes", Rule::in(['male', 'female', 'no_profrence'])],
            'field_of_work'      => ["sometimes", Rule::in(['UI/UX', 'graphicDesign', 'flutter', 'frontend_developer', 'digital_marketing', 'backend_developer'])],
            'job_level'          => ["sometimes", Rule::in(['beginner', 'junior', 'mid', 'Senior', 'expert'])],
            'experience'         => ["sometimes", "integer"],
            'work_type'          => ["sometimes", Rule::in(['full Time', 'partTime', 'Remotely', 'trainee'])],
            'education_level'    => ["sometimes", Rule::in(['highSchoolDiploma', 'collegeDegree', 'MasterDegree', 'A Ph.D'])],
            'current_Job_Status' => ["sometimes", Rule::in(['openToWork', 'emlpoyee'])],
            'salary_range'       => ["sometimes", Rule::in(['500000-10000000', '10000000-1500000', '1500000-2000000', '2000000-2500000'])],
        ]);

        // تحديد شروط الفلترة
        $conditions = [];

        foreach ($validatedData as $key => $value) {
            // استخدام null بدلاً من empty() للسماح بالقيم الفارغة
            if ($value !== null) {
                $conditions[] = [$key, '=', $value];
            }
        }

        // If no conditions are provided, return an empty result
        if (empty($conditions)) {
            return response()->json(['message' => 'يجب توفير على الأقل شرط واحد للفلترة.'], 400);
        }

        // تنفيذ فلترة البيانات باستخدام المودل
        $filteredData = JobSeeker::where(function ($query) use ($conditions) {
            foreach ($conditions as $condition) {
                $query->orWhere($condition[0], $condition[1], $condition[2]);
            }
        })->get();

        // التحقق مما إذا كان هناك نتائج تطابق المعايير المحددة
        if ($filteredData->isEmpty()) {
            return response()->json(['message' => 'لا توجد نتائج تطابق المعايير المحددة']);
        } else {
            return response()->json($filteredData, 200);
        }
    }

    // فلترة بيانات الشركات
    public function filterj(Request $request)
    {
        // عملية التحقق من صحة البيانات
        $validatedData = $request->validate([
            'job_role'        => ['sometimes',Rule::in(['BackEnd Dev','FrontEnd Dev','Graphics Designer','Content Creator','Digital Marketing']),],
            'job_level'       =>['sometimes',Rule::in(['Beginner','Junior','Mid','Senior','Expert']),],
            'experience'      =>['sometimes','integer'],
            'education_level' =>['sometimes',Rule::in(['highSchoolDiploma','collegeDegree','MasterDegree','A Ph.D']),],
            'language'        =>['sometimes',Rule::in(['English','Arabic','French']),],
            'gender'          =>['sometimes',Rule::in(['male','female','no_profrence']),],
            'job_type'        =>['sometimes',Rule::in(['full Time','partTime','Remotely','trainee']),],
            'city_id'         =>'sometimes|integer',
            'work_hour'       =>['sometimes',Rule::in(['One hour','Tow hours','Three hours','Four hours','Five hours','Six hours','Seven hours','Eight hours']),],
            'salary_range'    =>['sometimes',Rule::in(['500000-10000000','10000000-1500000','1500000-2000000','2000000-2500000']),],

        ]);

        // تحديد شروط الفلترة
        $conditions = [];

        foreach ($validatedData as $key => $value) {
            // استخدام null بدلاً من empty() للسماح بالقيم الفارغة
            if ($value !== null) {
                $conditions[] = [$key, '=', $value];
            }
        }// If no conditions are provided, return an empty result
        if (empty($conditions)) {
            return response()->json(['message' => 'يجب توفير على الأقل شرط واحد للفلترة.'], 400);
        }

        // تنفيذ فلترة البيانات باستخدام المودل
        $filteredData = CompanyJob::where(function ($query) use ($conditions) {
            foreach ($conditions as $condition) {
                $query->orWhere($condition[0], $condition[1], $condition[2]);
            }
        })->get();

        // التحقق مما إذا كان هناك نتائج تطابق المعايير المحددة
        if ($filteredData->isEmpty()) {
            return response()->json(['message' => 'لا توجد نتائج تطابق المعايير المحددة']);
        } else {
            return response()->json($filteredData, 200);
        }
    }




    public function filterBlogs(Request $request)
    {
        $categoryIds = $request->input('category_ids', []);

        $blogs = Blog::whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('category_id', $categoryIds);
        })->get();

        return response()->json(['blogs' => BlogResource::collection($blogs)], 200);
    }
}
