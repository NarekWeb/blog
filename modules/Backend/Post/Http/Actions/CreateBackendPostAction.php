<?php

namespace Modules\Backend\Post\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Backend\Post\Services\BackendPostCommandService;
use Modules\Backend\Post\Http\Request\CreateBackendPostRequest;

final class CreateBackendPostAction
{
    /**
     * @OA\Post(
     *      path="/backend/post",
     *      tags={"Backend - Post"},
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="title", type="string"),
     *              @OA\Property(property="content", type="string"),*          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/IdSchema",
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
    public function __invoke(CreateBackendPostRequest $request, BackendPostCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $id = $service->create($dto);

        return response()->id($id, JsonResponse::HTTP_CREATED);
    }
}
