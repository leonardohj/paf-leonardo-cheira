<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feeder;
use App\Models\Schedule;
use App\Models\FeedingLog;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FeederController extends Controller
{
    public function index()
    {
    $feeders = Feeder::where('id_user', Auth::user()->id)->get();
    return view('feeder.index', compact('feeders'));
    }
    
    public function store(Request $request)
    {
        $lastFeeder = Feeder::latest('id')->value('id');

        $data = [
            'nome' => 'Feeder ' . ($lastFeeder ? $lastFeeder + 1 : 1),
            'code' =>  hexdec(uniqid()) 
        ];
        
        Feeder::create($data);

        return redirect()->back();
    }

    public function linkingFeederUser(Request $request)
    {
        $id_user = Auth::user()->id;
        $validation = $request->validate([
            'code' => 'required|exists:feeder,code',
        ]);

        $code = $request->input('code');

        $feeder = Feeder::where('code', $code)->first();

        if($feeder)
        {
            $feeder->id_user = $id_user;
            $feeder->save();
        }

			return redirect()->route('feeder');
}

    public function show(Request $request)
    {
        $user_id = $request->input('id_user');

    if (Auth::check() && Auth::user()->id) {
        $feeder_id = $request->input('feeder_id');
        $feeder = Feeder::find($feeder_id);
        $logs = FeedingLog::where('id_feeder', $feeder_id)->orderByDesc('id')->take(3)->get();
        if ($feeder) {
            return view('feeder.show', compact('feeder', 'logs'));
        } else {
            return redirect()->back()->with('error', 'Feeder not found.');
        }
    }

    return redirect()->back();
    }

    public function activateManually($feeder, Request $request)
    {
				$horaAtivar = now()->addMinutes(1);
				$validated = [
					'hour' =>  $horaAtivar,
					'quantity' => $request->input('quantity'),
					'type' => 'deleteAfter1Use',
				];
				try {
					Schedule::create(array_merge(
							$validated, 
							['id_feeder' => $feeder]
					));
				} catch (\Exception $e) {
						var_dump($e->getMessage());
				}
		}

		public function activate($feeder, Request $request)
    {
			$hora = now();
			$data = now()->toDateString(); // '2025-11-30'
			var_dump($data);
			$values = [
				'id_feeder' => $feeder,
				'date' => $data,
				'hour' => $hora,
				'quantity' => 100,
				'status' => 'OK',
			];
			try {
					FeedingLog::create($values);
					echo 'a';
			} catch (\Throwable $th) {
					echo 'b';

			}
	}
		}




