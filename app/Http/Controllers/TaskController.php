<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        // Récupérer toutes les tâches de l'utilisateur connecté
        $tasks = Task::where('user_id', auth()->id())->get();

        // Passer les tâches à la vue dashboard.blade.php
        return view('dashboard', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        // Validation des données reçues du formulaire
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        // Création d'une nouvelle tâche pour l'utilisateur connecté
        $task = new Task();
        $task->title = $validatedData['title'];
        $task->description = $validatedData['description'];
        $task->due_date = $validatedData['due_date'];
        $task->user_id = auth()->id(); // Assigner l'ID de l'utilisateur connecté
        $task->completed = false; // Par défaut, la tâche n'est pas complétée

        $task->save();

        // Redirection vers le tableau de bord avec un message de succès
        return redirect()->route('dashboard')->with('success', 'La tâche a été ajoutée avec succès.');
    }

    public function edit(Task $task)
    {
        // Vérifier si l'utilisateur connecté est le propriétaire de la tâche
        if ($task->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Vous n\'êtes pas autorisé à modifier cette tâche.');
        }

        // Passer la tâche à la vue d'édition
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        // Vérifier si l'utilisateur connecté est le propriétaire de la tâche
        if ($task->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Vous n\'êtes pas autorisé à modifier cette tâche.');
        }

        // Validation des données reçues du formulaire
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        // Mise à jour des détails de la tâche
        $task->update($validatedData);

        // Redirection vers le tableau de bord avec un message de succès
        return redirect()->route('dashboard')->with('success', 'La tâche a été mise à jour avec succès.');
    }

    public function toggleComplete(Task $task)
    {
        // Vérifier si l'utilisateur connecté est le propriétaire de la tâche
        if ($task->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Vous n\'êtes pas autorisé à modifier cette tâche.');
        }

        // Changer l'état de la tâche (complétée/non complétée)
        $task->completed = !$task->completed;
        $task->save();

        // Redirection vers le tableau de bord avec un message de succès
        return redirect()->route('dashboard')->with('success', 'La tâche a été mise à jour avec succès.');
    }

    public function destroy(Task $task)
    {
        // Vérifier si l'utilisateur connecté est le propriétaire de la tâche
        if ($task->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Vous n\'êtes pas autorisé à supprimer cette tâche.');
        }

        // Supprimer la tâche
        $task->delete();

        // Redirection vers le tableau de bord avec un message de succès
        return redirect()->route('dashboard')->with('success', 'La tâche a été supprimée avec succès.');
    }
}
