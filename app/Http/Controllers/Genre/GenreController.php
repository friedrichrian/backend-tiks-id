<?php

namespace App\Http\Controllers\Genre;

use App\Http\Controllers\Controller;
use App\Http\Requests\Genre\GenreCreateRequest;
use App\Http\Requests\Genre\GenreEditRequest;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index(){
        $genre = Genre::all();

        if ($genre->isEmpty()) {
            return response()->json([
                'message' => 'Genre not found',
            ], 404);
        }

        return response()->json([
            'message' => 'Genre found',
            'data' => $genre,
        ], 200);
    }

    public function create(GenreCreateRequest $request){
        $genre = Genre::create($request->validated());

        return response()->json([
            'message' => 'Genre created successfully',
            'data' => $genre,
        ], 201);
    }

    public function edit(GenreEditRequest $request, $id){
        $genre = Genre::find($id);

        if(!$genre){
            return response()->json([
                'message' => 'Genre not found',
            ], 404);
        }

        $genre->update($request->validated());

        return response()->json([
            'message' => 'Genre updated successfully',
            'data' => $genre,
        ], 200);
    }

    public function delete($id){
        $genre = Genre::find($id);

        if(!$genre){
            return response()->json([
                'message' => 'Genre not found',
            ], 404);
        }

        $genre->delete();

        return response()->json([
            'message' => 'Genre deleted successfully',
        ], 200);
    }
}
