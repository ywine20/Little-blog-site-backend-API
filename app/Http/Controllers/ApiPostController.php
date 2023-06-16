<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ApiPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Post::with('images')->get());
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
         $post= Post::create([
                'title'=>$request->title,
                'description'=>$request->description,
                'like_count'=>$request->like_count,
        ]);

        if ($request->hasFile('images')) {
    $images = [];
    foreach ($request->file('images') as $key => $image) {
        $newName = uniqid() . '_' . $image->getClientOriginalName();
        $image->storeAs('public/images/postimg', $newName);
        $imagePath = 'public/images/postimg/' . $newName; // Path where the image will be stored
        $images[$key] = new PostImage(['image' => $imagePath]); // Store the image path in the array
    }
    // Additional logic to save the images or perform further actions
        $post->images()->saveMany($images);

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
        $post->load('images');
        return response()->json($post);
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
             $post->title=$request->title;
        }
         if($request->has('description')){
             $post->description=$request->description;
        }
        //  if($request->has('like_count')){
        //      $post->like_count=$post->like_count;
        // }

        if ($request->has('deleted_images')) {
        $deletedImages = $request->input('deleted_images');
        foreach ($deletedImages as $imageId) {
            $image = PostImage::find($imageId);
            if ($image) {
                Storage::delete('public/images/postimg/' .$image->image);
                $image->delete();
            }
        }
    }

    // Handle added images
    if ($request->hasFile('added_images')) {
        $addedImages = $request->file('added_images');
        foreach ($addedImages as $addedImage) {
            $imageName = uniqid() . '.' . $addedImage->getClientOriginalExtension();
            $addedImage->storeAs('public/images/postimg/',$imageName);
            $unit->images()->create(['image' => $imageName]);
        }
    }
        $post->update();
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
{
    $post = Post::find($id);
    if (is_null($post)) {
        return response()->json(['message' => 'Post not found'], 404);
    }


    $images = $post->images;
    $post->delete();

    foreach ($images as $image) {
        Storage::delete($image->image);
        $image->delete();
    }

    return response()->json(['message' => 'Post and images deleted successfully'], 200);
}
}
