<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailExpo;
use App\Models\Expo;
use App\Http\Requests\StoreDetailExpoRequest;
use App\Http\Requests\UpdateDetailExpoRequest;
use App\Http\Controllers\Traits\CsvImportTrait;

class DetailExpoController extends Controller
{

    use CsvImportTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        dd('ok');
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
        dd($request->all());
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
    public function show(DetailExpo $detailExpo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailExpo $detailExpo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDetailExpoRequest $request, DetailExpo $detailExpo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailExpo $detailExpo)
    {
        //
    }
}
