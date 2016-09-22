<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Profile;

use Hash;
use Auth;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(20);
        return view('users.index', compact('users'));
    }

    public function create(User $user)
    {
        return view('users.create', compact('user'));
    }

    public function store(Request $request, User $user)
    {
        $params = $request->all();
        if (!empty($params['password'])) $params['password'] = Hash::make($params['password']);
        $user->create($params);
        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $params = $request->input();
        if (!empty($params['password'])) $params['password'] = Hash::make($params['password']);
        else unset($params['password']);
        $user->fill($params)->save();
		return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        //
    }

    public function transform_into(User $user)
    {
        Auth::loginUsingId($user->id);
        return redirect()->route('dashboard.index');
    }
}
