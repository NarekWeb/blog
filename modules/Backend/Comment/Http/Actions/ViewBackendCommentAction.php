<?php

namespace Modules\Backend\Comment\Http\Actions;

use Illuminate\Http\Resources\Json\JsonResource;
use Infrastructure\Http\Resources\Backend\BackendCommentResource;
use Modules\Backend\Comment\Services\BackendCommentQueryService;
use Modules\Backend\Comment\Http\Requests\ViewBackendCommentRequest;

final class ViewBackendCommentAction
{
    /**
     * @OA\Get(
     *      path="/backend/comment/{id}",
     *      tags={"Backend - Comment"},
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
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="data", ref="#/components/schemas/BackendCommentSchema"),
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
    public function __invoke(ViewBackendCommentRequest $request, BackendCommentQueryService $service): JsonResource
    {
        $dto = $request->toDto();
        $comment = $service->view($dto);

        return new BackendCommentResource($comment);
    }
}
