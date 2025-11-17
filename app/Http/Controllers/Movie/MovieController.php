<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\MovieCreateRequest;
use App\Http\Requests\Movie\MovieEditRequest;
use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $per_page = $request->input('per_page', 10);

        $movies = Movie::with('genre')->paginate($per_page, ['*'], 'page', $page);

        if ($movies->isEmpty()) {
            return response()->json([
                'message' => 'There are no movies yet',
            ], 404);
        }

        return response()->json([
            'message' => 'Movies found',
            'data' => $movies,
        ], 200);
    }

    public function create(MovieCreateRequest $request)
    {

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

    public function edit(MovieEditRequest $request, $id)
    {
        $data = $request->validated();

        $movie = Movie::find($id);

        if (! $movie) {
            return response()->json([
                'message' => 'Movie not found',
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
            'data' => $movie,
        ], 200);
    }

    public function delete($id)
    {
        $movie = Movie::find($id);

        if (! $movie) {
            return response()->json([
                'message' => 'Movie not found',
            ], 404);
        }

        $movie->delete();

        return response()->json([
            'message' => 'Movie deleted successfully',
        ], 200);
    }

    public function show($id){
        $movie = Movie::find($id)->with('genre');

        if(!$movie){
            return response()->json([
                'message' => 'Movie not found',
            ], 404);
        }

        return response()->json([
            'message' => 'Movie found',
            'data' => [
                "title" => $movie->title
            ],
        ], 200);
    }
}
