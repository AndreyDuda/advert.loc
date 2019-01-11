<?php

namespace App\Http\Controllers\Cabinet;

use App\Entity\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('cabinet.profile.home', [
            'user' => $user
        ]);
    }

    public function edit()
    {
        $user = Auth::user();

        return view('cabinet.profile.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|string|mx:255',
            'last_name' => 'required|string|max:255'
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->update($request->only('name', 'last_name'));

        return redirect()->route('cabinet.profile.home');
    }
}