<?php

namespace Modules\Backend\Reaction\Http\Actions;

use Illuminate\Http\Resources\Json\JsonResource;
use Infrastructure\Http\Resources\Backend\BackendReactionResource;
use Modules\Backend\Reaction\Services\BackendReactionQueryService;
use Modules\Backend\Reaction\Http\Requests\ViewBackendReactionRequest;

final class ViewBackendReactionAction
{
    /**
     * @OA\Get(
     *      path="/backend/reaction/{id}",
     *      tags={"Backend - Reaction"},
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
     *              @OA\Property(property="data", ref="#/components/schemas/BackendReactionSchema"),
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
    public function __invoke(ViewBackendReactionRequest $request, BackendReactionQueryService $service): JsonResource
    {
        $dto = $request->toDto();
        $reaction = $service->view($dto);

        return new BackendReactionResource($reaction);
    }
}
