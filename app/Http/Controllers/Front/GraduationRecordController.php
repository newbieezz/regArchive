<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GraduationRecordController extends Controller
{
    public function view(){
        return view('registrar_files.graduation_records');
    }
}
