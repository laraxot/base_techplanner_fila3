<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Users\CreateUserAction;
use App\Data\UserData;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index()
    {
        $users = QueryBuilder::for(User::class)
            ->allowedFilters(['name', 'email'])
            ->allowedSorts(['name', 'email', 'created_at'])
            ->paginate();

        return response()->json($users);
    }

    public function store(UserRequest $request, CreateUserAction $createUser)
    {
        $userData = UserData::from($request->validated());
        $user = $createUser->execute($userData);

        return response()->json($user, 201);
    }
}
