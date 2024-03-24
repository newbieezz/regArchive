<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnrollmentRecordController extends Controller
{
    public function view(){
        return view('registrar_files.enrollment_records');
    }
}
