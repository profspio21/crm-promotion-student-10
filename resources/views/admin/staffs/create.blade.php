@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.staff.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.staffs.store") }}" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Data Staff</label><br>
                        <span class="help-block">Wajib diisi</span>
                    </div>
                    <hr><hr>
                    <div class="form-group">
                        <label for="nip">{{ trans('cruds.staff.fields.nip') }}</label>
                        <input class="form-control {{ $errors->has('nip') ? 'is-invalid' : '' }}" type="text" name="nip" id="nip" value="{{ old('nip', '') }}">
                        @if($errors->has('nip'))
                            <span class="text-danger">{{ $errors->first('nip') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.staff.fields.nip_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="name">{{ trans('cruds.staff.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                        @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.staff.fields.name_helper') }}</span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Data Staff</label><br>
                        <span class="help-block">isikan jika ingin membuat username baru untuk login aplikasi</span>
                    </div>
                    <hr><hr>
                    <div class="form-group">
                        <label for="username">{{ trans('cruds.user.fields.username') }}</label>
                        <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" id="username" value="{{ old('username', '') }}">
                        @if($errors->has('username'))
                            <span class="text-danger">{{ $errors->first('username') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.username_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="email">{{ trans('cruds.user.fields.email') }}</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', '') }}">
                        @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="password">{{ trans('cruds.user.fields.password') }}</label>
                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" value="{{ old('password', '') }}">
                        @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



@endsection