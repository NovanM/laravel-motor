<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Pelanggan;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function login(Request $request){
        try{
            $request->validate([
                'username' => 'required',
                'password'=>'required'
            ]);

            $credentials = request(['username','password']);

            if(!Auth::attempt($credentials)){
                return ResponseFormatter::error([
                    'message'=>'Unauthorized',
                    
                ],'Authentication Failed',500);
            }

            $user = User::where('username',$request->username)->first();
            if(!Hash::check($request->password,$user->password)){
                throw new \Exception('Invalid Credentials');
            }


            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success(
                [
                    'access_token'=>$tokenResult,
                    'token_type'=>'Bearer',
                    'user'=>$user
                ],'Authenticated'
            );
        }catch(Exception $e){
            return ResponseFormatter::error([
                'message'=>'Something Wrong',
                'error'=>$e
            ],'Authenticate Failed' ,500);
        }
    }
    
    public function register(Request $request)     
    {
        try {
            $request->validate([
            'username' => ['required','string','max:255'],
            'email'=>['required','string','email','max:255','unique:users'],
            'password'=>['required','max:255']
            ]);

            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'telepon'=>$request->telepon,
                'username'=>$request->username,
                'password'=>Hash::make($request->password),
            ]);
           
            $user = User::where('username',$request->username)->first();
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            Pelanggan::create([
                'user_id'=>$user->id,
            ]);
            return ResponseFormatter::success(
                [
                    'access_token'=>$tokenResult,
                    'token_type'=>'Bearer',
                    'user'=>$user
                ],'Registered   '
            );
        } catch(Exception $e){
            return ResponseFormatter::error([
                'message'=>'Something Wrong',
                'error'=>$e
            ],'Register Failed' ,500);
        }
    }


    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();
        return ResponseFormatter::success($token,'Token Revoked');
    }

    public function fetchUser(Request $request)

    {
        $user = User::with(['pelanggan'])->where('id', $request->user()->id)->first();
        return ResponseFormatter::success([
            'email'=>$user->email,
            'name'=>$user->name,
            'telepon'=>$user->telepon,
            'alamat'=>$user->pelanggan->alamat,
            'koordinator_lokasi'=>$user->pelanggan->koordinator_lokasi,
        ], "Data user Profile");
    }


    public function updateProfile(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $user->update($data);
        $pelanggan = Pelanggan::where('user_id',$user->id)->first();
        $pelanggan->update($data);

        return ResponseFormatter::success($user, 'Profile Updated');
    }
}
