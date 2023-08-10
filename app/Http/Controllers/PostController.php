<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(){
        $posts = DB::table('posts')->where('user_id', auth()->id())->get();

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(StorePostRequest $request){
        $validated = $request->validated();

        DB::table('posts')->insert([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index');
    }

    public function show(Post $post){
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post){
        return view('posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post){
        $validated = $request->validated();

        DB::table('posts')->where('id', $post->id)->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post){
        $post->delete();
        return back();
    }
}
