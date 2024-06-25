<?php

// App\Http\Controllers\HomeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer toutes les tâches de l'utilisateur connecté
        $tasks = Task::where('user_id', auth()->id())->get();

        // Retourner la vue dashboard avec les tâches
        return view('dashboard', ['tasks' => $tasks]);
    }
}
