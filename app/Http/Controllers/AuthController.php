<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login','signup','me']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validation = $request->validate([
           'email' => 'required',
           'password' => 'required'
        ]);
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Incorrect Email Or Password'], 401);
        }

        return $this->respondWithToken($token);
    }

   
    public function signup (Request $request)
    {
       $validatuion = $request->validate([
         'name' => 'required',
         'password' => 'required|confirmed',
         'email' => 'email|required|unique:users'
       ]);

    
       User::create([
         'name' => $request->name,
         'password' => Hash::make($request->password),
         'email' => $request->email
       ]);

      return   $this->login($request);

    }




    public function me($token)
    { 
      
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,

        ]);
    }
}
