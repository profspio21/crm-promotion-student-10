<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Information;
use App\Models\Expo;
use App\Models\DetailExpo;
use App\Models\Registrant;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

        $expo['jawa'] = Expo::where('type', '0')->whereBetween('tanggal', [$request->startDate, $request->endDate])->count();
        $expo['luar_jawa'] = Expo::where('type', '1')->whereBetween('tanggal', [$request->startDate, $request->endDate])->count();
        $expo_prodi = DetailExpo::select('prodi', DB::raw('COUNT(*) as count'))
                        ->whereHas('expo', function($q) use ($request) {
                            $q->whereBetween('tanggal', [$request->startDate, $request->endDate]);
                        })
                        ->groupBy('prodi')
                        ->orderBy('prodi')
                        ->get()
                        ->toArray();
        $all_registrants = Registrant::select('status', DB::raw('COUNT(*) as count'))
                        ->whereBetween('created_at', [$request->startDate, $request->endDate])
                        ->groupBy('status')
                        ->orderBy('status')
                        ->get()
                        ->toArray();

        $registrants = array_map(function($item) {
                            return [
                                'status_label' => $item['status_label'],
                                'count' => $item['count']
                            ];
                        }, $all_registrants);


        $prodiCounts = array_count_values(array_column($expo_prodi, 'prodi'));

        return response()->json(['success' => true, 'expo' => $expo, 'expo_prodi' => $expo_prodi, 'registrants' => $registrants], 200);
    }
}
