@extends('layouts.app')

@section('content')

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Modifier la Tâche</h1>

    <div class="card bg-white rounded-lg shadow-md">
        <div class="card-header bg-gray-200 py-2 px-4 rounded-t-lg">Modifier la Tâche</div>

        <div class="card-body p-4">
            <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Titre de la tâche</label>
                    <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="title" name="title" value="{{ $task->title }}" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description de la tâche</label>
                    <textarea class="form-textarea mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="description" name="description" rows="3">{{ $task->description }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="due_date" class="block text-sm font-medium text-gray-700">Date d'échéance</label>
                    <input type="date" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="due_date" name="due_date" value="{{ $task->due_date }}" required>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Mettre à jour la tâche
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
