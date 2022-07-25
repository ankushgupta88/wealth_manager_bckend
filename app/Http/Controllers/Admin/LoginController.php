<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
    */
       
    
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    //show admin page
    public function index(){
        $view =  view('admin/login');
        return $view;
    }

    //function for submit admin login form
    public function dologin(Request $request){
        request()->validate([
            'email' => 'required', 'string', 'max:255',
            'password' => 'required', 'string', 'max:255'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        // Check validation
        if (auth()->attempt(['email' => $email, 'password' => $password, 'user_type' => 'Admin'])) { 
            /*
             * Description: 
             * Params: 
             */
            $user = Auth::user();
            if ($user->user_type == "Admin") {
                return redirect('/admin/dashboard'); 
            }
        } else {
            return back()->with('unsuccess','These credentials do not match our records.!');
        }
    }
}
