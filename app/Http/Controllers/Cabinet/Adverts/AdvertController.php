<?php

namespace App\Http\Controllers\Cabinet\Adverts;

use App\Entity\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdvertController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        if (empty($user->name) || empty($user->last_name) || empty($user->phone)) {
            return redirect()
                ->route('cabinet.profile.home')
                ->with('error', 'Please fill your profile.');
        }

        return view('cabinet.adverts.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
