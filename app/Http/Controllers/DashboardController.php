<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Schedule;
use App\Models\Feeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $id_user = Auth::user()->id;

        $feeders = Feeder::where('id_user', $id_user)->get();

        return view('index', compact('feeders'));
    }
}
