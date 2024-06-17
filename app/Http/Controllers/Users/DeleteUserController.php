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

class DeleteUserController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validated();

        $user = User::where('external_id', $data['external_id'])->first();

        $user->fantasyTeams()->detach();

        $user->delete();

        return response()->json('User deleted', 201);
    }
}
