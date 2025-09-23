<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Login user and return API token
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = Auth::user();
        $token = $user->createToken('api-token', ['*'], now()->addDays(30))->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'company_id' => $user->company_id,
            ],
            'expires_at' => now()->addDays(30)->toISOString(),
        ]);
    }

    /**
     * Get current authenticated user
     */
    public function me(Request $request)
    {
        $user = $request->user();
        
        return response()->json([
            'success' => true,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'company_id' => $user->company_id,
                'job_title' => $user->job_title,
                'phone' => $user->phone,
            ],
        ]);
    }

    /**
     * Logout user and revoke token
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully',
        ]);
    }

    /**
     * Create a new API token for the user
     */
    public function createToken(Request $request)
    {
        $request->validate([
            'token_name' => 'required|string|max:255',
        ]);

        $user = $request->user();
        $token = $user->createToken($request->token_name, ['*'], now()->addDays(7))->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Token created successfully',
            'token' => $token,
            'token_name' => $request->token_name,
            'expires_at' => now()->addDays(30)->toISOString(),
        ]);
    }

    /**
     * List all user's API tokens
     */
    public function tokens(Request $request)
    {
        $user = $request->user();
        $tokens = $user->tokens()->select(['id', 'name', 'created_at', 'last_used_at'])->get();

        return response()->json([
            'success' => true,
            'tokens' => $tokens,
        ]);
    }

    /**
     * Revoke a specific token
     */
    public function revokeToken(Request $request, $tokenId)
    {
        $user = $request->user();
        $token = $user->tokens()->where('id', $tokenId)->first();

        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Token not found',
            ], 404);
        }

        $token->delete();

        return response()->json([
            'success' => true,
            'message' => 'Token revoked successfully',
        ]);
    }
}
