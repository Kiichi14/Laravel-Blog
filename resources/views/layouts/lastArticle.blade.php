@extends('master')

@section('contenue')
<div class='lastContainer p-8'>
    <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Les 10 Derniers Articles</h1>
    @if (Route::is('last'))
    @foreach ($article as $item)
    <div class="lastArticle bg-blue-900 p-5 mb-8 bg-opacity-50 rounded-lg">
        @foreach ($item->categories as $category)
            {{ $category->name }}
        @endforeach
        <p>Titre : {{ $item->title }}</p>
        <p>Description : {{ $item->description }}</p>
        <p>Contenue : {{ $item->content }}</p>
        <p>Auteur : {{ $item->user->name }}</p>
        <p>Creer le : {{ $item->published_at }}</p>
        <a href="/mesarticles/{{ $item->id }}"><button class="bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-4 border border-blue-700 rounded">Voir</button></a>
        @if (auth()->user()->role == 'admin')
        <div class="editControl flex">
            <a href="/mesarticles/{{ $item->id }}/edit"><button class="bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-4 border border-blue-700 rounded">Editer</button></a>
            <form action="/mesarticles/{{ $item->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="bg-orange-700 hover:bg-orange-500 text-white font-bold py-2 px-4 border border-orange-700 rounded" type="submit">Supprimer</button>    
            </form> 
        </div>
        @endif
    </div>    
    @endforeach
    @endif
    @if(Route::is('mylast'))
    <p>Mes derniers Articles</p>
    @foreach ($article as $item)
    <div class="lastArticle bg-blue-900 p-5 mb-8 bg-opacity-50 rounded-lg">
        @foreach ($item->categories as $category)
            {{ $category->name }}
        @endforeach
        <p>Titre : {{ $item->title }}</p>
        <p>Description : {{ $item->description }}</p>
        <p>Contenue : {{ $item->content }}</p>
        <p>Auteur : {{ $item->user->name }}</p>
        @if ($item->published_at > Carbon\Carbon::now())
            <p class="text-rose-700">Article a Programée pour le : {{ $item->published_at }}</p>
        @else
        <p>Creer le : {{ $item->published_at }}</p>
        @endif
        <div class="editControl flex">
            <a href="/mesarticles/{{ $item->id }}"><button class="bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-4 border border-blue-700 rounded">Voir</button></a>
            <a href="/mesarticles/{{ $item->id }}/edit"><button class="bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-4 border border-blue-700 rounded">Editer</button></a>
            <form action="/mesarticles/{{ $item->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="bg-orange-700 hover:bg-orange-500 text-white font-bold py-2 px-4 border border-orange-700 rounded" type="submit">Supprimer</button>    
            </form> 
        </div>
    </div>    
    @endforeach
    @endif
</div>    
@endsection