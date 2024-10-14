<?php

namespace Modules\Backend\Reaction\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Backend\Reaction\Services\BackendReactionCommandService;
use Modules\Backend\Reaction\Http\Requests\CreateBackendReactionRequest;

final class CreateBackendReactionAction
{
    /**
     * @OA\Post(
     *      path="/backend/reaction",
     *      tags={"Backend - Reaction"},
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="commentId", type="intager"),
     *              @OA\Property(property="reactionType", type="string"),
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
    public function __invoke(CreateBackendReactionRequest $request, BackendReactionCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $id = $service->create($dto);

        return response()->id($id, JsonResponse::HTTP_CREATED);
    }
}
