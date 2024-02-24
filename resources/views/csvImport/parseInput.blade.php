@extends('layouts.admin')

@section('content')

<div class='row'>
    <div class='col-md-12'>
        <div class="card panel-default">
            <div class="card-header">
                @lang('global.app_csvImport')
            </div>

            <div class="card-body table-responsive">
                <form class="form-horizontal" method="POST" action="{{ route($routeName, ['type' => $type ?? '', 'status' => $status ?? '']) }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="tanggal">{{ trans('cruds.expo.fields.tanggal') }}</label>
                                    <input class="form-control date {{ $errors->has('tanggal') ? 'is-invalid' : '' }}" type="text" name="tanggal" id="tanggal" value="{{ old('tanggal', '') }}">
                                    @if($errors->has('tanggal'))
                                        <span class="text-danger">{{ $errors->first('tanggal') }}</span>
                                    @endif
                                <span class="help-block">{{ trans('cruds.expo.fields.tanggal_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="tempat">{{ trans('cruds.expo.fields.tempat') }}</label>
                                <input class="form-control {{ $errors->has('tempat') ? 'is-invalid' : '' }}" type="text" name="tempat" id="tempat" value="{{ old('tempat', '') }}">
                                @if($errors->has('tempat'))
                                    <span class="text-danger">{{ $errors->first('tempat') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.expo.fields.tempat_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="pic">{{ trans('cruds.expo.fields.pic') }}</label>
                                <input class="form-control {{ $errors->has('pic') ? 'is-invalid' : '' }}" type="text" name="pic" id="pic" value="{{ old('pic', '') }}">
                                @if($errors->has('pic'))
                                    <span class="text-danger">{{ $errors->first('pic') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.expo.fields.pic_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="type">{{ trans('cruds.expo.fields.type') }}</label>
                                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                    @foreach(App\Models\Expo::TYPE_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('type', $type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>                                @if($errors->has('type'))
                                    <span class="text-danger">{{ $errors->first('type') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.expo.fields.type_helper') }}</span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="filename" value="{{ $filename }}" />
                    <input type="hidden" name="hasHeader" value="{{ $hasHeader }}" />
                    <input type="hidden" name="modelName" value="{{ $modelName }}" />
                    <input type="hidden" name="redirect" value="{{ $redirect }}" />

                    <table class="table">
                        @if(isset($headers))
                            <tr>
                                @foreach($headers as $field)
                                    <th>{{ $field }}</th>
                                @endforeach
                            </tr>
                        @endif
                        @if($lines)
                            @foreach($lines as $line)
                                <tr>
                                    @foreach($line as $field)
                                        <td>{{ $field }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endif
                        <tr>
                            @foreach($headers as $key => $header)
                                <td>
                                    <select name="fields[{{ $key }}]">
                                        <option value=''>Please select</option>
                                        @foreach($fillables as $k => $fillable)
                                            <option value="{{ $fillable }}" {{ strtolower($header) === strtolower($fillable) ? 'selected' : '' }}>{{ $fillable }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            @endforeach
                        </tr>
                    </table>

                    <button type="submit" class="btn btn-primary">
                        @lang('global.app_import_data')
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection