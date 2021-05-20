<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Article::paginate(15);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create');
        $data = $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'abstract' => 'required',
            'contents' => 'required'
        ]);
        $data['user_id'] = $request->user()->id;
        // return $data;

        return Article::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Article::find($id);
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
        $article = Article::find($id);
        $this->authorize('update', $article);
        $article->update($request->all());
        // dump($request->all());
        return $article;
    }
    //! payload vuoto. Su insomnia ricordati di passare la richiesta con un json e non con un form multipart.

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return Article::destroy($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  str  $title
     * @return \Illuminate\Http\Response
     */
    public function search($title)
    {
        return Article::where('title', 'like', '%' . $title . '%')->get();
        // cerca un articolo dove nel titolo ci sia la parola cercata
    }
}
