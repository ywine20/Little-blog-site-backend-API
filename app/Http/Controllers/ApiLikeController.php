<?php

namespace App\Http\Controllers;

use App\Models\Like;
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

        'likes'=>'nullable|numeric|min:1'

        ]);
         $like= Like::create([
            'likes'=>$request->likes,
        ]);
        return response()->json(['massage'=>'succcessfully'],status:200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
            $like=Like::find($id);
        if(is_null($like)){
            return response()->json(['message' => 'comment is not found'],status:200);
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
