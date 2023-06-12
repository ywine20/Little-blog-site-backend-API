<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Post::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title'=>'required|min:3|max:50',
            'description'=>'required',
            'like_count'=>'required|numeric|min:1',
            'images'=>'required',
            'images.*'=>'file|mimes:jpeg,png,'

        ]);
        // return response()->json($request);

         if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
            $newName = time() . '_' . $key . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $newName);

                $post= Post::create([
                'title'=>$request->title,
                'description'=>$request->description,
                'like_count'=>$request->like_count,
                'images'=>$newName,
        ]);
    }
}
    if (isset($post)) {
        return response()->json(['message' => ' stored successfully'], 200);
    } else {
        return response()->json(['message' => ' storage failed'], 500);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $post=Post::find($id);
        if(is_null($post)){
            return response()->json(['message' => 'post is not found'],status:404);
        }
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title'=>'required|min:3|max:50',
            'description'=>'required',
            'like_count'=>'required|numeric|min:1',
            'images'=>'required',
            'images.*'=>'file|mimes:jpeg,png,'

        ]);
        // return $request;
         $post=Post::find($id);
        if(is_null($post)){
            return response()->json(['message' => 'post is not found'],status:404);
        }

         if($request->has('title')){
             $post->title=$post->title;
        }
         if($request->has('description')){
             $post->description=$post->description;
        }
         if($request->has('like_count')){
             $post->like_count=$post->like_count;
        }
        $post->update();
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
         $post=Post::find($id);
        if(is_null($post)){
            return response()->json(['message' => 'post is not found'],status:404);
        }
        $post->delete();
        return response()->json(['masage'=>' Post is not delete'],status:204);
    }
}
