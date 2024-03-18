<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registrant;
use PDF;
use Carbon\Carbon;

class ReportController extends Controller
{
    //

    public function registrant(Request $request)
    {
        $status = Registrant::STATUS_SELECT[$request->status];
        $startDate = Carbon::createFromFormat('Y-m-d', $request->startDate)->format('d F Y');
        $endDate = Carbon::createFromFormat('Y-m-d', $request->endDate)->format('d F Y');
        $now = Carbon::now()->format('d F Y');

        $registrants = Registrant::where('status', $request->status)->whereBetween('created_at', [$request->startDate, $request->endDate])->get();

        $pdf = PDF::loadview('reportRegistrant', ['registrants' => $registrants, 'status' => $status, 'startDate' => $startDate, 'endDate' => $endDate, 'now' => $now]);

        return $pdf->stream();
    }
}
