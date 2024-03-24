<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollegeDeptController extends Controller
{
    public function view(){
        return view('registrar_files.college_dept');
    }
}
