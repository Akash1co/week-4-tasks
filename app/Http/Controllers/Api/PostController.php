<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(Post::with('user')->latest()->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = $request->user()->posts()->create($validated);

        return response()->json($post, 201);
    }

    public function show(Post $post)
    {
        return response()->json($post->load('user'), 200);
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
        ]);

        $post->update($validated);

        return response()->json($post, 200);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}