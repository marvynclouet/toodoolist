<!-- layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="relative min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Laravel') }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Fonctionnalités</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Prix</a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Inscription</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="#">Tableau de bord</a>
                            </li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link" style="cursor: pointer;">Déconnexion</button>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Tableau de bord</h1>
    <p class="mb-4">Bienvenue dans votre tableau de bord.</p>

    <!-- Affichage des tâches de l'utilisateur -->
    <div class="card mb-4 bg-white rounded-lg shadow-md">
        <div class="card-header bg-gray-200 py-2 px-4 rounded-t-lg">Mes Tâches</div>

        <div class="card-body p-4">
            @if ($tasks->isEmpty())
                <p class="text-gray-600">Aucune tâche trouvée.</p>
            @else
                <ul class="list-group">
                    @foreach ($tasks as $task)
                        <li class="list-group-item border-none py-2 flex justify-between items-center">
                            <div>
                                <strong class="text-lg {{ $task->completed ? 'line-through' : '' }}">{{ $task->title }}</strong>
                                <p class="text-sm text-gray-600">{{ $task->description }}</p>
                                <p class="text-xs text-gray-500">Date d'échéance : {{ $task->due_date }}</p>
                            </div>
                            <div class="flex items-center">
                                <form method="POST" action="{{ route('tasks.toggleComplete', $task->id) }}" class="mr-2">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-secondary">
                                        {{ $task->completed ? 'Marquer comme non terminé' : 'Marquer comme terminé' }}
                                    </button>
                                </form>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 hover:text-blue-600 mr-2">Modifier</a>
                                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?');">Supprimer</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <!-- Formulaire pour ajouter une nouvelle tâche -->
    <div class="card bg-white rounded-lg shadow-md">
        <div class="card-header bg-gray-200 py-2 px-4 rounded-t-lg">Ajouter une nouvelle tâche</div>

        <div class="card-body p-4">
            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Titre de la tâche</label>
                    <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="title" name="title" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description de la tâche</label>
                    <textarea class="form-textarea mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="description" name="description" rows="3"></textarea>
                </div>

                <div class="mb-4">
                    <label for="due_date" class="block text-sm font-medium text-gray-700">Date d'échéance</label>
                    <input type="date" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="due_date" name="due_date" required>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Ajouter la tâche
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Intégration du fichier CSS -->
<link href="{{ mix('css/app.css') }}" rel="stylesheet">

<!-- Intégration du fichier JavaScript -->
<script src="{{ mix('js/app.js') }}" defer></script>
@vite('resources/css/app.css')

@endsection
