<?php

namespace Modules\Backend\Post\Http\Actions;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Infrastructure\Http\Resources\Backend\BackendPostResource;
use Modules\Backend\Post\Services\BackendPostQueryService;
use Modules\Backend\Post\Http\Request\QueryBackendPostRequest;

final class QueryBackendPostAction
{
    /**
     * @OA\Get(
     *      path="/backend/post",
     *      tags={"Backend - Post"},
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
     *                  @OA\Items(ref="#/components/schemas/BackendPostSchema")
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
    public function __invoke(QueryBackendPostRequest $request, BackendPostQueryService $service): ResourceCollection
    {
        $dto = $request->toDto();
        $posts = $service->query($dto);

        return BackendPostResource::collection($posts);
    }
}
