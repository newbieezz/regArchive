<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentsRecordController extends Controller
{
    public function view(){
        return view('registrar_files.student_records');
    }
}
