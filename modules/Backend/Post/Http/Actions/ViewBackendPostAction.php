<?php

namespace Modules\Backend\Post\Http\Actions;

use Illuminate\Http\Resources\Json\JsonResource;
use Infrastructure\Http\Resources\Backend\BackendPostResource;
use Modules\Backend\Post\Services\BackendPostQueryService;
use Modules\Backend\Post\Http\Request\ViewBackendPostRequest;

final class ViewBackendPostAction
{
    /**
     * @OA\Get(
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
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="data", ref="#/components/schemas/BackendPostSchema"),
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
    public function __invoke(ViewBackendPostRequest $request, BackendPostQueryService $service): JsonResource
    {
        $dto = $request->toDto();
        $post = $service->view($dto);

        return new BackendPostResource($post);
    }
}
