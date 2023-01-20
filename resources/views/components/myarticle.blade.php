@section('myarticle')
@include('components.create')

<div class="p-8">
    <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Le Blog de {{ auth()->user()->name }}</h1>
        <a href="/"><button class="bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-4 border border-blue-700 rounded">Retour a tous les articles</button></a>

    <div class="formCreate flex flex-col mb-7 items-center">    
        @yield('create')
    </div>

        @foreach (App\Models\Category::all() as $category)
            <a href='{{ route('mesarticles.index', ['categorie' => $category->slug]) }}'><button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">{{ $category->name }}</button></a>
        @endforeach
        <a href='{{ route('mesarticles.index', ['categorie' => ""]) }}'><button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Touts les Articles</button></a>
        <a href='{{ route('mylast') }}'><button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Articles Récent</button></a>
        <br/>
        @foreach ($article as $item)
        @if ( $item->user->name == auth()->user()->name)
        <div class="bg-blue-900 p-5 mb-8 mt-8 bg-opacity-50 rounded-lg">
            @foreach ($item->categories as $category)
                {{ $category->name }}
            @endforeach
            <p>Titre : {{ $item->title  }}</p>
            <p>Description : {{ $item->description }}</p>
            <p>Contenue : {{ $item->content }}</p>
            <p>Auteur : {{ $item->user->name }}</p>
            @if ($item->published_at > Carbon\Carbon::now())
            <p class="text-rose-700">Article a Programée pour le : {{ $item->published_at }}</p>
            @else
            <p>Date de Création : {{ $item->published_at }}</p>
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
        @endif
        @endforeach
            {{ $article->links('pagination::tailwind') }}
</div>        
@endsection