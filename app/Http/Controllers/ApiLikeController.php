<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Comment;
use Illuminate\Http\Request;

class ApiLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         return response()->json(Like::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'post_id' => 'required',
    ]);

    $user = $request->user();
    $like = Like::where('user_id', $user->id)
                ->where('post_id', $request->post_id)
                ->first();

    if ($like) {
        $like->delete();
        return response()->json([
            'message' => 'You unliked the post',
        ], 200);
    } else {
        $like = new Like();
        $like->user_id = $user->id;
        $like->post_id = $request->post_id;
        $like->likes=1; // Set a default value for the "likes" column

        if ($like->save()) {
            return response()->json([
                'message' => 'You liked the post',
                'like' => $like
            ], 201);
        } else {
            return response()->json([
                'message' => 'Some error occurred, please try again'
            ], 500);
        }
    }

}

/**
 * Display the specified resource.
 */
public function show(string $id)
{
    $like = Like::find($id);
    if (is_null($like)) {
        return response()->json(['message' => 'Like is not found'], 200);
    }
    return $like;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'likes'=>'nullable'
        ]);
         $like=Like::find($id);
        if(is_null($like)){
            return response()->json(['message' => 'like is not found'],status:404);
        }
         if($request->has('likes')){
             $like->likes=$request->likes;
        }
        $like->update();
        return response()->json($like);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $like=Like::find($id);
        if(is_null($like)){
            return response()->json(['message' => 'Like is not found'],status:404);
        }
        $like->delete();
        return response()->json(['masage'=> 'Like is delete'],status:200);
    }
}
