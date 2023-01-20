@section('articles')
@auth
@if (auth()->user()->role == 'admin')
    <div class="admin-nav">
        <nav class="p-3 border-gray-200 rounded bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
            <div class="container flex flex-wrap items-center justify-between mx-auto">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Admin Panel</span>
            </div>
        </nav>
    </div>

    <div class="articlesContainer p-8">

        <div class="containerTitle mb-8">
            <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Articles Disponibles</h1>
            <a class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" href='{{ route('index', ['today' => urlencode(Carbon\Carbon::now()->format('m-d-Y'))]) }}'>Articles Du Jour</a>
            @foreach (App\Models\Category::all() as $category)
                <a class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" href='{{ route('index', ['categorie' => $category->slug]) }}'>{{ $category->name }}</a>
            @endforeach
            <a class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" href='{{ route('index', ['categorie' => ""]) }}'>Tous les Articles</a>
            <a class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" href='{{ route('last') }}'>Articles Récent</a>
        </div>

        @foreach ($article as $item)
        <div class="article bg-blue-900 p-5 mb-8 bg-opacity-50 rounded-lg">
            @foreach ($item->categories as $category)
               <p>Catégories : {{ $category->name }}</p>
            @endforeach
            <p>Titre : {{ $item->title  }}</p>
            <p>Description : {{ $item->description }}</p>
            <p>Contenue : {{ $item->content }}</p>
            <p>Auteur : {{ $item->user->name }}</p>
            <p>Date de Création : {{ $item->published_at }}</p>
            <div class="actionContainer flex">
                <a href="/mesarticles/{{ $item->id }}"><button class="bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-4 border border-blue-700 rounded">Voir</button></a>
                <a href="/mesarticles/{{ $item->id }}/edit"><button class="bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-4 border border-blue-700 rounded">Editer</button></a>   
                <form method="POST" action="/mesarticles/{{ $item->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="bg-orange-700 hover:bg-orange-500 text-white font-bold py-2 px-4 border border-orange-700 rounded" type="submit" name="delete">Supprimer</button>   
                </form>
            </div>
        </div>        
        @endforeach
        {{ $article->links('pagination::tailwind') }}
    </div>

@else

    <div class="articlesContainer p-8">

        <div class="containerTitle mb-8">
            <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Articles Disponibles</h1>
            <a class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" href='{{ route('index', ['today' => urlencode(Carbon\Carbon::now()->format('m-d-Y'))]) }}'>Articles Du Jour</a>
            @foreach (App\Models\Category::all() as $category)
                <a class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" href='{{ route('index', ['categorie' => $category->slug]) }}'>{{ $category->name }}</a>
            @endforeach
            <a class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" href='{{ route('index', ['categorie' => ""]) }}'>Tous les Articles</a>
            <a class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" href='{{ route('last') }}'>Articles Récent</a>
            <br/><br/>
            <a class="bg-teal-900 hover:bg-gray-100 text-white font-semibold py-2 px-4 border border-teal-900 rounded shadow" href='/mesarticles'>Mes Articles</a>
        </div>

        @foreach ($article as $item)
        <div class="article bg-blue-900 p-5 mb-8 bg-opacity-50 rounded-lg">
            @foreach ($item->categories as $category)
                {{ $category->name }}
            @endforeach
            <p>Titre : {{ $item->title  }}</p>
            <p>Description : {{ $item->description }}</p>
            <p>Contenue : {{ $item->content }}</p>
            <p>Auteur : {{ $item->user->name }}</p>
            <p>Date de Création : {{ $item->published_at }}</p>
            <a href="/mesarticles/{{ $item->id }}"><button class="bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-4 border border-blue-700 rounded">Voir</button></a>  
        </div>     
        @endforeach
        {{ $article->links('pagination::tailwind') }} 
    </div>
@endif
@endauth
@endsection