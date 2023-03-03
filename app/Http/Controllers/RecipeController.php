<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RecipeController extends Controller
{
    public function index() : View
    {
        $recipes = Recipe::paginate(20);

        return view('recipes/index', [
            'recipes' => $recipes,
        ]);
    }

    public function edit (int $id) : View
    {
        $recipe = Recipe::find($id);
        $categories = Category::where('is_active', '=', 1)->get();
        $ingredients = Ingredient::where('is_active', '=', 1)->get();

        if ($recipe === null) {
            abort(404);
        }

        return view('recipes/edit', [
            'recipe'=> $recipe,
            'categories' => $categories,
            'ingredients' => $ingredients,
        ]);
    }

    public function update(Request $request, int $id) : RedirectResponse
    {
        $recipe = Recipe::find($id);
        $request->validate(
            [
                'name' => 'required|min:3|max:255',
                'category_id' => 'required',
                'ingredient_id' => 'required|array|min:1',
                'description' => 'required',
                'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );
        
        if($request->image)
        {
                $imageName = time().'.'.$request->image->extension();
                $request->image->storeAS('public', $imageName);
                if(\Storage::exists('public/'.$recipe->image)){
                    \Storage::delete('public/'.$recipe->image);
                }
                $recipe->image = $imageName;
        }

        if($request->is_active)
        {
            $recipe->is_active = $request->is_active;
        } else {
            $recipe->is_active = 0;
        }

        $recipe->name = $request->name;
        $recipe->category_id = $request->category_id;
        $recipe->description = $request->description;
        $recipe->save();
        $recipe->ingredients()->sync(array_filter($request->ingredient_id));

        return redirect('recipes')->with('success', 'Recipe updated!');

    }

    public function create(Request $request) : View
    {
        $categories = Category::where('is_active', '=', 1)->get();
        $ingredients = Ingredient::where('is_active', '=', 1)->get();

        return view('recipes.create', [
            'categories' => $categories,
            'ingredients' => $ingredients,
        ]);
    }

    public function save(Request $request) : RedirectResponse
    {
        $request->validate(
            [
                'name' => 'required|min:3|max:255',
                'category_id' => 'required',
                'ingredient_id' => 'required|array|min:1',
                'description' => 'required',
                'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );
        $recipe = new Recipe;
        if($request->image)
        {
                $imageName = time().'.'.$request->image->extension();
                $request->image->storeAS('public', $imageName);
                $recipe->image = $imageName;
        }

        if($request->is_active)
        {
            $recipe->is_active = $request->is_active;
        } else {
            $recipe->is_active = 0;
        }

        $recipe->name = $request->name;
        $recipe->category_id = $request->category_id;
        $recipe->description = $request->description;
        $recipe->save();
        $recipe->ingredients()->sync(array_filter($request->ingredient_id));

        return redirect('recipes')->with('success', 'Recipe created!');
    }

    public function delete(int $id)
    {
        $recipe = Recipe::find($id);
        $foren_key = DB::table('ingredient_recipe')->where('recipe_id', $id)->get();
        if ($recipe === null) {
            abort(404);
        }
        if($foren_key !== null){
            DB::table('ingredient_recipe')->where('recipe_id', $id)->delete();
        }

        $recipe->delete();

        return redirect('recipes')->with('success', 'Recipe was removed!');
    }
}
