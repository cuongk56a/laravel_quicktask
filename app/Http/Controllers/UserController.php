<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::with('posts')->get();

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function getPostByUser(User $user)
    {
        $posts = $user->posts;

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function create(){
        return view('users.create');
    }

    public function store(StoreUserRequest $request){
        $validated = $request->validated();

        $user = new User();
        $user->fill($validated);
        $user->password = Hash::make($validated['password']);
        $user->is_admin = false;
        $user->is_active = true;
        $user->save();

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(Request $request, User $user){
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user){
        $validated = $request->validated();

        $user->fill($validated);
        $user->save();

        return back();
    }

    public function destroy(User $user){
        $user->delete();
        return back();
    }
}
