<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use App\Http\Requests\StoreInformationRequest;
use App\Http\Requests\UpdateInformationRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class ActivityInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        $now = Carbon::now()->format('Y-m-d');

        $user = auth()->user();

        if($user->hasRole('admin') || $user->hasRole('staff')) {
            $informations = Information::where('type', '1')
                        ->where('start_publish_date', '<=', $now)->where('end_publish_date', '>=', $now)
                        ->get();
        }
        if($user->registrant) {
            $informations = Information::where('target', $user->registrant ? $user->registrant->status : '99')->where('type', '1')
                        ->where('start_publish_date', '<=', $now)->where('end_publish_date', '>=', $now)
                        ->get();
        }

        return view('admin.activity-informations.index', compact('informations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Information $information)
    {
        //
        $now = Carbon::now();
        
        if(auth()->user()->hasRole('Pendaftar') && $information->start_publish_date > $now) {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        return view('admin.activity-informations.show', compact('information'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Information $information)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Information $information)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Information $information)
    {
        //
    }
}
