<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Schedule;
use Illuminate\Validation\Validator;

class GramsController extends Controller
{
    public function index(Request $request)
    {
        return view('welcome');
    }

    public function store(Request $request, Schedule $schedule): JsonResponse
    {
        $validated = $request->validate([
            'id_feeder' => 'required|int',
            'date'   => 'required|string',
        ]);

        $schedule = Schedule::create($validated);

        

        return response()->json($schedule, 200, [], JSON_PRETTY_PRINT);
    }
}