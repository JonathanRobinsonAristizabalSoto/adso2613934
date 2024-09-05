<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class CollectionController extends Controller
{
    public function index()
    {
        // Obtener el usuario autenticado
        $user = auth()->user();

        // Obtener los juegos del usuario con la relación de categorías
        $games = Game::with('category')->where('user_id', $user->id)->get();

        // Agrupar juegos por categoría
        $categories = $games->groupBy(function ($game) {
            return $game->category->name;
        });

        // Retornar la vista con las categorías agrupadas
        return view('collection.index', compact('categories'));
    }
}
