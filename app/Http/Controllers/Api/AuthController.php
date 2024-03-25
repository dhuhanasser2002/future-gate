<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
<<<<<<< HEAD

class AuthController extends Controller
{
    //
}
=======
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validateData = $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'required|string|email:rfc,dns|max:255|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'image'=>'image|Mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_name = time() .'.'. $image->getClientOriginalExtension();
                $image->move(public_path('images'), $image_name);
                $user->image = $image_name;}
            $user->save();
            $token = $user->createToken($validateData['email'])->plainTextToken;
            $response = [
                'status' => 'success',
                'message' => 'user is created successfully',
                'data' => [
                    'token' => $token,
                    'user' => $user,
                ],
            ];
            return response()->json($response,200);
    }
    public function login(Request $request){
        $validateData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user||!Hash::check($request->password,$user->password)){
            return response()->json([
                'status'=> 'faild',
                'message' => 'invalid credentials'
            ], 401);
        }
        $token = $user->createToken('token-name')->plainTextToken;
        $response = [
            'status' => 'success',
            'message' => 'user is loged in successfully',
            'data' => [
                'token' => $token,
                'user' => $user
            ]
            ];
            return response()->json($response,200);
    }
    function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'user is loged out successfully'
        ], 201);
    }
}
>>>>>>> 5ca0266a9a15a95057f6f6749df01449320d15c9
