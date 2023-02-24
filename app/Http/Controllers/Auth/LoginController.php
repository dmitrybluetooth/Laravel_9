<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Interfaces\Auth\LoginInterface;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login a user",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     description="User email",
     *                     type="string",
     *                     example="test@gmail.com"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="User password",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="remember",
     *                     type="bool"
     *                 ),
     *                 example={"email": "test@mail.com", "password": 12345678, "remember": false}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  type="string",
     *                  default="20d338931e8d6bd9466edeba78ea7dce7c7bc01aa5cc5b4735691c50a2fe3228",
     *                  description="token",
     *                  property="token"
     *              ),
     *              @OA\Property(
     *                  property="userId",
     *                  type="int",
     *              ),
     *              example={"success": {"token": "20d338931e8d6bd9466edeba78ea7dce7c7bc01aa5cc5b4735691c50a2fe3228", "userId": 1}}
     *          )
     *     ),
     *     @OA\Response(response="401", description="Unauthorized"),
     * )
     *
     * @param LoginRequest $request
     * @param LoginInterface $loginService
     * @return JsonResponse
     */
    public function login(LoginRequest $request, LoginInterface $loginService): JsonResponse
    {
        $data = $request->validated();

        $result = $loginService->login($data['email'], $data['password'], $data['remember']);

        return $result
            ? response()->json(['success' => $result])
            : response()->json(['error'=>'Unauthorised'], 401);
    }

    /**
     * @param LoginInterface $loginService
     * @return JsonResponse
     */
    public function logout(LoginInterface $loginService): JsonResponse
    {
        $loginService->logout();

        return new JsonResponse([], 204);
    }
}
