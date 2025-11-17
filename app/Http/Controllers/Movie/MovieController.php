<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Requests\Movie\MovieCreateRequest;
use App\Http\Requests\Movie\MovieEditRequest;

class MovieController extends Controller
{
    public function index(){
        $movies = Movie::with('genre')->get();

        if($movies->isEmpty()){
            return response()->json([
                'message' => 'There are no movies yet',
            ], 404);
        }

        return response()->json([
            'message' => 'Movies found',
            'data' => $movies,
        ], 200);
    }

    public function create(MovieCreateRequest $request){

        $data = $request->validated();
        $movie = new Movie(collect($data)->except('poster')->toArray());

        if ($request->hasFile('poster')) {
            $movie->poster = $request->file('poster')->store('posters', 'public');
        }

        $movie->save();

        $movie->genre()->attach($data['genre']);

        return response()->json([
            'message' => 'Movie created successfully',
            'data' => $movie,
        ], 201);
    }

    public function edit(MovieEditRequest $request, $id) {
        $data = $request->validated();
        
        $movie = Movie::find($id);
        
        if (!$movie) {
            return response()->json([
                'message' => 'Movie not found'
            ], 404);
        }

        $updateData = collect($data)->except('poster', 'genre')->toArray();
        $updated = $movie->update($updateData);

        if ($request->hasFile('poster')) {
            $movie->poster = $request->file('poster')->store('posters', 'public');
            $movie->save();
        }

        if (isset($data['genre'])) {
            $movie->genre()->sync($data['genre']);
        }

        $movie->refresh();
        $movie->load('genre');

        return response()->json([
            'message' => 'Movie updated successfully',
            'data' => $movie
        ], 200);
    }

    public function delete($id){
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                'message' => 'Movie not found'
            ], 404);
        }

        $movie->delete();

        return response()->json([
            'message' => 'Movie deleted successfully'
        ], 200);
    }
}
