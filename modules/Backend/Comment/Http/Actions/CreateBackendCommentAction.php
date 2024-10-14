<?php

namespace Modules\Backend\Comment\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Backend\Comment\Services\BackendCommentCommandService;
use Modules\Backend\Comment\Http\Requests\CreateBackendCommentRequest;

final class CreateBackendCommentAction
{
    /**
     * @OA\Post(
     *      path="/backend/comment",
     *      tags={"Backend - Comment"},
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="postId", type="intager"),
     *              @OA\Property(property="body", type="string"),
     *          )
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
    public function __invoke(CreateBackendCommentRequest $request, BackendCommentCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $id = $service->create($dto);

        return response()->id($id, JsonResponse::HTTP_CREATED);
    }
}
