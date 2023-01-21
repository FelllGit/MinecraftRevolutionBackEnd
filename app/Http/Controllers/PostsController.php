<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostModel;
use DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(PostModel::get(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return "create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new PostModel;
        $post->name = $request->name;
        $post->description = $request->description;
        $post->body = $request->body;
        $post->created_at = \Carbon\Carbon::now()->timestamp;
        $post->updated_at = \Carbon\Carbon::now()->timestamp;
        $post->save();
        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = PostModel::find($id);
        if (is_null($post)) {
            return response()->json([
                'error' => true,
                'message' => 'Not found'
            ], 404);
        }
        return response()->json($post, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = PostModel::findOrFail($id);
        return view('posts.editpost', ['post' => $post]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = PostModel::find($id);
        if (is_null($post)) {
            return response()->json([
                'error' => true,
                'message' => 'Not found'
            ], 404);
        }

        $name = '';
        $description = '';
        $body = '';

        $name = $request->name ?: $post->name;
        $description = $request->description ?: $post->description;
        $body = $request->body ?: $post->body;
        $updated_at = \Carbon\CarbonImmutable::now()->toDateTimeString();

        DB::table("post_models")
            ->where('id', $id)
            ->update(['name' => $name, 'body' => $body, 'description' => $description, 'updated_at' => $updated_at]);
        return response()->json($post, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Перевірка на наявність юзера
        $post = PostModel::find($id);
        if (is_null($post)) {
            return response()->json([
                'error' => true,
                'message' => 'Not found'
            ], 404);
        }

        $post->delete();
        return response()->json('', 204);
    }
}
