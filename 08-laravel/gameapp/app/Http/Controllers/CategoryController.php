<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Muestra una lista de todas las categorías.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.categories', compact('categories'));
    }

    // ------------------------------------------------------------------------------------

    /**
     * Muestra el formulario para crear una nueva categoría.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('categories.create');
    }

    // ------------------------------------------------------------------------------------

    /**
     * Almacena una nueva categoría en la base de datos.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        // Manejar la carga de la imagen
        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : 'images/no-photo.png';

        // Crear la nueva categoría
        $category = Category::create([
            'name' => $request->name,
            'manufacturer' => $request->manufacturer,
            'releasedate' => $request->releasedate,
            'image' => $imagePath,
            'description' => $request->description ?? '',
        ]);

        return redirect()->route('categories.index')->with('success', 'Categoría creada exitosamente.');
    }

    // ------------------------------------------------------------------------------------

    /**
     * Muestra el formulario para editar una categoría existente.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // ------------------------------------------------------------------------------------

    /**
     * Actualiza una categoría existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'releasedate' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
        ]);

        $category->name = $request->name;
        $category->manufacturer = $request->manufacturer;
        $category->releasedate = $request->releasedate;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            // Elimina la imagen anterior si existe
            if ($category->image !== 'no-photo.png' && file_exists(public_path('images/' . $category->image))) {
                unlink(public_path('images/' . $category->image));
            }
            $category->image = $request->file('image')->store('images', 'public');
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    // ------------------------------------------------------------------------------------

    /**
     * Muestra los detalles de una categoría específica.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\View\View
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    // ------------------------------------------------------------------------------------

    /**
     * Maneja la búsqueda de categorías.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        // Buscar categorías basadas en la consulta
        $query = $request->input('query');
        $categories = Category::where('name', 'LIKE', "%$query%")->get();

        // Devolver los resultados como JSON
        return response()->json($categories);
    }

    // ------------------------------------------------------------------------------------

    /**
     * Muestra la vista de confirmación de eliminación de una categoría.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\View\View
     */
    public function delete(Category $category)
    {
        return view('categories.delete', compact('category'));
    }

    // ------------------------------------------------------------------------------------

    /**
     * Elimina una categoría específica de la base de datos.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        // Verificar si hay juegos relacionados
        if ($category->games()->count() > 0) {
            return redirect()->route('categories.index')->with('error', 'No se puede eliminar la categoría porque está asociada con uno o más juegos.');
        }

        // Elimina la categoría de la base de datos
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
