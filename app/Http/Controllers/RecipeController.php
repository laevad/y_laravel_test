<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{

    public function __construct()
    {
        // $this->middleware('jwt-check', ["except" => ["index", "show"]]);
        $this->middleware('jwt-check', ["except" => ["index", "show"]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return Recipe::select("id", "name", "description", "category_id")->paginate(10);
        return Recipe::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $recipe = new Recipe;
        $recipe->name = $request->input('name');
        $recipe->user_id = auth('api')->user()->id;
        $recipe->description = $request->input('description', NULL);
        $recipe->category_id = $request->input('category_id');
        $recipe->save();

        return response()->json(["message" => "Recipe Added", "recipe" => $recipe]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $recipe = Recipe::find($id);
        if ($recipe == NULL) {
            return  response()->json(["message" => 'Recipe is not Found'], 404);
        }
        return response()->json($recipe, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $recipe = Recipe::find($id);
        if ($recipe == NULL) {
            return  response()->json(["message" => 'Recipe is not Found'], 404);
        }

        if ($request->has('name')) {
            $recipe->name = $request->input("name");
        }
        if ($request->has('description')) {
            $recipe->description = $request->input("description");
        }
        if ($request->has('category')) {
            $recipe->category_id = $request->input("category");
        }
        $recipe->save();

        return response()->json(["message" => "Recipe updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $recipe = Recipe::find($id);
        if ($recipe == NULL) {
            return  response()->json(["message" => 'Recipe is not Found'], 404);
        }
        $recipe->delete();
        return response()->json(["message" => "Recipe deleted"]);
    }
}
