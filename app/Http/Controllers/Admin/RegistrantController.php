<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRegistrantRequest;
use App\Http\Requests\StoreRegistrantRequest;
use App\Http\Requests\UpdateRegistrantRequest;
use App\Models\Registrant;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Illuminate\Support\Facades\DB;

class RegistrantController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('registrant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = $request->status;

        $registrants = Registrant::with(['user'])->where('status', $status)->where('verified', 1)->get();

        return view('admin.registrants.index', compact('registrants', 'status'));
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('registrant_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = $request->status;

        return view('admin.registrants.create', compact('status'));
    }

    public function store(StoreRegistrantRequest $request)
    {
        DB::transaction(function () use ($request) {

            $registrant = Registrant::create($request->only(['nomor_daftar','name','phone','tgl_lahir','prodi','status']));

            // Buat user baru
            if($request->username && $request->password && $request->email) {
                $user = User::create([
                    'username' => $request->username,
                    'email'    => $request->email,
                    'password' => $request->password
                    ]);
                $user->roles()->sync(3);  // set roles, 3 untuk registrant
                $registrant->update(['user_id' => $user->id]); // set user_id ke registrant
            }

            // Photo
            if ($request->input('photo', false)) {
                $registrant->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }

            if ($media = $request->input('ck-media', false)) {
                Media::whereIn('id', $media)->update(['model_id' => $registrant->id]);
            }

        });

        return redirect()->route('admin.registrants.index', ['status' => $request->status]);

    }

    public function edit(Registrant $registrant, Request $request)
    {
        abort_if(Gate::denies('registrant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $registrant->load('user');

        $status = $request->status;

        return view('admin.registrants.edit', compact('registrant', 'status'));
    }

    public function update(UpdateRegistrantRequest $request, Registrant $registrant)
    {
        DB::transaction(function () use ($request, $registrant) {
            
            $registrant->update($request->only(['nomor_daftar','name','phone','tgl_lahir','prodi','status']));

            // Buat user baru jika belum ada, update jika sudah ada
            if($request->username && $request->password && $request->email) {
                if(!empty($registrant->user_id)) {
                    $user = $registrant->user;
                    $user->update([
                        'username' => $request->username,
                        'email'    => $request->email,
                        'password' => $request->password
                        ]);
                }
                if(empty($registrant->user_id)) {
                    $user = User::create([
                        'username' => $request->username,
                        'email'    => $request->email,
                        'password' => $request->password
                        ]);
                    $user->roles()->sync(3);  // set roles, 3 untuk registrant
                    $registrant->update(['user_id' => $user->id]); // set user_id ke registrant
                }
                
            }
        });

        return redirect()->route('admin.registrants.index', ['status' => $request->status]);
    }

    public function show(Registrant $registrant, Request $request)
    {
        abort_if(Gate::denies('registrant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $registrant->load('user');

        $status = $request->status;

        return view('admin.registrants.show', compact('registrant', 'status'));
    }

    public function destroy(Registrant $registrant)
    {
        abort_if(Gate::denies('registrant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = $registrant->user;
        if(isset($user)) {
            $user->delete();
        }

        $registrant->delete();

        return back();
    }

    public function massDestroy(MassDestroyRegistrantRequest $request)
    {
        $registrants = Registrant::find(request('ids'));

        foreach ($registrants as $registrant) {
            $user = $registrant->user;
            if(isset($user)) {
                $user->delete();
            }
            $registrant->delete();
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