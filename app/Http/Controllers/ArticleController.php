<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ArticleCollection(Article::paginate(2));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $user = auth()->user()->articles()->create(
            $this->credentials($request)
        );

        return new ArticleResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return new ArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->update(
            $this->credentials($request)
        );

        return new ArticleResource($article);
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Article $article)
    // {
    //     $article->delete();

    //     return 'Was deleted';
    // }

    // public function credentials($request)
    // {
    //     return [
    //         'title' => $request->title,
    //         'slug' => Str::slug($request->title),
    //         'body' => $request->body,
    //         'tag_id' => $request->tag
    //     ];
    // }
}
