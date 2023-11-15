<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class IngredientWikiController extends Controller
{
    public function ingredientWiki()
    {
        $ingredientWiki = \App\Models\IngredientWiki::select('id', 'name', 'thumbnail', 'description', 'seasonality', 'storage', 'cooking_tips', 'health_benefits')->get();
        return response()->json($ingredientWiki);
    }

}