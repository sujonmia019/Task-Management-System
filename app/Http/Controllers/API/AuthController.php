<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\API\LoginRequest;
use App\Http\Requests\API\RegisterRequest;

class AuthController extends Controller
{
    /**
     * New user registration
     *
     * @param App\Http\Requests\API\RegisterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => $request->password,
            ]);

            if($user){
                return $this->response_json('success','User Register Successfull.',$user, 201);
            }else{
                return $this->response_json('error','User Register Failed.', 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);

        }
    }

    /**
     * User login with bearer token generate
     *
     * @param App\Http\Requests\API\LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $email    = $request->email;
        $password = $request->password;

        $user = User::where('email',$email)->first();
        if($user){
            if(!Hash::check($password, $user->password)){
                return $this->response_json('error','Password Does Not Match!',null,401);
            }else{
                // Generate token
                $data['token'] = $user->createToken($user->email)->plainTextToken;
                $user->update(['access_token'=>$data['token']]);
                return $this->response_json('success','Login Access Token',$data,200);
            }
        }else{
            return $this->response_json('error','Email Does Not Match!',null,401);
        }
    }

    /**
     * User logout with bearer token delete
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->response_json('success','User Logout successfull.',200);
    }
}
