<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\EnrollmentLog;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\SchoolYear;
use App\Http\Requests\Main\Enrollment\EnrollmentRequest;
use App\Http\Requests\Main\Enrollment\EnrollmentEditRequest;
use App\Http\Requests\Main\Enrollment\BulkEnrollmentRequest;
use App\Services\EnrollmentService;
use Exception;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentExport;
use App\Models\StudentType;
use App\Services\StudentTypeService;

class EnrollmentLogController extends Controller
{
    //
    public function list($student_id)
    {
        $logs = EnrollmentLog::where('student_id', $student_id)->get();

        return response()->json([
            'message' => 'Logs retrieved successfully',
            'data' => $logs,
        ], 200);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'added_by' => 'nullable|exists:users,id',
            'deleted_by' => 'nullable|exists:users,id',
            'student_id' => 'required|exists:students,student_id',
            'school_year_id' => 'nullable|exists:school_years,id',
            'department_id' => 'nullable|exists:departments,id',
            'course_id' => 'nullable|exists:courses,id',
            'major_id' => 'nullable|exists:majors,id',
            'section_id' => 'nullable|exists:sections,id',
            'student_status' => 'nullable|integer',
            'graduate_studies' => 'nullable|string',
            'required_document' => 'nullable|string',
        ]);

        $log = EnrollmentLog::create($validated);

        return response()->json([
            'message' => 'Log created successfully',
            'data' => $log,
        ], 201);
    }
}
