<?php

namespace App\Http\Controllers;

use App\Models\articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Carbon;
use Carbon\Carbon;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Affichage des article pour la page index tri par catégories ou non
        if(request()->categorie) {
            $article = articles::orderBy('published_at', 'DESC')->whereDate('published_at','<=', Carbon::now())->with('categories')->whereHas('categories', function($query) {
                $query->where('slug', request()->categorie);
            })->paginate(10);
        } else {
            $article = articles::orderBy('published_at', 'DESC')->whereDate('published_at','<=', Carbon::now())->paginate(10);
        }

        //Condition d'entree sur la page article du jour
        if(request()->today) {
            $article = articles::orderBy('published_at', 'DESC')->whereDate('published_at','=', Carbon::now()->format('Y_m_d'))->paginate(20);
        }

        //Condition d'entree sur la page article recent
        if(str_contains(url()->current(), '/mesarticles/last')) {
            $article = articles::orderBy('published_at', 'DESC')->where('user_id', Auth::user()->id)->take(10)->get();
            return view('layouts.lastArticle')->with('article', $article);
        }
        if(str_contains(url()->current(), '/last')) {
            $article = articles::orderBy('published_at', 'DESC')->whereDate('published_at','=', Carbon::now()->format('Y_m_d'))->take(10)->get();
            return view('layouts.lastArticle')->with('article', $article);
        }
        
        //Condition d'entree pour la page mes Articles
        if(str_contains(url()->current(), '/mesarticles')) {
            if(!request() || request()->categorie == "") {
                $article = articles::orderBy('published_at', 'DESC')->paginate(10);
            }
            return view('layouts.mesarticles')->with('article', $article);
        }
        return view('layouts.index')->with('article', $article);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = new articles();
        $article->title=$request->title;
        $article->description=$request->description;
        $article->content=$request->content;
        $article->user_id=$request->user_id;
        $article->published_at=$request->published_at;
        $article->save();
        DB::table('articles_category')->insert(
            array(
                   'category_id'     =>   $request->category, 
                   'articles_id'   =>   $article->id
            )
       );
        return redirect('/mesarticles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = articles::find($id);
        return view('layouts.viewArticles')->with('article', $article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = articles::find($id);
        return view('layouts.edit')->with('article', $article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = articles::find($id);
        $input = $request->all();
        $article->update($input);
        return redirect('/mesarticles')->with('flash_message', 'Article Mis a Jour!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        articles::destroy($id);
        if(auth()->user()->role == 'admin') {
            return redirect('/');
        }
        return redirect('/mesarticles');
    }
}
