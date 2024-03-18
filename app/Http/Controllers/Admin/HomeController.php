<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Information;
use App\Models\Expo;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class HomeController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        $now = Carbon::now();
        if($user->hasRole('admin')) {
            $selection_informations = Information::with('comments')->where('type', '0')
                        ->where('start_publish_date', '<=', $now)->where('end_publish_date', '>=', $now)
                        ->get();
            $activity_informations = Information::where('type', '1')
                        ->where('start_publish_date', '<=', $now)->where('end_publish_date', '>=', $now)
                        ->get();
        }
        if($user->registrant) {
            $selection_informations = Information::with('comments')->where('target', $user->registrant ? $user->registrant->status : '99')->where('type', '0')
                        ->where('start_publish_date', '<=', $now)->where('end_publish_date', '>=', $now)
                        ->get();
            $activity_informations = Information::where('target', $user->registrant ? $user->registrant->status : '99')->where('type', '1')
                        ->where('start_publish_date', '<=', $now)->where('end_publish_date', '>=', $now)
                        ->get();
        }

        return view('home', compact('selection_informations', 'activity_informations'));
    }

    public function graph(Request $request)
    {
        $startDate = Carbon::createFromFormat('d-m-Y', $request->startDate);
        $endDate = Carbon::createFromFormat('d-m-Y', $request->endDate);

        $expo['jawa'] = Expo::with('detailExpo')->where('type', '0')->whereBetween('tanggal', [$startDate, $endDate])->count();
        $expo['luar_jawa'] = Expo::with('detailExpo')->where('type', '1')->whereBetween('tanggal', [$startDate, $endDate])->count();
        $expo_prodi = Expo::select('prodi')
                        ->whereBetween('tanggal', [$startDate, $endDate])
                        ->groupBy('prodi')
                        ->orderBy('prodi')
                        ->get()
                        ->toArray();

        $prodiCounts = array_count_values(array_column($expo_prodi, 'prodi'));

        return response()->json(['success' => true, 'expo' => $expo], 200);
    }
}
