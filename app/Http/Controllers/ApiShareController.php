<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiShareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
  $post = Post::find($id);

if (is_null($post)) {
    return response()->json(['message' => 'Post not found'], 404);
}

$data = [
    'title' => $post->title ?? '',
    'description' => $post->description ?? '',
    'image' => $post->image ?? '',
    'like_count' => $post->like_count ?? 0
];

return response()->json($data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
