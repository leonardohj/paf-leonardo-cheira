<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Schedule;
use App\Models\Feeder;
use App\Models\Feedinglog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index() 
{
    $id_user = Auth::user()->id;
    $feeders = Feeder::where('id_user', $id_user)->get();

    $cleanedLogs = [];
    $mensalStats = [
        "total" => 0,
        "media" => 0,
        "alimentacoes" => 0,
        "last_alimentacao" => '-'
    ];
    $classicLogs = [];

    if ($feeders) {
        foreach($feeders as $feeder)
        {
            $cleanedFeeders[$feeder->id] = [
                "logs" => [],
                "mensal_stats" => [
                    "total" => 0,
                    "media" => 0,
                    "alimentacoes" => 0,
                    "last_alimentacao" => '-'
                ],
                "last_3_logs" => []
            ];
        
            $logs = FeedingLog::where('id_feeder', $feeder->id)->get();
            $logs3 = FeedingLog::where('id_feeder', $feeder->id)
            ->orderByDesc('id')
            ->take(3)
            ->get();

            foreach ($logs3 as $log) {
                $cleanedFeeders[$feeder->id]["last_3_logs"][] = [
                    "date" => $log["date"],
                    "hour" => $log["hour"],
                    "quantity" => $log["quantity"],
                    "alimentador" => $feeders->nome,
                ];
            }

        
        for($m = 1; $m <= 12; $m++)
        {
            for ($w = 1; $w <= 4; $w++) {
                $cleanedFeeders[$feeder->id]["logs"][$m][$w] = array_fill(0, 7, 0); 
            }
        }
        

        foreach ($logs as $log) {
            $date = Carbon::create($log['date']);
            $weekOfMonth = ceil($date->day / 7);
            $weekday = $date->dayOfWeek;
            $month = $date->month();

            if (!isset($cleanedFeeders["logs"][$month][$weekOfMonth])) {
                $cleanedFeeders["logs"][$month][$weekOfMonth] = array_fill(0, 7, 0);
            }

            $cleanedLogs[$weekOfMonth][$weekday] += $log['quantity'];
            $mensalStats["total"] += $log["quantity"];
            $mensalStats["alimentacoes"]++;
        }

        $mensalStats["media"] = ceil($mensalStats["total"] / $mensalStats["alimentacoes"]);
        $mensalStats["last_alimentacao"] = $logs->first()["date"];
    }

    return view('index', compact('feeders', 'cleanedLogs', 'mensalStats', 'classicLogs'));
}

}
