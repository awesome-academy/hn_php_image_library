<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPutRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $users = $this->repository->getSearch($request['search']);

        return view('admin.users.user_index', ['users' => $users]);
    }

    public function create(RoleRepositoryInterface $roleRepository)
    {
        $roles = $roleRepository->getAllRole();

        return view('admin.users.user_create', [
            'roles' => $roles,
        ]);
    }

    public function store(UserRequest $request)
    {
        $request['is_active'] = ($request['is_active'] == 'on') ? 1 : 0;
        $this->repository->adminCreate($request);

        return redirect()->route('users.index')
            ->with('success', __('create_success', ['name' => __('user')]));
    }

    public function edit(RoleRepositoryInterface $roleRepository, User $user)
    {
        $roles = $roleRepository->getAllRole();

        return view('admin.users.user_create', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(UserPutRequest $request, User $user)
    {
        $request['is_active'] = ($request['is_active'] == 'on') ? 1 : 0;
        $this->repository->adminUpdate($user, $request);

        return redirect()->route('users.index')
            ->with('success', __('update_success', ['name' => __('user')]));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', __('delete_success', ['name' => __('user')]));
    }
}
