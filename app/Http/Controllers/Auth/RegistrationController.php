<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Services\Interfaces\Auth\RegistrationInterface;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class RegistrationController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/registration",
     *     summary="New user registration",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password_confirmation",
     *                     type="string"
     *                 ),
     *                 example={"name": "test-name", "email": "test@mail.com", "password": 12345678, "password_confirmation": 12345678}
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
     *                  property="name",
     *                  type="string",
     *              ),
     *              example={"success": {"token": "20d338931e8d6bd9466edeba78ea7dce7c7bc01aa5cc5b4735691c50a2fe3228", "name": "test"}}
     *          )
     *     )
     * )
     *
     * @param RegistrationRequest $request
     * @param RegistrationInterface $registrationService
     * @return JsonResponse
     */
    public function register(RegistrationRequest $request, RegistrationInterface $registrationService): JsonResponse
    {
        $data = $request->validated();

        $result = $registrationService->register($data['name'], $data['email'], $data['password']);

        return response()->json(['success' => $result]);
    }
}
