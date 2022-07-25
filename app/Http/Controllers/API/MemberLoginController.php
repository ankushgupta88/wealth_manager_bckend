<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

use App\Models\User;
use Validator;

class MemberLoginController extends Controller
{   

    public function index(Request $request)
    {   
        //Check email exit or not
        $emailvalidator = Validator::make($request->all(), [
            'email'     => 'required|email|unique:users,email',
        ]);
        
        //Validation
        $validator = Validator::make($request->all(), [
            'email'    => 'required',
            'password' => 'required|min:6',
        ]);
         
        
        if($validator->fails()){
            return response()->json([
                        "status"  => 201,
                        "message" => "Please fill email and password!",
                        "data"    => "", 
                    ], 201);
        }else {
            //Check email and password 
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                    $user = Auth::user();
 
                    $success['accessToken'] =  $user->createToken('MyApp')->accessToken; 
                    
                    return response()->json([
                        "status"  => 200,
                        "message" => "Member login successfully..",
                        "data"    => $success, 
                    ], 200);
            } 
            else{
                return response()->json([
                        "status"  => 201,
                        "message" => "Invalid email and password",
                        "data"    => "", 
                    ], 201);
            }
        }
    }
}
