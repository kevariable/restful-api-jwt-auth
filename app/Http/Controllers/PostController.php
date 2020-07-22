<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use App\Http\Resources\PostResource;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\PostCollection;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PostCollection(Post::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $userPost = auth()->user()->posts()->create(
            $this->credentials($request)
        );

        $userPost->tags()->sync($request->tags);

        return new PostResource($userPost);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Post $post)
    {
        $post->update(
            $this->credentials($request)
        );

        $post->tags()->sync($request->tags);

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'has_deleted' => $post
        ]);
    }

    public function credentials($request)
    {
        return [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'body' => $request->body
        ];
    }
}
