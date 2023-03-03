<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categorys = Category::paginate(20);

        return view('category/index', [
            'categorys' => $categorys,
        ]);
    }

    public function edit(int $id): View
    {
        $category = Category::find($id);

        if ($category === null) {
            abort(404);
        }

        return view('category/edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $category = Category::find($id);
        $request->validate(
            [
                'name' => 'required|min:3|max:255',
            ]
        );


        if ($request->is_active) {
            $category->is_active = $request->is_active;
        } else {
            $category->is_active = 0;
        }

        $category->name = $request->name;
        $category->save();

        return redirect('category')->with('success', 'Category updated!');

    }

    public function create(Request $request): View
    {
        return view('category.create');
    }

    public function save(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'name' => 'required|min:3|max:255',
            ]
        );
        $category = new Category;

        if ($request->is_active) {
            $category->is_active = $request->is_active;
        } else {
            $category->is_active = 0;
        }

        $category->name = $request->name;
        $category->save();

        return redirect('category')->with('success', 'Category created!');
    }

    public function delete(int $id)
    {
        $category = Category::find($id);

        if ($category === null) {
            abort(404);
        }

        $category->delete();

        return redirect('category')->with('success', 'Category was removed!');
    }

}