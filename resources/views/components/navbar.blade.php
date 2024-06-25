<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div>
            <a href="{{ route('dashboard') }}" class="text-white text-lg font-bold">Gestion des Tâches</a>
        </div>
        <div>
            @if (Auth::check())
                <a href="{{ route('tasks.create') }}" class="text-white px-4 py-2">Nouvelle Tâche</a>
                <a href="{{ route('tasks.index') }}" class="text-white px-4 py-2">Liste</a>
                <a href="{{ route('tasks.calendar') }}" class="text-white px-4 py-2">Calendrier</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-white px-4 py-2">Se déconnecter</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-white px-4 py-2">Connexion</a>
                <a href="{{ route('register') }}" class="text-white px-4 py-2">Inscription</a>
            @endif
        </div>
    </div>
</nav>