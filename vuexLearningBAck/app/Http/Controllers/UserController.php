<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
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
        $user = User::where('email', $request->email)->where('request', 1)->first();
        
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
            'id_number' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('id_number', $request->id_number)->first();
        
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
        $user->user_type = 1;
        if($request->password){
            $user->password = Hash::make($request->password);
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
            'email' => 'required|email|unique:users,email,',
            'phone' => 'required|unique:users,phone,',
            'id_number' => 'required|unique:users',
            'date_birth' => 'required',
            'place_birth' => 'required',
            'nationality' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'course' => 'required',
            'year' => 'required',
            'contact' => 'required',
            'contact_guardian' => 'required',
            'guardian' => 'required',
            'civil_status' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
       
        $user->id_number = $request->id_number;
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->date_birth = $request->date_birth;
        $user->place_birth = $request->place_birth;
        $user->nationality = $request->nationality;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->course = $request->course;
        $user->year = $request->year;
        $user->contact = $request->contact;
        $user->contact_guardian = $request->contact_guardian;
        $user->guardian = $request->guardian;
        $user->religion = $request->religion;
        $user->civil_status = $request->civil_status;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->photo){
            $image = $request->photo;  // your base64 encoded
            list($type, $image) = explode(';', $image);
            list(, $image)      = explode(',', $image);
            $data = base64_decode($image);
            $imageName = date("YmdHis"). '.' . 'jpeg';
            file_put_contents(public_path() . '/' . 'images/profile/' . $imageName, $data);
            $user->photo = $imageName ;
         } 
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->user_type = 0;
        $user->save();
        return $user;
    }

    public function number(){
        // $date = Carbon::now()->format('y');
        // $randomNumber = random_int(1000, 9999);
        // $user = User::where('id_number', $number)->first();

        // if($user == !null) {
        //     $id = $date . $randomNumber;
        //     return $id;
        // }else{
        //     $id = $date . $randomNumber;
        //     return $id;
        // }
        $date = Carbon::now()->format('y');
        $randomNumber = random_int(1000, 9999);
        $id = $date . $randomNumber;
        return $id;
        // return $user;
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
        return $user->orderBy('lastname', 'asc')->get();
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
        return $users->orderBy('lastname', 'asc')->paginate(10);
    }
    public function searchInstructor(Request $request) 
    {
        $user = User::query();
        $user->where('user_type', 2);
        if ($request->input('searchkey') != "") {
            $keyword = $request->input('searchkey');
            $user->where(function($query) use($keyword) {
                $query  ->where('firstname', 'LIKE', "%$keyword%")
                        ->orWhere('lastname', 'LIKE', "%$keyword%")
                        ->orWhere('email', 'LIKE', "%$keyword%");
                         
            });
        }
        return $user->orderBy('lastname', 'asc')->get();
    }

    public function paginationInstructor(Request $request){
        $users = User::query();
        $users->where('user_type', '!=', 0 );
        if($request->input('keyword') != ""){
            $keyword = $request->input('keyword');
            $users->where(function($query) use($keyword){
                $query   ->where('firstname', 'LIKE', "%$keyword%");
                      
            });
        }
        return $users->orderBy('lastname', 'asc')->paginate(10);
    }

    public function ApprovalRequest($id_number){

        $users = User::where('id_number', $id_number)->first();
        if($users->request == 1){
            return 'Request already Granted';
        }
        else {
            return 'Request Pending';
        }
       
        // else {
        //     $users->update(['request' => 2]);
        //     return 'Request Sent';
        // }
        // if

        // $users = User::where('id_number', $id_number)->update(['request' => 1]);
        // return 'Request Sent';
    }
    public function show($id){
        return User::find($id);
    }
    public function editProfile(Request $request, $id){
        $user = User::findorfail($id);
        $user->id_number = $request->id_number;
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->date_birth = $request->date_birth;
        $user->place_birth = $request->place_birth;
        $user->nationality = $request->nationality;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->course = $request->course;
        $user->year = $request->year;
        $user->contact = $request->contact;
        $user->contact_guardian = $request->contact_guardian;
        $user->guardian = $request->guardian;
        $user->religion = $request->religion;
        $user->civil_status = $request->civil_status;
        $user->email = $request->email;
        if($request->photo){
            $image = $request->photo;  // your base64 encoded
            list($type, $image) = explode(';', $image);
            list(, $image)      = explode(',', $image);
            $data = base64_decode($image);
            $imageName = date("YmdHis"). '.' . 'jpeg';
            file_put_contents(public_path() . '/' . 'images/profile/' . $imageName, $data);
            $user->photo = $imageName ;
         } 
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->user_type = 0;
        $user->save();
        return $user;

    }
   
}
