<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    /**
     * Sign up.
     *
     * @param  StoreUserRequest  $request
     * @return JsonResponse
     */
    public function register(StoreUserRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        $success['token'] = $user->createToken(Str::random(60))->plainTextToken;
        $success['name'] = $user->name;

        return $this->handleResponse($success, 'User successfully registered!');
    }

    /**
     * Get a JWT via given credentials.
     */
    public function login(Request $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            $success['token'] = $auth->createToken(Str::random(60))->plainTextToken;
            $success['name'] = $auth->name;

            return $this->handleResponse($success, 'User logged-in!');
        } else {
            return $this->handleError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    /**
     * Get the authenticated User.
     */
    public function user(): UserResource
    {
        return new UserResource(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->user()->currentAccessToken()->delete();

        return $this->handleResponse('', 'Successfully logout!');
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        $user = auth()->user();
        $user->currentAccessToken()->delete();
        return response()->json([
            'token' => $user->createToken(Str::random(60))->plainTextToken,
            'message' => __('messages.been_changed'),
        ]);
    }


}


