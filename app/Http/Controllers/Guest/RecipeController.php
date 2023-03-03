<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PHPUnit\TextUI\Configuration\Builder;

class RecipeController extends Controller
{
    public function index() : View
    {
        $recipes = Recipe::where('is_active' ,'=', 1)->latest()->paginate(10);

        return view('guest/recipes/index', [
            'recipes' => $recipes,
        ]);
    }

    public function show(Request $request) : View
    {
        $search = $_GET;

        $recipes = Recipe::where('is_active' ,'=', 1)->paginate(20);
        if(array_key_exists('category', $search) && $search['category'] !== "")
        {
            $recipes = Recipe::where('is_active', '=', 1)->whereHas('category', function ($query) use ($search) {
                $query->where('name', '=', $search['category']);
            })->paginate(20);
        }
        if(array_key_exists('search', $search)&& $search['search'] !== "")
        {
            $recipes = Recipe::where('is_active' ,'=', 1)->where('name', 'LIKE', '%'.$search['search'].'%')->paginate(20);
            if(array_key_exists('category', $search)&& $search['category'] !== "")
            {
                $recipes = Recipe::where('is_active', '=', 1)->where('name', 'LIKE', '%'.$search['search'].'%')->whereHas('category', function ($query) use ($search) {
                    $query->where('name', '=', $search['category']);
                })->paginate(20);
            }
        }
        
        $categorys = Category::where('is_active', '=', 1)->get();
        
        return view('guest/recipes/recipes', [
            'recipes' => $recipes,
            'categorys'=> $categorys,
        ]);
    }

    public function recipe(int $id)
    {
        $recipe = Recipe::find($id);

        if ($recipe === null) {
            abort(404);
        }

        return view('guest/recipes/recipe', [
            'recipe' => $recipe
        ]);
    }
}
