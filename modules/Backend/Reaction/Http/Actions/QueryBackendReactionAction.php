<?php

namespace Modules\Backend\Reaction\Http\Actions;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Infrastructure\Http\Resources\Backend\BackendReactionResource;
use Modules\Backend\Reaction\Services\BackendReactionQueryService;
use Modules\Backend\Reaction\Http\Requests\QueryBackendReactionRequest;

final class QueryBackendReactionAction
{
    /**
     * @OA\Get(
     *      path="/backend/reaction",
     *      tags={"Backend - Reaction"},
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
     *                  @OA\Items(ref="#/components/schemas/BackendReactionSchema")
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
    public function __invoke(QueryBackendReactionRequest $request, BackendReactionQueryService $service): ResourceCollection
    {
        $dto = $request->toDto();
        $reactions = $service->query($dto);

        return BackendReactionResource::collection($reactions);
    }
}
