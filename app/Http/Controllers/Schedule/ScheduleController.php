<?php

namespace App\Http\Controllers\Schedule;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Requests\Schedule\ScheduleCreateRequest;
use App\Http\Requests\Schedule\ScheduleEditRequest;

class ScheduleController extends Controller
{
    public function index(){
        $schedules = Schedule::with('movie', 'theater')->get();

        if ($schedules->isEmpty()) {
            return response()->json([
                'message' => 'Schedule not found',
            ], 404);
        }

        $data = $schedules->map(function ($schedule) {
            return [
                'id' => $schedule->id,
                'movie_name' => $schedule->movie->title,
                'movie_poster' => $schedule->movie->poster,
                'theater_name' => $schedule->theater->name,
                'movie_duration' => $schedule->movie->duration,
                'schedule_price' => $schedule->price,
                'schedule_start_time' => \Carbon\Carbon::parse($schedule->start_time)->format('H:i'),
                'schedule_end_time' => \Carbon\Carbon::parse($schedule->start_time)->addMinutes($schedule->movie->duration)->format('H:i'),
            ];
        });

        return response()->json([
            'message' => 'Schedule found',
            'data' => $data
        ], 200);

    }

    public function create(ScheduleCreateRequest $request){
        $schedule = Schedule::create($request->validated());

        return response()->json([
            'message' => 'Schedule created successfully',
            'data' => $schedule,
        ], 201);
    }

    public function edit(ScheduleEditRequest $request, $id){
        $schedule = Schedule::find($id);

        if(!$schedule){
            return response()->json([
                'message' => 'Schedule not found',
            ], 404);
        }

        $schedule->update($request->validated());

        return response()->json([
            'message' => 'Schedule updated successfully',
            'data' => $schedule,
        ], 200);
    }

    public function delete($id){
        $schedule = Schedule::find($id);

        if(!$schedule){
            return response()->json([
                'message' => 'Schedule not found',
            ], 404);
        }

        $schedule->delete();

        return response()->json([
            'message' => 'Schedule deleted successfully',
        ], 200);
    }
}
