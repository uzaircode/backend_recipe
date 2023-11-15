<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IngredientWiki;

class IngredientWikiController extends Controller
{
    public function ingredientWiki()
    {
        $result = IngredientWiki::select('id', 'name', 'thumbnail', 'description', 'seasonality', 'storage', 'cooking_tips', 'health_benefits')->get();

        return response() -> json([
            'code' => 200,
            'msg' => 'success',
            'data' => $result
        ], 200);
    }

}