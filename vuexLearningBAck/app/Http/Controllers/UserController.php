<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(Request $request){
        return $request->user();
    }

    public function self()
    {
        $user = User::find(auth()->user()->id);
        $token = $user->createToken('authToken')->accessToken;
        return response(['user' => $user, 'access_token' => $token]);
    }
    
    public function login(Request $request)
    {
        $login = $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        
        // return $user;
        if (!Auth::attempt( $login ))
        {
            return response(['message' => 'login Credentials are incorrect'], 401);
        }
        $token = $user->createToken('authToken')->accessToken;
        return response(['user' => Auth::user(), 'access_token' => $token] );
       
    }
    public function loginID(Request $request)
    {
        $login = $this->validate($request, [
            'idnumber' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('idnumber', $request->idnumber)->first();
        
        // return $user;
        if (!Auth::attempt( $login ))
        {
            return response(['message' => 'login Credentials are incorrect'], 401);
        }
        $token = $user->createToken('authToken')->accessToken;
        return response(['user' => Auth::user(), 'access_token' => $token] );
       
    }
    
    public function logout(Request $request)
    {
        $request->user()->tokem()->delete();
    }
    // public function index(){
    //     return User::get();
    // }

    public function saveNew(Request $request) 
    {
        $user = New User;
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email,',
            'phone' => 'required|unique:users,phone,'
        ]);
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        if($request->user_type){
            $user->user_type = $request->user_type;
        }
        $user->save();
        return $user;

    }

    public function editUser(Request $request, $id){
        $user = User::findorfail($id);
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->user_type){
            $user->user_type = $request->user_type;
        }
        $user->save();
        return $user;

    }
    public function pagination(Request $request){
        $users = User::query();
        $users->where('user_type', 0);
        if($request->input('keyword') != ""){
            $keyword = $request->input('keyword');
            $users->where(function($query) use($keyword){
                $query   ->where('firstname', 'LIKE', "%$keyword%");
                      
            });
        }
        return $users->orderBy('firstname', 'asc')->paginate(10);
    }
    public function search(Request $request) 
    {
        $user = User::query();
        $user->where('user_type', 0);
        if ($request->input('searchkey') != "") {
            $keyword = $request->input('searchkey');
            $user->where(function($query) use($keyword) {
                $query  ->where('firstname', 'LIKE', "%$keyword%")
                        ->orWhere('lastname', 'LIKE', "%$keyword%")
                        ->orWhere('email', 'LIKE', "%$keyword%");
                         
            });
        }
        return $user->orderBy('first_name', 'asc')->get();
    }

    public function deleteUser($id){
        $user = User::find($id);
        $user->delete();
        return 'Deleted';
    }

    public function loginTrial(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password'=>'required'
        ]);
        if (Auth::attempt($credentials)){
            $user = Auth::user();
            $token = md5( time() ).'.'.md5($request->email);
            $user->forceFill([
                'api_token' => $token,
            ])->save();
            return response()->json([
                'token' => $token
            ]);
        }
        return response()->json([
            'message' => 'The provided credentials is incorrect'
        ], 401);
    }

    public function logout2(Request $request) {
        $request->user()->forceFill([
            'api_token'=>null,
        ])->save();

        return response()->json(['message'=>'success']);
    }

    public function newEnrollee(Request $request){
        $user = New User;
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'guardian' => 'required',
            'religion' => 'required',
            'civil_status' => 'required',
            'email' => 'required|email|unique:users,email,',
            'phone' => 'required|unique:users,phone,'

        ]);
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->guardian = $request->guardian;
        $user->religion = $request->religion;
        $user->civil_status = $request->civil_status;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->user_type = 0;
        $user->save();
        return $user();
    }
}
