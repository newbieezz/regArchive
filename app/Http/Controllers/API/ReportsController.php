<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StudentService;

class ReportsController extends Controller
{
    /** @var App\Services\StudentService */
    protected $studentService;

    /**
     * UserController constructor.
     *
     * @param App\Services\StudentService $studentService
     */
    public function __construct(StudentService $studentService)
    {
        parent::__construct();
        $this->studentService = $studentService;
    }

    /**
     * Get Department Student Report
     */
    public function departmentStudentReport()
    {
        try {
            $this->response['data'] = $this->studentService->departmentStudentReport();
        } catch (Exception $e) {
            return $e;
            $this->response = [
                'error' => $e->getMessage(),
                'code' => 500,
            ];
        }
        return response()->json($this->response,  $this->response['code']);
    }

    /**
     * Get Enrollment Reports
     */
    public function enrollmentReport(Request $request)
    {
        try {
            $this->response['data'] = $this->studentService->enrollmentReport($request);
        } catch (Exception $e) {
            return $e;
            $this->response = [
                'error' => $e->getMessage(),
                'code' => 500,
            ];
        }
        return response()->json($this->response,  $this->response['code']);
    }
    
    /**
     * Get Document Reports
     */
    public function documentReport(Request $request)
    {
        try {
            $this->response['data'] = $this->studentService->documentReport($request);
        } catch (Exception $e) {
            return $e;
            $this->response = [
                'error' => $e->getMessage(),
                'code' => 500,
            ];
        }
        return response()->json($this->response,  $this->response['code']);
    }
    
    
}
