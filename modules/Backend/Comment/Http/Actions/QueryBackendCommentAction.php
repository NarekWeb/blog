<?php

namespace Modules\Backend\Comment\Http\Actions;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Infrastructure\Http\Resources\Backend\BackendCommentResource;
use Modules\Backend\Comment\Services\BackendCommentQueryService;
use Modules\Backend\Comment\Http\Requests\QueryBackendCommentRequest;

final class QueryBackendCommentAction
{
    /**
     * @OA\Get(
     *      path="/backend/comment",
     *      tags={"Backend - Comment"},
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/BackendCommentSchema")
     *              ),
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
     * )
     */
    public function __invoke(QueryBackendCommentRequest $request, BackendCommentQueryService $service): ResourceCollection
    {
        $dto = $request->toDto();
        $comments = $service->query($dto);

        return BackendCommentResource::collection($comments);
    }
}
