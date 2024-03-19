<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expo;
use App\Models\DetailExpo;
use App\Http\Requests\StoreExpoRequest;
use App\Http\Requests\UpdateExpoRequest;
use App\Http\Requests\MassDestroyExpoRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Traits\CsvImportTrait;
use PDF;
use Carbon\Carbon;

class ExpoController extends Controller
{
    use CsvImportTrait;
    
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        //
        abort_if(Gate::denies('expo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $type = $request->type;
        $expoes = Expo::with('detailExpo')->where('type', $type)->get();

        return view('admin.expoes.index', compact('expoes', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        abort_if(Gate::denies('expo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $type = $request->type;

        return view('admin.expoes.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $expo = Expo::create([
                'type'    => $request->type,
                'tanggal' => $request->tanggal,
                'tempat'  => $request->tempat,
                'pic'     => $request->pic,
            ]);
    
            if (isset($request->detail['name']) && count($request->detail['name']) > 0) {
                foreach ($request->detail['name'] as $index => $data) {
                    DetailExpo::create([
                        'expo_id' => $expo->id,
                        'name'    => $request->detail['name'][$index],
                        'email'   => $request->detail['email'][$index],
                        'phone'   => $request->detail['phone'][$index],
                        'jurusan' => $request->detail['jurusan'][$index],
                        'prodi'   => $request->detail['prodi'][$index],
                    ]);
                }
            }
        });

        return redirect()->route('admin.expoes.index', ['type' => $request->type]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Expo $expo, Request $request)
    {
        //
        abort_if(Gate::denies('expo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $type = $request->type;
        $expo->load('detailExpo');

        return view('admin.expoes.show', compact('expo', 'type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expo $expo, Request $request)
    {
        //
        abort_if(Gate::denies('expo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $type = $request->type;
        $expo->load('detailExpo');

        return view('admin.expoes.edit', compact('expo', 'type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expo $expo)
    {
        //
        DB::transaction(function () use ($request, $expo) {
            $allDetailIds = $expo->detailExpo->pluck('id')->toArray();
    
            foreach ($request->detail['name'] as $index => $name) {
                $detailId = $request->detail['id'][$index] ?? null;
    
                if ($detailId && in_array($detailId, $allDetailIds)) {
                    // Update existing detail
                    DetailExpo::where('id', $detailId)->update([
                        'name' => $name,
                        'email' => $request->detail['email'][$index],
                        'phone' => $request->detail['phone'][$index],
                        'jurusan' => $request->detail['jurusan'][$index],
                        'prodi' => $request->detail['prodi'][$index],
                    ]);
                    unset($allDetailIds[array_search($detailId, $allDetailIds)]);
                } else {
                    // Create new detail
                    $expo->detailExpo()->create([
                        'name' => $name,
                        'email' => $request->detail['email'][$index],
                        'phone' => $request->detail['phone'][$index],
                        'jurusan' => $request->detail['jurusan'][$index],
                        'prodi' => $request->detail['prodi'][$index],
                    ]);
                }
            }
    
            // Delete removed details
            DetailExpo::whereIn('id', $allDetailIds)->delete();
        });

        return redirect()->route('admin.expoes.index', [ 'type'=> $request->type]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expo $expo, Request $request)
    {
        //
        abort_if(Gate::denies('expo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expo->delete();

        return redirect()->route('admin.expoes.index', ['type' => $request->type]);
    }

    public function massDestroy(MassDestroyExpoRequest $request)
    {
        //
        abort_if(Gate::denies('expo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expoes = Expo::find(request('ids'));

        foreach ($expoes as $expo) {
            $expo->delete();
        }

        return redirect()->route('admin.expoes.index', ['type' => $request->type]);
    }

    public function report(Request $request)
    {
        $type = Expo::TYPE_SELECT[$request->type];
        $startDate = Carbon::createFromFormat('Y-m-d', $request->startDate)->format('d F Y');
        $endDate = Carbon::createFromFormat('Y-m-d', $request->endDate)->format('d F Y');
        $now = Carbon::now()->format('d F Y');

        $expos = Expo::where('type', $request->type)->whereBetween('created_at', [$request->startDate, $request->endDate])->get();

        $pdf = PDF::loadview('report.expo', ['expos' => $expos, 'type' => $type, 'startDate' => $startDate, 'endDate' => $endDate, 'now' => $now]);
        
        return $pdf->stream();
    }

    public function reportDetailExpo(Request $request)
    {
        $expo = Expo::with('detailExpo')->findOrFail($request->expo_id);
        $now = Carbon::now()->format('d F Y');

        $pdf = PDF::loadview('report.detailExpo', ['expo' => $expo, 'now' => $now]);

        return $pdf->stream();

    }

}
