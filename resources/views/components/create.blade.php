@section('create')
<h2 class="text-4xl font-bold dark:text-white">Creer un nouvel Article</h2>

    <form class="flex flex-col w-2/5 gap-3" action="mesarticles" method="POST">
    @csrf
    <input class="text-black" type="text" name="title" placeholder="Votre titre"/>
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"/>
    <select class="text-black" name="category">
        @foreach (App\Models\Category::all() as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach    
    </select>
    <input class="text-black" type="date" name="published_at"/>    
    <textarea class="text-black" name="description" placeholder="Votre petite description"></textarea>
    <textarea class="text-black" name="content" placeholder="Contenue de votre Post"></textarea>
    <button class="bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-4 border border-blue-700 rounded" type="submit" name="submit">Envoyer</button>      
    </form>    
    <br/>
@endsection