<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;

class ApiCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

          $comments = Comment::with('post','user')->get();
            return response()->json($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
     // Validation rules
           $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
            'comments' => 'nullable',
        ]);

        try {
            // Create a new comment
            $comment = Comment::create([
                'post_id' => $request->post_id,
                'user_id' => $request->user_id,
                'comments' => $request->comments,
            ]);

            return response()->json(['message' => 'Comment stored successfully'], 200);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            return response()->json(['error' => $e->getMessage()], 500);
        }
 }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
       $comment = Comment::with('post')->find($id);
    if (is_null($comment)) {
        return response()->json(['message' => 'Comment not found'], 404);
    }
    return response()->json($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
         $request->validate([
            'comments'=>'nullable'
        ]);
         $comment=Comment::find($id);
        if(is_null($comment)){
            return response()->json(['message' => 'comment is not found'],status:404);
        }
         if($request->has('comments')){
             $comment->comments=$request->comments;
        }
        $comment->update();
        return response()->json($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $comment=Comment::find($id);
        if(is_null($comment)){
            return response()->json(['message' => 'comment is not found'],status:404);
        }
        $comment->delete();
        return response()->json(['masage'=> 'comment is delete'],status:200);
    }
}
