<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feeder;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
        $id_user = Auth::user()->id;

        $feeders = Feeder::where('id_user', $id_user)->get();
        $cleanedFeeders = [];
        foreach($feeders as $feeder)
        {
            $schedules = Schedule::where('id_feeder', $feeder->id)->get();
            $cleanedFeeders[$feeder->id] = [
                "id" => $feeder->id,
                "name" => $feeder->nome,
                "id_user" => $feeder->id_user,
                "code" => $feeder->code,
                "status" => $feeder->status,
                "location" => $feeder->location,
                "pet_type" => $feeder->pet_type,
                "last_fed_at" => $feeder->last_fed_at,
                "schedules" => []
            ];
            foreach($schedules as $schedule)
            {
                $cleanedFeeders[$feeder->id]["schedules"][] = [
                    'id' => $schedule->id,
                    'id_feeder' => $schedule->id_feeder,
                    'hour' => $schedule->hour,
                    'quantity' => $schedule->quantity,
                    'type' => $schedule->type,
                    'days' => $schedule->days,
                ];
            }
        }
        return view('schedule.index', compact('cleanedFeeders'));
    }
    public function store(Request $request, $feeder)
    {
        $validated = $request->validate([
            'hour' => 'required|date_format:H:i',
            'quantity' => 'required|integer',
            'type' => 'required|string',
            'days' => 'array|nullable',
            'days.*' => 'integer'
        ]);
    
        try {
            Schedule::create(array_merge($validated, ['id_feeder' => $feeder]));
            return redirect()->back()->with('success', 'Horário criado com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
    public function update(Request $request, $feeder, $scheduleId)
    {
        $validated = $request->validate([
            'hour' => 'required|date_format:H:i',
            'quantity' => 'required|integer',
            'type' => 'required|string',
            'days' => 'array|nullable',
            'days.*' => 'integer'
        ]);
    
        try {
            $schedule = Schedule::findOrFail($scheduleId);
            $schedule->update(array_merge($validated, ['id_feeder' => $feeder]));
            return redirect()->back()->with('success', 'Horário atualizado com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}    


