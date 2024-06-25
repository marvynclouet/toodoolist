@extends('layouts.app')

@section('content')

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<div class="container px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">TOO DOO LIST</h1>
 

    <!-- Affichage des tâches de l'utilisateur -->
    <div class="card mb-4">
        <div class="card-header bg-gray-200 py-2 px-4 rounded-top">Mes Tâches</div>

        <div class="card-body p-4">
            @if ($tasks->isEmpty())
                <p class="text-gray-600">Aucune tâche trouvée.</p>
            @else
                <ul class="list-group">
                    @foreach ($tasks as $task)
                        <li class="list-group-item border-none py-2 d-flex justify-content-between align-items-center">
                            <div>
                                <strong class="text-lg {{ $task->completed ? 'text-decoration-line-through' : '' }}">{{ $task->title }}</strong>
                                <p class="text-sm text-gray-600">{{ $task->description }}</p>
                                <p class="text-xs text-gray-500">Date d'échéance : {{ $task->due_date }}</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <form method="POST" action="{{ route('tasks.toggleComplete', $task->id) }}" class="mr-2">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-secondary">
                                        {{ $task->completed ? 'Marquer comme non terminé' : 'Marquer comme terminé' }}
                                    </button>
                                </form>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="text-primary hover:text-primary-dark mr-2">Modifier</a>
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
    <div class="card">
        <div class="card-header bg-gray-200 py-2 px-4 rounded-top">Ajouter une nouvelle tâche</div>

        <div class="card-body p-4">
            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="title" class="form-label">Titre de la tâche</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">Description de la tâche</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>

                <div class="mb-4">
                    <label for="due_date" class="form-label">Date d'échéance</label>
                    <input type="date" class="form-control" id="due_date" name="due_date" required>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        Ajouter la tâche
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Styles CSS -->
<style>
    /* Exemple de styles ajoutés directement dans la vue */
    .card {
        margin-bottom: 20px;
    }

    .btn {
        padding: 10px 20px;
        font-size: 14px;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #3490dc;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #2779bd;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: #fff;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }
</style>

<!-- Intégration du fichier CSS de Tailwind -->
<link href="{{ mix('css/app.css') }}" rel="stylesheet">

<!-- Intégration du fichier JavaScript de Tailwind -->
<script src="{{ mix('js/app.js') }}" defer></script>

@endsection
