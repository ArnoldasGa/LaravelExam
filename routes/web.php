<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\Guest\RecipeController as GuestRecipeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [GuestRecipeController::class , 'index'])->name('home');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('guest/recipes', [GuestRecipeController::class, 'show'])->name('guest.recipes');
Route::post('guest/recipes', [GuestRecipeController::class, 'search'])->name('guest.recipes');
Route::get('guest/recipe/{id}', [GuestRecipeController::class, 'recipe'])->name('recipe');

Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'show'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate'])->name('authenticate'); 
    Route::get('registration', [AuthController::class, 'showCreate'])->name('registration');
    Route::post('registration', [AuthController::class, 'create'])->name('create');
});

Route::middleware(['admin','auth'])->group(function () {
    Route::get('recipes', [RecipeController::class , 'index'])->name('recipes');
    Route::get('recipe/edit/{id}', [RecipeController::class , 'edit'])->name('recipes.edit');
    Route::post('recipe/edit/{id}', [RecipeController::class , 'update'])->name('recipes.edit');
    Route::get('recipe/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('recipe/create', [RecipeController::class, 'save'])->name('recipes.create');
    Route::delete('recipe/delete/{id}', [RecipeController::class, 'delete'])->name('recipes.delete');

    Route::get('category', [CategoryController::class, 'index'])->name('categorys');
    Route::get('category/edit/{id}', [CategoryController::class , 'edit'])->name('categorys.edit');
    Route::post('category/edit/{id}', [CategoryController::class , 'update'])->name('categorys.edit');
    Route::get('category/create', [CategoryController::class, 'create'])->name('categorys.create');
    Route::post('category/create', [CategoryController::class, 'save'])->name('categorys.create');
    Route::delete('category/delete/{id}', [CategoryController::class, 'delete'])->name('categorys.delete');

    Route::get('ingredient', [IngredientController::class, 'index'])->name('ingredients');
    Route::get('ingredient/edit/{id}', [IngredientController::class , 'edit'])->name('ingredients.edit');
    Route::post('ingredient/edit/{id}', [IngredientController::class , 'update'])->name('ingredients.edit');
    Route::get('ingredient/create', [IngredientController::class, 'create'])->name('ingredients.create');
    Route::post('ingredient/create', [IngredientController::class, 'save'])->name('ingredients.create');
    Route::delete('ingredient/delete/{id}', [IngredientController::class, 'delete'])->name('ingredients.delete');
});



