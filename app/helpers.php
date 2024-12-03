<?php

use App\Models\Student;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Services\SchoolYearService;
use App\Services\DepartmentService;
use App\Services\SectionService;
use App\Services\CourseService;
use App\Services\MajorService;
use App\Services\DocumentCategoryService;
use App\Services\StudentTypeService;
use Illuminate\Support\Facades\Auth;
/*
 * get logged in user
 * @return User $user
*/
if (!function_exists('formatEnrollmentData')) {

    function formatEnrollmentData($data)
    {
        $studentInfo = [];
        $enrollmentInfo = [];
        $studentInfo['id'] = $data['student_id'];
        foreach ($data as $key => $value) {
            if (in_array($key, config('enrollment.student_info'))) {
                $studentInfo[$key] = $value;
            } elseif (in_array($key, config('enrollment.enrollment_data'))) {
                $enrollmentInfo[$key] = $value;
            }
        }

        return array(
            'student' => $studentInfo,
            'enrollment' => $enrollmentInfo
        ); 
    }
}
if (!function_exists('getStudentType')){
    function getStudentType()
    {
        $studentTypeService = app(StudentTypeService::class);
        return $studentTypeService->listAll();
    }
}

/*
 * get logged in user
 * @return User $user
*/
if (!function_exists('getLoggedInUser')) {

    function getLoggedInUser()
    {
        $user = NULL;
        if (Auth::check()) {
            $user = Auth::user();
        }

        return $user;
    }
}

if (!function_exists('getSchoolYear')) {

    function getSchoolYear()
    {
        // Instantiate the SchoolYearService
        $schoolYearService = app(SchoolYearService::class);

        return $schoolYearService->listAll();
    }
}

if (!function_exists('getDepartments')) {

    function getDepartments()
    {
        // Instantiate the DepartmentService
        $departmentService = app(DepartmentService::class);

        return $departmentService->listAll();
    }
}

if (!function_exists('getCourses')) {

    function getCourses()
    {
        // Instantiate the CourseService
        $courseService = app(CourseService::class);

        return $courseService->listAll();
    }
}

if (!function_exists('getMajors')) {

    function getMajors()
    {
        // Instantiate the MajorService
        $majorService = app(MajorService::class);

        return $majorService->listAll();
    }
}

if (!function_exists('getSections')) {

    function getSections()
    {
        // Instantiate the SchoolYearService
        $sectionService = app(SectionService::class);

        return $sectionService->listAll();
    }
}

if (!function_exists('getDocumentCategories')) {

    function getDocumentCategories(?int $student_id = null): mixed
    {
        $documentCategoryService = app(DocumentCategoryService::class);
        if (is_null($student_id)) {
            return $documentCategoryService->listAll();
        }

        $student = Student::find($student_id);
        // Instantiate the SchoolYearService
        $the_category = $documentCategoryService->findByRequiredStudent('A' . $student->required_document);
        //dd($the_category);

        return $the_category;
    }
}

/**
 * Validate search condition has a value
 * @param string $parameter
 * @return boolean $boolean
 */
if (!function_exists('checkSearchHasValue')) {

    function checkSearchHasValue($parameter)
    {
        $boolean = false;
        if (strlen(trim($parameter)) > 0) {
            $boolean = true;
        }

        return $boolean;
    }
}


