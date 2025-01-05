<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\BadRequestException;
use App\Http\Attributes\Models\CategorySchema;
use App\Http\Attributes\Properties\StringProperty;
use App\Http\Attributes\Responses\EntityResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Response;

class LoginController extends Controller
{
    #[
        Post(
            path: '/api/login',
            operationId: 'login',
            summary: 'login',
            requestBody: new RequestBody(content: new JsonContent(properties: [
                new StringProperty('email'),
                new StringProperty('password'),
            ])),
            tags: ['Login'],
            responses: [
                new Response(
                    response: 200,
                    description: 'Success',
                    content: new JsonContent(properties: [
                        new StringProperty('access_token'),
                    ])
                ),
            ],
        )
    ]
    public function index(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            throw new BadRequestException('Неправильный логин или пароль');
        }

        $user = User::where('email', $request->email)->first();

        if (!Hash::check($request->password, $user->password, [])) {
            throw new BadRequestException('Неправильный логин или пароль');
        }

        $tokenResult = $user->createToken('authToken')->plainTextToken;
        return $this->responseSuccess([
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
            'user' => new UserResource($user),
        ]);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'Logout successfull',
        ]);
    }
}
