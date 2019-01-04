<?php

namespace App\Http\Controllers\Admin;

use App\Entity\User;
use App\Http\Requests\Users\CreateRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\UseCases\Auth\RegisterService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public $register;

    public function __construct(RegisterService $register)
    {
        $this->register = $register;
    }

    public function index(Request $request)
    {
        $query = User::orderByDesc('id');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }

        if (!empty($value = $request->get('name'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('email'))) {
            $query->where('email', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('status'))) {
            $query->where('status', $value);
        }

        if (!empty($value = $request->get('role'))) {
            $query->where('role', $value);
        }

        $users = $query->paginate(20);

        $statuses = [
            User::STATUS_WAIT   => 'Waiting',
            User::STATUS_ACTIVE => 'Active'
        ];

        $roles = [
            User::ROLE_USER  => 'User',
            User::ROLE_ADMIN => 'Admin'
        ];

        return view('admin.users.index', [
            'users'    => $users,
            'statuses' => $statuses,
            'roles'    => $roles,
        ]);
    }


    public function create()
    {
        return view('admin.users.create');
    }


    public function store(CreateRequest $request)
    {
        $user = User::new(
            $request['name'],
            $request['email']
        );

        return redirect()->route('admin.users.show', $user);
    }

    public function show(User $user)
    {
        return view('admin.users.show', [
            'user' => $user
        ]);
    }

    public function edit(User $user)
    {
        $statuses = [
            User::STATUS_WAIT   => 'Waiting',
            User::STATUS_ACTIVE => 'Active'
        ];

        $roles = [
            User::ROLE_USER  => 'User',
            User::ROLE_ADMIN => 'Admin'
        ];

        return view('admin.users.edit', [
            'user'     => $user,
            'statuses' => $statuses,
            'roles'    => $roles,
        ]);
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->only(['name', 'email', 'status']));

        return redirect()->route('admin.users.show', $user);
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    public function verify(User $user)
    {
        $user->verify();

        return redirect()->route('admin.users.show', $user);
    }
}
