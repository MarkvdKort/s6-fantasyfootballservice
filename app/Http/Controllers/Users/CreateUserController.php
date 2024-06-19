<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDraftRequest;
use App\Http\Requests\CreateUserRequest;
use App\Models\Draft;
use App\Models\DraftPick;
use App\Models\User;
use App\Services\DraftPickService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CreateUserController extends Controller
{
    public function __invoke(CreateUserRequest $request)
    {
        $data = $request->validated();

        $user = User::where('external_id', $data['external_id'])->first();

        if ($user) {
            return response()->json('User already exists', 409);
        }

        $user = User::create([
            'user_name' => $data['user_name'],
            'external_id' => $data['external_id'],
        ]);

        return response()->json([
            'user' => $user->user_name,
        ], 201);
    }
}
