<?php

namespace Modules\Backend\Reaction\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Backend\Reaction\Services\BackendReactionCommandService;
use Modules\Backend\Reaction\Http\Requests\DeleteBackendReactionRequest;

final class DeleteBackendReactionAction
{
    /**
     * @OA\Delete(
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
     * )
     */
    public function __invoke(DeleteBackendReactionRequest $request, BackendReactionCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $service->delete($dto);

        return response()->message('Reaction has been successfully deleted');
    }
}
