<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feeder;
use Illuminate\Support\Facades\Auth;

class FeederController extends Controller
{
    public function index()
    {
    $feeders = Feeder::all();
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

        return redirect()->back();
    }
    public function show(Request $request)
    {
        $user_id = $request->input('id_user');

    if (Auth::check() && Auth::user()->id) {
        $feeder_id = $request->input('feeder_id');
        $feeder = Feeder::find($feeder_id);

        if ($feeder) {
            return view('feeder.show', compact('feeder'));
        } else {
            return redirect()->back()->with('error', 'Feeder not found.');
        }
    }

    return redirect()->back();

            
    }
}
