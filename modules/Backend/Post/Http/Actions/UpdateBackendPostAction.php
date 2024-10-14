<?php

namespace Modules\Backend\Post\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Backend\Post\Services\BackendPostCommandService;
use Modules\Backend\Post\Http\Request\UpdateBackendPostRequest;

final class UpdateBackendPostAction
{
    /**
     * @OA\Put(
     *      path="/backend/post/{id}",
     *      tags={"Backend - Post"},
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          parameter="id",
     *          @OA\Schema(type="integer"),
     *          in="path",
     *          required=true,
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *               @OA\Property(property="title", type="string"),
     *               @OA\Property(property="content", type="string"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/MessageSchema",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ErrorMessageSchema",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ErrorMessageSchema",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation Error",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ErrorBagSchema",
     *          ),
     *      ),
     * )
     */
    public function __invoke(UpdateBackendPostRequest $request, BackendPostCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $service->update($dto);

        return response()->message('Post has been successfully updated');
    }
}
