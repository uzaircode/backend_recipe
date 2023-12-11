<?php

namespace App\Http\Controllers\Api;

use App\Models\Recipe;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RecipeController extends Controller
{
    public function addRecipe(Request $request)
    {
        try {
            $user = $request->user();
            $token = $user->token; // Make sure this retrieves the correct user token

            $validateData = Validator::make(
                $request->all(),
                [
                    'title' => 'required',
                    'description' => 'required',
                    'ingredients' => 'required|array',
                    'instructions' => 'required',
                    'cooking_time' => 'required',
                    'thumbnail' => 'required',
                ]
            );

            if ($validateData->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validateData->errors()->all()
                ], 422); // Use the appropriate status code for validation errors (422 Unprocessable Entity)
            }

            // Convert ingredients to JSON before storing
            $ingredientsArray = $request->input('ingredients');
            $validated = $validateData->validated();
            $instructionsArray = $request->input('instructions');
            $validated['instructions'] = $validateData->validated();

            $validated['ingredients'] = $ingredientsArray;
            $validated['instructions'] = $instructionsArray;
            $validated['user_token'] = $token;
            $validated['created_at'] = now();
            $validated['updated_at'] = now();

            $result = Recipe::create($validated);

            return response()->json([
                'status' => true,
                'message' => 'Recipe added successfully',
                'recipe' => $result
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error adding recipe',
                'errors' => $th->getMessage()
            ], 500); // Use the appropriate status code for server errors (500 Internal Server Error)
        }
    }

    public function recipeDetail(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'code' => 401,
                'msg' => 'Unauthorized',
                'data' => []
            ], 401);
        }

        $userToken = $user->token;

        $validatedData = $request->validate([
            'id' => 'required|numeric' // Validation rules for 'id'
        ]);

        $recipe = Recipe::where('user_token', $userToken)
            ->where('id', $validatedData['id'])
            ->first();

        $recipe = Recipe::where('user_token', $userToken)->where('id', $validatedData['id'])->first();

        if (!$recipe) {
            return response()->json([
                'code' => 404,
                'msg' => 'Recipe Not Found',
                'data' => []
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'msg' => 'Recipe Detail Successfully',
            'data' => $recipe
        ], 200);
    }

    public function recipeList(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'code' => 401,
                'msg' => 'Unauthorized',
                'data' => []
            ], 401);
        }

        $userToken = $user->token;

        $result = Recipe::where('user_token', $userToken)->get();

        return response()->json([
            'code' => 200,
            'msg' => 'Recipe List Successfully',
            'data' => $result
        ], 200);
    }

    public function recipeDelete(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'code' => 401,
                'msg' => 'Unauthorized',
                'data' => []
            ], 401);
        }

        $userToken = $user->token;

        $validatedData = $request->validate([
            'id' => 'required|numeric' // Validation rules for 'id'
        ]);

        $recipe = Recipe::where('user_token', $userToken)
            ->where('id', $validatedData['id'])
            ->first();

        $recipe = Recipe::where('user_token', $userToken)->where('id', $validatedData['id'])->first();

        if (!$recipe) {
            return response()->json([
                'code' => 404,
                'msg' => 'Recipe Not Found',
                'data' => []
            ], 404);
        }

        $deleted = $recipe->delete();

        if ($deleted) {
            return response()->json([
                'code' => 200,
                'msg' => 'Recipe Deleted Successfully',
                'data' => []
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'msg' => 'Failed to delete recipe',
                'data' => []
            ], 500);
        }
    }
}
