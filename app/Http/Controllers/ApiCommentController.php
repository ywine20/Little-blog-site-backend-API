<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Comment;
use Illuminate\Http\Request;

class ApiCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // return 'hi';
         return response()->json(Comment::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $request->validate([
          'comments'=>'nullable'

        ]);
         $comment= Comment::create([
            'comments'=>$request->comments,
        ]);
        return response()->json(['massage'=>'succcessfully'],status:200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
            $comment=Comment::find($id);
        if(is_null($comment)){
            return response()->json(['message' => 'comment is not found'],status:404);
        }
        return $comment;
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
        //
        $comment=Comment::find($id);
        if(is_null($comment)){
            return response()->json(['message' => 'comment is not found'],status:404);
        }
        $comment->delete();
        return response()->json(['masage'=> 'comment is delete'],status:200);
    }
}
