<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserCreateService;
use App\Services\UserUpdateService;
use App\Services\UserListService;
use App\Services\UserDeleteService;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    protected $userCreateService;
    protected $userUpdateService;
    protected $userListService;
    protected $userDeleteService;

    public function __construct(
        UserCreateService $userCreateService,
        UserUpdateService $userUpdateService,
        UserListService $userListService,
        UserDeleteService $userDeleteService
    ) {
        $this->userCreateService = $userCreateService;
        $this->userUpdateService = $userUpdateService;
        $this->userListService = $userListService;
        $this->userDeleteService = $userDeleteService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userListService->execute();

        return [
            'status' => 200,
            'mensagem' => 'Usuários encontrados!!',
            'users' => $users
        ];
    }

    /**
     * Show the form for the logged-in user.
     */
    public function me()
    {
        $user = Auth::user();

        return [
            'status' => 200,
            'message' => 'Usuário logado!',
            "user" => $user
        ];
    }

    /**
     * Store a newly created user.
     */
    public function store(UserCreateRequest $request)
    {
        $user = $this->userCreateService->execute($request->all());

        return [
            'status' => 200,
            'mensagem' => 'Usuário cadastrado com sucesso!!',
            'user' => $user
        ];
    }

    /**
     * Display the specified user.
     */
    public function show(string $id)
    {
        $user = $this->userListService->find($id);

        if (!$user) {
            return [
                'status' => 404,
                'message' => 'Usuário não encontrado!',
                'user' => null
            ];
        }

        return [
            'status' => 200,
            'message' => 'Usuário encontrado!',
            'user' => $user
        ];
    }

    /**
     * Update the specified user.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $user = $this->userUpdateService->execute($id, $request->all());

        if (!$user) {
            return [
                'status' => 404,
                'message' => 'Usuário não encontrado!',
                'user' => null
            ];
        }

        return [
            'status' => 200,
            'message' => 'Usuário atualizado com sucesso!!',
            'user' => $user
        ];
    }

    /**
     * Remove the specified user.
     */
    public function destroy(string $id)
    {
        $user = $this->userDeleteService->execute($id);

        if (!$user) {
            return [
                'status' => 404,
                'message' => 'Usuário não encontrado!',
            ];
        }

        return [
            'status' => 200,
            'message' => 'Usuário deletado com sucesso!!',
        ];
    }
}
