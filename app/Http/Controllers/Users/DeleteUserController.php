<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDraftRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\DeleteUserRequest;
use App\Models\Draft;
use App\Models\DraftPick;
use App\Models\User;
use App\Services\DraftPickService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeleteUserController extends Controller
{
    public function __invoke(DeleteUserRequest $request)
    {
        $data = $request->validated();

        $user = User::where('external_id', $data['external_id'])->first();

        if (!$user) {
            return response()->json('User not found', 404);
        }

        $user->delete();

        return response()->json('User deleted', 201);
    }
}
