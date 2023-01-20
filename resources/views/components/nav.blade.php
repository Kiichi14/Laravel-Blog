@section('nav')
@if (Route::has('login'))
    <nav class="bg-white border-gray-200 bg-slate-800">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-4 md:px-6 py-2.5">
            <a href="https://flowbite.com" class="flex items-center">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Laravel Blog</span>
            </a>
            <div class="flex items-center">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
                <p>Bonjour {{ auth()->user()->name }}</p>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
            </div>
        </div>
    </nav>
@endif
@endsection