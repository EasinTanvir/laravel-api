<?php

namespace App\Http\Controllers\Api\V1\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //    return PostResource::collection(Post::all());
    //    return PostResource::collection(Post::with('author')->get());

      $user = request()->user();
      $posts = $user->posts()->paginate();
       return PostResource::collection($posts);
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

    $data["author_id"]=$request->user()->id;

   $post = Post::create($data);

//    return response()->json([
//     "message"=>"Post Create",
//     "data"=> $post
//    ])->setStatusCode(201);

return response()->json(new PostResource($post),201);

   



 
        
    }

    /**
     * Display the specified resource.
     */
public function show(Post $post)
{
    $user = request()->user();

    abort_if(!$user || $user->id !== $post->author_id, 403, 'Access Forbidden');

    return new PostResource($post);
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {   

    abort_if(Auth::id() !== $post->author_id, 403, 'Access Forbidden');

        //
        $data = $request->validate([
        'title'=> 'required|string|max:100',
        'desc'=> ['required','string','max:100']
        ]);


        $post->update($data);


          return response()->json(new PostResource($post));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

    abort_if(Auth::id() !== $post->author_id, 403, 'Access Forbidden');

    $post->delete();
    
        return response(
            [
                "message"=>"Delete Post Successfully"
            ]
        )->noContent();
    }
}