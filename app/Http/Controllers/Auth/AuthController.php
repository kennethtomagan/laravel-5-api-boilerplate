<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Hashing\BcryptHasher;
use JWTFactory;
use JWTAuth;
use Carbon\Carbon;
use App\Models\Users\User;

class AuthController extends Controller
{
    /**
     * Login
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user) return response()->json(['error' => 'User not found.'], 404);

        // Account Validation
        if (!(new BcryptHasher)->check($request->input('password'), $user->password)) {

            return response()->json(['error' => 'Email or password is incorrect. Authentication failed.'], 401);
        }

        // Login Attempt
        $credentials = $request->only('email', 'password');

        try {

            // JWTAuth::factory()->setTTL(40320); // Expired Time 28days

            if (! $token = JWTAuth::attempt($credentials, ['exp' => Carbon::now()->addDays(28)->timestamp])) {

                return response()->json(['error' => 'invalid_credentials'], 401);

            }
        } catch (JWTException $e) {

            return response()->json(['error' => 'could_not_create_token'], 500);

        }

        return response()->json(compact('token', 'user'));

    }
}
