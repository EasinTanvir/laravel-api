<?php

namespace App\Http\Controllers\Api\V1\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {

    // $data = $request->validate(
    //     [
    //         "title"=> ["required","string", "max:100"],
    //         "desc"=> ["required","string", "max:100"],
    //     ]
        
    // );

    $data = $request->validated();

    $data["author_id"]=1;

   $post = Post::create($data);

   return response()->json([
    "message"=>"Post Create",
    "data"=> $post
   ])->setStatusCode(201);

   



 
        
    }

    /**
     * Display the specified resource.
     */
public function show(string $id)
{
    $post = Post::find($id);

    if (!$post) {
        return response()->json([
            'message' => 'Post not found'
        ], 404);
    }

    return response()->json([
        'post' => $post
    ], 200);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
        $data = $request->validate([
        'title'=> 'required|string|max:100',
        'desc'=> ['required','string','max:100']
        ]);


        $post->update($data);


        return [$post];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

    $post->delete();
    
        return response(
            [
                "message"=>"Delete Post Successfully"
            ]
        )->noContent();
    }
}