<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Services\StoreUserAction;
use App\Traits\ManageFiles;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ManageFiles;

    public function register(StoreUserRequest $request, StoreUserAction $storeUserAction): JsonResponse
    {
        try {
            $request->validated();
            $data =  $storeUserAction->execute($request);
            return response()->json([
                'status' => true,
                'data' => $data,
                'message' => 'User created successfully and Send Verfiy Code'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'false',
                'data' => [],
                'message' => $e->getMessage()
            ], 500);
        }
    }
}