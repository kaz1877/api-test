<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CreateRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Models\Recipe;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $recipes = Recipe::all();

            return response()->json([
                'message' => 'Recipe successfully created!',
                'recipe' => $recipes,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Get All Recipe failed:' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRecipeRequest $request)
    {
        try {
            $recipe = Recipe::crate($request);
            return response()->json([
                'recipe' => $recipe,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Create Recipe failed:' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $recipes = Recipe::where('id', $id)->get();

            return response()->json([
                'message' => 'Recipe details by id',
                'recipe' => $recipes,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Get Recipe failed:' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecipeRequest $request, $id)
    {
        try {
            $update_recipe = Recipe::where('id', $id)
                ->update($request);

            return response()->json([
                'message' => 'Recipe successfully updated!',
                'recipe' => [
                    'title' => $update_recipe->title,
                    'making_time' => $update_recipe->making_time,
                    'serves' => $update_recipe->serves,
                    'ingredients' => $update_recipe->ingredients,
                    'cost' => $update_recipe->cost
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Update Recipe failed:' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Recipe::where('id', $id)->delete();

            return response()->json([
                'message' => 'Recipe successfully removed!',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Delete Recipe failed:' . $e->getMessage());

            return response()->json([
                'message' => 'No Recipe found',
            ], 200);
        }
    }
}
