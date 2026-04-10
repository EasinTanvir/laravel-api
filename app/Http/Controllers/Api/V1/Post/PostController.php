<?php

namespace App\Http\Controllers\Api\V1\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return response()->json(
        [
        "data" => [
        "id" => 1,
        "title" => "Nice Post"
         ]
        ]
       );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    $data = $request->validate(
        [
            "title"=> ["required","string", "max:100"],
            "desc"=> ["required","string", "max:100"],
        ]
        
    );

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->validate([
        'title'=> 'required|string|max:20',
        'body'=> ['required','string','max:10']
        ]);


        return [$data];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response(
            [
                "message"=>"Delete Post Successfully"
            ]
        )->noContent();
    }
}