<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Feeder;
use App\Models\FeedingLog;

class ApiController extends Controller
{
    protected $Username;
    protected $Password;
    public function __construct()
    {
        $this->Username = 'api1234';
        $this->Password = '1234';
    }

    public function GetSchedules(Request $request)
    {
        $feederId = $request->query('feeder_id');
        $username = $request->query('username');
        $password = $request->query('password');

        if (!$feederId || !$username || !$password) {
            return response()->json(['error' => 'feeder_id, username and password are required'], 400);
        }

        if ($username !== $this->Username || $password !== $this->Password) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $schedules = Schedule::where('id_feeder', $feederId)->get();

        return response()->json($schedules);
    }

    public function GetFeeders(Request $request)
    {
        $feederId = $request->query('feeder_id');
    
        if (!$feederId) {
            return response()->json(['error' => 'feeder_id is required'], 400);
        }
    
        $feeder = Feeder::find($feederId);
    
        if (!$feeder) {
            return response()->json(['error' => 'Feeder not found'], 404);
        }
    
        return response()->json($feeder);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_feeder' => 'required|integer|exists:feeders,id',
            'date' => 'required|string',
            'hour' => 'required|string',
            'quantity' => 'required|int',
            'status' => 'required|string'
        ]);
        
       $feeding_log = FeedingLog::create($validated);

        return response()->json($feeding_log, 201);
    }
}
