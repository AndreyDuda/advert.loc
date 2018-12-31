<?php

namespace App\Http\Controllers\Admin;

use App\Entity\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(20);

        return view('admin.users.index', [
            'users' => $users
        ]);
    }


    public function create()
    {
        return view('admin.users.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
        ]);

        $user = User::create([
            'name'   => $request['name'],
            'email'  => $request['email'],
            'status' => User::STATUS_ACTIVE
        ]);

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

        return view('admin.users.edit', [
            'user'     => $user,
            'statuses' => $statuses
        ]);
    }


    public function update(Request $request, User $user)
    {
        $data = $this->validate($request, [
            'name'   => 'required|string|max:255',
            'email'  => 'required|string|email|max:255|unique:users,id,' . $user->id,
            'status' => ['required', 'string', Rule::in([User::STATUS_WAIT, User::STATUS_ACTIVE])],
        ]);

        $user->update($data);

        return redirect()->route('admin.users.show', $user);
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
