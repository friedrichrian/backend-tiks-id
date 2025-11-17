<?php

namespace App\Http\Controllers\Theater;

use Illuminate\Http\Request;
use App\Models\Theater;
use App\Http\Controllers\Controller;
use App\Http\Requests\Theater\TheaterCreateRequest;
use App\Http\Requests\Theater\TheaterEditRequest;

class TheaterController extends Controller
{
    public function index(){
        $theater = Theater::all();

        if($theater->isEmpty()){
            return response()->json([
                'message' => 'Theater not found',
            ], 404);
        }

        return response()->json([
            'message' => 'Theater found',
            'data' => $theater,
        ], 200);
    }

    public function create(TheaterCreateRequest $request){
        $theater = Theater::Create($request->validated());

        return response()->json([
            'message' => 'Theater created successfully',
            'data' => $theater,
        ], 201);
    }

    public function edit(TheaterEditRequest $request, $id){
        $theater = Theater::find($id);

        if(!$theater){
            return response()->json([
                'message' => 'Theater not found',
            ], 404);
        }

        $theater->update($request->validated());

        return response()->json([
            'message' => 'Theater updated successfully',
            'data' => $theater,
        ], 200);
    }

    public function delete($id){
        $theater = Theater::find($id);

        if(!$theater){
            return response()->json([
                'message' => 'Theater not found',
            ], 404);
        }

        $theater->delete();

        return response()->json([
            'message' => 'Theater deleted successfully',
        ], 200);
    }
}
