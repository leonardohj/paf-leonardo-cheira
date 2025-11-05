<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        // $schedules = Feeder::all();
        return view('schedule.index');
    }
}
