<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class DashboardController extends Controller
{
    //function for admin dashboartd
    public function index(){
        $view =  view('admin.dashboard');
        return $view;
    }
    
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function logout(Request $request)
    {
        $user = Auth::user();
		if ($user->user_type == "Admin") {
		    $request->session()->flush();
        	$request->session()->regenerate();
        	return redirect('/admin-login');
		}
    }
}
