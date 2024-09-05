<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    // Mostrar una lista de todos los juegos
    public function index()
    {
        // Cargar la relación 'category' con los juegos
        $games = Game::with('category')->get();
        return view('games.index', compact('games'));
    }

    // Mostrar el formulario para crear un nuevo juego
    public function create()
    {
        return view('games.create');
    }

    // Guardar un nuevo juego en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:games|max:255',
            'developer' => 'required',
            'releasedate' => 'required|date',
            'category_id' => 'required|integer',
            'user_id' => 'required|integer',
            'price' => 'required|numeric',
            'genre' => 'required',
            'description' => 'required',
        ]);

        Game::create($request->all());

        return redirect()->route('games.index')
                         ->with('success', 'Game created successfully.');
    }

    // Mostrar un juego específico
    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }

    // Mostrar el formulario para editar un juego existente
    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    // Actualizar un juego existente en la base de datos
    public function update(Request $request, Game $game)
    {
        $request->validate([
            'title' => 'required|max:255|unique:games,title,' . $game->id,
            'developer' => 'required',
            'releasedate' => 'required|date',
            'category_id' => 'required|integer',
            'user_id' => 'required|integer',
            'price' => 'required|numeric',
            'genre' => 'required',
            'description' => 'required',
        ]);

        $game->update($request->all());

        return redirect()->route('games.index')
                         ->with('success', 'Game updated successfully.');
    }

    // Eliminar un juego existente de la base de datos
    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->route('games.index')
                         ->with('success', 'Game deleted successfully.');
    }
}
