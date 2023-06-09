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
   return response()->json(['massage'=>'succcessfully'],status:200);
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
        return response()->json($post);

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
