<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Documents;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use Exception;
use App\Services\UserService;
use App\Services\StudentService;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Settings\Users\UpdateUserRequest;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $userService;

    /** @var App\Services\StudentService */
    protected $studentService;

    /**
     * UserController constructor.
     *
     * @param App\Services\UserService $userService
     */
    public function __construct(UserService $userService, StudentService $studentService)
    {
        $this->userService = $userService;
        $this->studentService = $studentService;
    }
    public function index()
    {
        $reports = $this->studentService->getReports();
        return view('dashboard', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    public function editprofile(Request $request, int $id)
    {  
        try {
            $user = User::findOrFail($id);
            $departments = Department::all();
            return view('main.profile.index')->with(compact('user','departments'));
        } catch (Exception $e) {
            return redirect('/dashboard');
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function updateprofile(Request $request, string $id)
    {
        try {
            $request->merge(['id' => $id]);
            if(empty($request->input('password'))){
                $request->except(['password', 'password_confirmation']);
            }
            // $request->validated();
            // dd($id);
            $this->userService->updateStaff($request->all(), $id);
            return redirect('/dashboard')->with('success_message', 'Account updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function checkNewEntry()
    {
        try {
            $latestEntry = Documents::latest()->get()->first();
            if (!$latestEntry) {
                return response()->json(['message' => 'No entries found'], 404);
            }
            return response()->json(['latestEntry' => $latestEntry], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }

    }
    public function checkPrevEntry()
    {
        try {
            $latestEntry = Documents::latest()->get()->first();
            if (!$latestEntry) {
                return response()->json(['message' => 'No entries found'], 404);
            }
            return response()->json(['latestEntry' => $latestEntry], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }

    }

    public function storeActivityLog()
    {
        try {
            $latestEntry = Documents::latest()->get()->first();

            if (!$latestEntry) {
                return response()->json(['message' => 'No latestEntry found'], 404);
            }

            /*  $latestStudentRef = Student::findOrFail($latestEntry->student_id);
             if (!$latestStudentRef) {
                 return response()->json(['message' => 'No latestStudentRef found'], 404);
             }
            */
            $employeeRef = User::findOrFail($latestEntry->added_by);
            if (!$employeeRef) {
                return response()->json(['message' => 'No employeeRef found'], 404);
            }

            $authUser = getLoggedInUser();

            $json = json_encode($latestEntry);
            //$content = 'Document '. $latestEntry->file_name. ' for student '. $latestStudentRef->student_id .'-'. $latestStudentRef->student_id.' added by '.$employeeRef->email.'-'. $employeeRef->employee_id .'.';
            $content = "{$latestEntry->updated_at}: Document {$latestEntry->file_name} for student ID:{$latestEntry->student_id} added by {$employeeRef->email} ID: {$employeeRef->employee_id}.";
            $params = [
                'content' => $content,
                'added_by' => intval($authUser->id),
                'type' => 'document',
                'log_ref_id' => intval($latestEntry->id),
            ];

            //$newLog = ActivityLog::create($params);
            // Check if the entry already exists
            $existingLog = ActivityLog::where('added_by', $params['added_by'])
                ->where('log_ref_id', $params['log_ref_id'])
                ->first();


            if ($existingLog) {
                $oneMonthAgo = Carbon::now()->subMonth();
                $current_user_records = ActivityLog::where('added_by', $params['added_by'])
                    ->where('created_at', '>=', $oneMonthAgo)
                    ->get();
                return response()->json(['message' => 'Entry already exists', 'current_user_records' => $current_user_records], 200);
            }

            $params['existingLog'] = $existingLog;

            $newLog = ActivityLog::create($params);
            if ($newLog) {
                return response()->json(['latestEntry' => $newLog], 201);
            }

            return response()->json(['message' => $params], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e], 500);
        }

    }
}
