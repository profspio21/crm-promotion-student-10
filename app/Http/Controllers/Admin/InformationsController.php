<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use App\Models\Comments;
use App\Http\Requests\StoreInformationRequest;
use App\Http\Requests\UpdateInformationRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Illuminate\Support\Facades\DB;

class InformationsController extends Controller
{
    use MediaUploadingTrait;
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        abort_if(Gate::denies('information_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $type = $request->type;
        $informations = Information::where('type', $type)->get();

        return view('admin.informations.index', compact('type', 'informations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $type = $request->type;
        return view('admin.informations.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInformationRequest $request)
    {
        //
        DB::transaction(function () use($request) {
            
            $information = Information::create($request->all());

            // Photo
            if ($request->input('poster', false)) {
                $information->addMedia(storage_path('tmp/uploads/' . basename($request->input('poster'))))->toMediaCollection('poster');
            }

            if ($media = $request->input('ck-media', false)) {
                Media::whereIn('id', $media)->update(['model_id' => $information->id]);
            }
        });

        return redirect()->route('admin.informations.index', ['type'=> $request->type]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Information $information, Request $request)
    {
        //
        abort_if(Gate::denies('information_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $type = $request->type;

        return view('admin.informations.show', compact('type','information'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Information $information, Request $request)
    {
        //
        abort_if(Gate::denies('information_crud'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $type = $request->type;
        return view('admin.informations.edit', compact('type','information'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInformationRequest $request, Information $information)
    {
        //
        $information->update($request->all());

        if ($request->input('poster', false)) {
            if (! $information->poster || $request->input('poster') !== $information->poster->file_name) {
                if ($information->poster) {
                    $information->poster->delete();
                }
                $information->addMedia(storage_path('tmp/uploads/' . basename($request->input('poster'))))->toMediaCollection('poster');
            }
        } elseif ($information->poster) {
            $information->poster->delete();
        }

        return redirect()->route('admin.informations.index', ['type' => $information->type]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Information $information, Request $request)
    {
        //
        abort_if(Gate::denies('information_crud'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $information->delete();

        return back();

    }

    public function massDestroy(Request $request)
    {
        $informations = Information::find(request('ids'));

        foreach ($informations as $information) {
            $information->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        $model         = new Registrant();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
