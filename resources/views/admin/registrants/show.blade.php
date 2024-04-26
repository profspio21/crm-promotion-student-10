@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.registrant.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.registrants.index', ['status' => $registrant->status]) }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.registrant.fields.id') }}
                        </th>
                        <td>
                            {{ $registrant->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registrant.fields.nomor_daftar') }}
                        </th>
                        <td>
                            {{ $registrant->nomor_daftar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registrant.fields.nim') }}
                        </th>
                        <td>
                            {{ $registrant->nim }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registrant.fields.name') }}
                        </th>
                        <td>
                            {{ $registrant->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registrant.fields.tgl_lahir') }}
                        </th>
                        <td>
                            {{ $registrant->tgl_lahir }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registrant.fields.prodi') }}
                        </th>
                        <td>
                            {{ $registrant->prodi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registrant.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Registrant::STATUS_SELECT[$registrant->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registrant.fields.user') }}
                        </th>
                        <td>
                            {{ $registrant->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registrant.fields.user') }}
                        </th>
                        <td>
                            {{ $registrant->user->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registrant.fields.user') }}
                        </th>
                        <td>
                            {{ $registrant->phone ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registrant.fields.photo') }}
                        </th>
                        <td>
                            @if($registrant->photo)
                                <a href="{{ $registrant->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $registrant->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.registrants.index', ['status' => $registrant->status]) }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection