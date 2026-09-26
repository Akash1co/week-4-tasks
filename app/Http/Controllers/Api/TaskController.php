<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    // GET /api/tasks (List all tasks)
    public function index()
    {
        $posts = Post::latest()->get();
        return TaskResource::collection($posts);
    }

    // POST /api/tasks (Create task)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $post = Post::create($validated);

        return (new TaskResource($post))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    // GET /api/tasks/{task} (Show single task)
    public function show(Post $task)
    {
        return new TaskResource($task);
    }

    // PUT/PATCH /api/tasks/{task} (Update task)
    public function update(Request $request, Post $task)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $task->update($validated);

        return new TaskResource($task);
    }

    // DELETE /api/tasks/{task} (Delete task)
    public function destroy(Post $task)
    {
        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully'
        ], Response::HTTP_OK);
    }
}