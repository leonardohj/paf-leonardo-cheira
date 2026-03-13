<?php

namespace App\Http\Controllers;

use App\Models\Feeder;
use App\Models\Schedule;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ScheduleController extends Controller
{
    public function index()
    {
        $feeders = Feeder::where('id_user', Auth::id())->get();

        $schedules = Schedule::whereIn('feeder_id', $feeders->pluck('id'))->get();
        
        return view('schedule.index', compact('feeders', 'schedules'));
    }
    public function store(Request $request)
    {
        // Trim time to H:i
        $request->merge([
            'time' => substr($request->time, 0, 5)
        ]);
    
        $validated = $request->validate([
            'time'      => 'required|date_format:H:i',
            'quantity'  => 'required|integer|min:1',
            'type'      => 'required|in:always,specific',
            'days'      => 'nullable|array',
            'days.*'    => 'in:Seg,Ter,Qua,Qui,Sex,Sáb,Dom',
        ]);
    
        try {
            // Check that feeder belongs to user
            $feeder = Feeder::where('id', $validated['feeder_id'])
                ->where('id_user', Auth::id())
                ->firstOrFail();
    
            // Convert days to null if type is 'always'
            if ($validated['type'] === 'always') {
                $validated['days'] = null;
            }
    
            // Create schedule
            Schedule::create($validated);
    
            echo 'a';
        } catch (Throwable $e) {
            return $e;
        }
    }
    public function update(Request $request, $schedule_id)
{
    $validated = $request->validate([
        'feeder_id' => 'required|exists:feeders,id',
        'time'      => 'required|date_format:H:i',
        'quantity'  => 'required|integer|min:1',
        'type'      => 'required|in:always,specific',
        'days'      => 'nullable|array',
        'days.*'    => 'in:Seg,Ter,Qua,Qui,Sex,Sáb,Dom',
    ]);

    try {
        // verify feeder belongs to logged user
        $feeder = Feeder::where('id', $validated['feeder_id'])
            ->where('id_user', Auth::id())
            ->firstOrFail();

        $schedule = Schedule::where('id', $schedule_id)
            ->where('feeder_id', $feeder->id)
            ->firstOrFail();

        $schedule->update($validated);

        return redirect()->back()->with('success', 'Horário atualizado com sucesso!');

    } catch (Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}
}