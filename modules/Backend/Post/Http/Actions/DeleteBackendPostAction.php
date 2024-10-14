<?php

namespace Modules\Backend\Post\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Backend\Post\Services\BackendPostCommandService;
use Modules\Backend\Post\Http\Request\DeleteBackendPostRequest;

final class DeleteBackendPostAction
{
    /**
     * @OA\Delete(
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
    public function __invoke(DeleteBackendPostRequest $request, BackendPostCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $service->delete($dto);

        return response()->message('Post has been successfully deleted');
    }
}
