@extends('master')

@section('contenue')
<div class="showArticle p-8">
    <a class="bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-4 border border-blue-700 rounded" href="/">Retour a tous les Articles</a>

    @if (auth()->user()->role == 'user')
    <a class="bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-4 border border-blue-700 rounded" href="/mesarticles">Voir mes Articles</a>
    @endif

    <div class="articleContainer mt-5">
        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">{{ $article->title }}</h1>
        <p>Description : {{ $article->description }}</p>
        <p>Contenue : {{ $article->content }}</p>
    </div>
</div>        
@endsection