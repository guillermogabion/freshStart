<?php

namespace App\Http\Controllers;
use App\ClassSchedule;
use Illuminate\Http\Request;

class ClassScheduleController extends Controller
{
    //
    public function index(){
        return ClassSchedule::get();
    }
}
