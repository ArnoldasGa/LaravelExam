<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IngredientController extends Controller
{
    public function index(): View
    {
        $ingredients = Ingredient::paginate(20);

        return view('ingredients/index', [
            'ingredients' => $ingredients,
        ]);
    }

    public function edit(int $id): View
    {
        $ingredient = Ingredient::find($id);

        if ($ingredient === null) {
            abort(404);
        }

        return view('ingredients/edit', [
            'ingredient' => $ingredient,
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $ingredient = Ingredient::find($id);
        $request->validate(
            [
                'name' => 'required|min:3|max:255',
            ]
        );


        if ($request->is_active) {
            $ingredient->is_active = $request->is_active;
        } else {
            $ingredient->is_active = 0;
        }

        $ingredient->name = $request->name;
        $ingredient->save();

        return redirect('ingredient')->with('success', 'Ingredient updated!');

    }

    public function create(Request $request): View
    {
        return view('ingredients.create');
    }

    public function save(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'name' => 'required|min:3|max:255',
            ]
        );
        $ingredient = new Ingredient;

        if ($request->is_active) {
            $ingredient->is_active = $request->is_active;
        } else {
            $ingredient->is_active = 0;
        }

        $ingredient->name = $request->name;
        $ingredient->save();

        return redirect('ingredient')->with('success', 'Ingredient created!');
    }

    public function delete(int $id)
    {
        $ingredient = Ingredient::find($id);

        if ($ingredient === null) {
            abort(404);
        }

        $ingredient->delete();

        return redirect('ingredient')->with('success', 'Ingredient was removed!');
    }
}