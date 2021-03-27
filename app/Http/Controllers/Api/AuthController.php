<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(["serverResponse" => [
                "code" => 401,
                "message" => "User Details Not Found",
                "isSuccess" => false
            ],], 200);
        }
        $userdetails= User::with('roles')->find(auth()->user()->id);
        return response()->json([
            "serverResponse" => [
                "code" => 200,
                "message" => "User Details Fetched Successfully",
                "isSuccess" => true
            ],
            "result" => [
                "user_details" =>new UserResource($userdetails),
                "token_details" =>$this->respondWithToken($token)
            ]
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(["serverResponse" => [
                    "code" => 401,
                    "message" => 'user_not_found',
                    "isSuccess" => false
                ]], 404);
            }else{
                return response()->json(auth()->user());
            }
        } catch (TokenExpiredException $e) {
                return response()->json(["serverResponse" => [
                    "code" => 401,
                    "message" => 'token_expired',
                    "isSuccess" => false
                ]], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
                return response()->json(["serverResponse" => [
                    "code" => 401,
                    "message" => 'token_invalid',
                    "isSuccess" => false
                ]], $e->getStatusCode());
        } catch (JWTException $e) {
                return response()->json(["serverResponse" => [
                    "code" => 401,
                    "message" => 'token_absent',
                    "isSuccess" => false
                ]], $e->getStatusCode());
        }
        return response()->json([
            "serverResponse" => [
                "code" => 401,
                "message" => "User Details Not Found",
                "isSuccess" => false
            ]
            ]);
        // return response()->json(auth()->user());
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
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(["serverResponse" => [
                    "code" => 401,
                    "message" => 'user_not_found',
                    "isSuccess" => false
                ]], 404);
            }else{
                return response()->json(["serverResponse" => [
                    "code" => 401,
                    "message" => 'user_not_found',
                    "isSuccess" => false
                ],"result"=>$this->respondWithToken(auth()->refresh(true,true))]);
            }
        } catch (TokenExpiredException $e) {
                return response()->json(["serverResponse" => [
                    "code" => 401,
                    "message" => 'token_expired',
                    "isSuccess" => false
                ]], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
                return response()->json(["serverResponse" => [
                    "code" => 401,
                    "message" => 'token_invalid',
                    "isSuccess" => false
                ]], $e->getStatusCode());
        } catch (JWTException $e) {
                return response()->json(["serverResponse" => [
                    "code" => 401,
                    "message" => 'token_absent',
                    "isSuccess" => false
                ]], $e->getStatusCode());
        }
        return response()->json([
            "serverResponse" => [
                "code" => 401,
                "message" => "User Details Not Found",
                "isSuccess" => false
            ]
            ]);

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
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
