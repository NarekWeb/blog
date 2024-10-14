<?php

namespace Modules\Backend\Comment\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Backend\Comment\Services\BackendCommentCommandService;
use Modules\Backend\Comment\Http\Requests\DeleteBackendCommentRequest;

final class DeleteBackendCommentAction
{
    /**
     * @OA\Delete(
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
    public function __invoke(DeleteBackendCommentRequest $request, BackendCommentCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $service->delete($dto);

        return response()->message('Comment has been successfully deleted');
    }
}
