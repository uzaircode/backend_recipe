<?php

namespace App\Http\Controllers\Api;

use App\Models\Recipe;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function addReview(Request $request, $recipe_id)
    {
        try {
            // Retrieve the authenticated user's token from the request
            $user = $request->user();
            $token = $user->token;

            if (!$user) {
                return response()->json([
                    'code' => 401,
                    'msg' => 'Unauthorized',
                    'data' => null,
                ], 401);
            }


            // Validate the incoming data
            $validateData = Validator::make($request->all(), [
                'rating' => 'required|integer|between:1,5',
                'comment' => 'nullable|string|max:255',
            ]);

            if ($validateData->fails()) {
                return response()->json([
                    'code' => 400,
                    'msg' => 'Bad Request',
                    'data' => $validateData->errors(),
                ], 400);
            }

            $recipe = Recipe::find($recipe_id);

            if (!$recipe) {
                return response()->json([
                    'code' => 404,
                    'msg' => 'Recipe not found',
                    'data' => null,
                ], 404);
            }



            // Get the validated data
            $validated = $validateData->validated();

            $validated['user_token'] = $token;
            $validated['created_at'] = Carbon::now();
            $validated['updated_at'] = Carbon::now();

            // Create a new review associated with the recipe
            $review = $recipe->reviews()->create($validated);

            return response()->json([
                'code' => 200,
                'msg' => 'Comment added successfully',
                'data' => $review,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'msg' => 'Internal Server Error',
                'data' => $th->getMessage(),
            ], 500);
        }
    }



    public function show($recipe_id)
    {
        $recipe = Recipe::with('reviews')->findOrFail($recipe_id);

        return response()->json(['recipe' => $recipe], 200);
    }
}
