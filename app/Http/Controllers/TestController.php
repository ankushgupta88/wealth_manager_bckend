<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
use App\Http\Controllers\API\BaseController as BaseController;
  
class TestController extends BaseController  ///extends Controller
{
    public function createStudent(Request $request) {
    	die('=============');
	    $student = new Student;
	    $student->name = $request->name;
	    $student->course = $request->course;
	    $student->save();


	    return response()->json([
	        "message" => "student record created"
	    ], 201);
	  }
}
