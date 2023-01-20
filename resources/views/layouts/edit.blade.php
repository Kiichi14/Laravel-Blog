@extends('master')

@section('contenue')

<div class="updateSection p-8">
    <form class="flex flex-col gap-1" action="{{ url('mesarticles/'.$article->id)}}" method="POST">
        @csrf
        @method('PATCH')
        <input class="text-black" type="text" name="title" placeholder="{{ $article->title }}" value="{{ $article->title }}"/>
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"/>
        <textarea class="text-black" name="description" placeholder="{{ $article->description }}" value="{{ $article->description }}"></textarea>
        <textarea class="text-black" name="content" placeholder="{{ $article->content }}" value="{{ $article->content }}"></textarea>
        <button class="bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-4 border border-blue-700 rounded" type="submit" name="submit">Envoyer</button>      
    </form> 
</div>
@endsection