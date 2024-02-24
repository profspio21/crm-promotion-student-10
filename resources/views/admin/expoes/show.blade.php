@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header" style="align-items: center; justify-content: space-between">
        {{ trans('global.detail') }} {{ trans('cruds.expo.title') }}
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="tanggal">{{ trans('cruds.expo.fields.tanggal') }}</label>
                        <input class="form-control date {{ $errors->has('tanggal') ? 'is-invalid' : '' }}" type="text" name="tanggal" id="tanggal" value="{{ old('tanggal', $expo->tanggal) }}">
                        @if($errors->has('tanggal'))
                            <span class="text-danger">{{ $errors->first('tanggal') }}</span>
                        @endif
                    <span class="help-block">{{ trans('cruds.expo.fields.tanggal_helper') }}</span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="tempat">{{ trans('cruds.expo.fields.tempat') }}</label>
                    <input class="form-control {{ $errors->has('tempat') ? 'is-invalid' : '' }}" type="text" name="tempat" id="tempat" value="{{ old('tempat', $expo->tempat) }}">
                    @if($errors->has('tempat'))
                        <span class="text-danger">{{ $errors->first('tempat') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.expo.fields.tempat_helper') }}</span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="pic">{{ trans('cruds.expo.fields.pic') }}</label>
                    <input class="form-control {{ $errors->has('pic') ? 'is-invalid' : '' }}" type="text" name="pic" id="pic" value="{{ old('pic', $expo->pic) }}">
                    @if($errors->has('pic'))
                        <span class="text-danger">{{ $errors->first('pic') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.expo.fields.pic_helper') }}</span>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-DetailExpo">
                <thead>
                    <th>{{trans('cruds.detail-expo.fields.name')}}</th>
                    <th>{{trans('cruds.detail-expo.fields.email')}}</th>
                    <th>{{trans('cruds.detail-expo.fields.phone')}}</th>
                    <th>{{trans('cruds.detail-expo.fields.jurusan')}}</th>
                    <th>{{trans('cruds.detail-expo.fields.prodi')}}</th>
                </thead>
                <tbody>
                    @foreach ($expo->detailExpo as $detail)
                    <tr data-entry-id="{{ $expo->id }}">
                        <td>
                            <input disabled class="form-control" type="text" name="detail[name][]" value="{{$detail->name}}">
                        </td>
                        <td>
                            <input disabled class="form-control" type="text" name="detail[email][]" value="{{$detail->email}}">
                        </td>
                        <td>
                            <input disabled class="form-control" type="text" name="detail[phone][]" value="{{$detail->phone}}">
                        </td>
                        <td>
                            <input disabled class="form-control" type="text" name="detail[jurusan][]" value="{{$detail->jurusan}}">
                        </td>
                        <td>
                            <input disabled class="form-control" type="text" name="detail[prodi][]" value="{{$detail->prodi}}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row" style="justify-content: space-between">
            <div class="col-auto" >
                <a href="" class="btn btn-primary">Unduh Laporan</a>
            </div>
            <div class="col-auto">
                <button class="btn btn-info" onclick="history.back();">{{ trans('global.back') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection
