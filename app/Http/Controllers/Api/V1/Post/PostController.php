<?php

namespace App\Http\Controllers\Api\V1\Post;

use App\Http\Controllers\Controller;
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

    $data = $request->all();
    $title = $request->input('title');

logger("Title is ", [$title]); 

    return response([
        "message"=>"Success",
        "data"=> $data
    ])->setStatusCode(200);
        
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
        //
    }
}