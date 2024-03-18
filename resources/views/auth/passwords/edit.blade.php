@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="card col-lg-9 mx-4">
        <div class="card-header">
            Update Profil
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("profile.password.updateProfile") }}">
                @csrf
                <div class="form-group row">
                    <label class="required col-lg-4" for="username">{{ trans('cruds.user.fields.username') }}</label>
                    <input class="col {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" id="username" value="{{ old('username', auth()->user()->username) }}" required>
                    @if($errors->has('username'))
                        <div class="invalid-feedback">
                            {{ $errors->first('username') }}
                        </div>
                    @endif
                </div>
                <div class="form-group row">
                    <label class="required col-lg-4" for="title">{{ trans('cruds.user.fields.email') }}</label>
                    <input class="col {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                @if (auth()->user()->registrant)
                <div class="form-group row">
                    <label class="required col-lg-4" for="nomor_daftar">{{ trans('cruds.registrant.fields.nomor_daftar') }}</label>
                    <input disabled class="col {{ $errors->has('nomor_daftar') ? 'is-invalid' : '' }}" type="text" name="registrant[nomor_daftar]" id="nomor_daftar" value="{{ old('nomor_daftar', auth()->user()->registrant->nomor_daftar) }}" required>
                    @if($errors->has('nomor_daftar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nomor_daftar') }}
                        </div>
                    @endif
                </div>
                    @if (auth()->user()->registrant->status == 2)
                    <div class="form-group row">
                        <label class="required col-lg-4" for="nim">{{ trans('cruds.registrant.fields.nim') }}</label>
                        <input disabled class="col {{ $errors->has('nim') ? 'is-invalid' : '' }}" type="text" name="registrant[nim]" id="nim" value="{{ old('nim', auth()->user()->registrant->nim) ?? '-' }}" required>
                        @if($errors->has('nim'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nim') }}
                            </div>
                        @endif
                    </div>
                    @endif
                <div class="form-group row">
                    <label class="required col-lg-4" for="prodi">{{ trans('cruds.registrant.fields.prodi') }}</label>
                    <input class="col {{ $errors->has('prodi') ? 'is-invalid' : '' }}" type="text" name="registrant[prodi]" id="prodi" value="{{ old('prodi', auth()->user()->registrant->prodi) }}" required>
                    @if($errors->has('prodi'))
                        <div class="invalid-feedback">
                            {{ $errors->first('prodi') }}
                        </div>
                    @endif
                </div>
                <div class="form-group row">
                    <label class="required col-lg-4" for="name">{{ trans('cruds.registrant.fields.name') }}</label>
                    <input class="col {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="registrant[name]" id="name" value="{{ old('name', auth()->user()->registrant->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group row">
                    <label class="required col-lg-4" for="tgl_lahir">{{ trans('cruds.registrant.fields.tgl_lahir') }}</label>
                    <input class="col date {{ $errors->has('tgl_lahir') ? 'is-invalid' : '' }}" type="text" name="registrant[tgl_lahir]" id="tgl_lahir" value="{{ old('tgl_lahir', auth()->user()->registrant->tgl_lahir) }}" required>
                    @if($errors->has('tgl_lahir'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tgl_lahir') }}
                        </div>
                    @endif
                </div>
                
                @endif
                @if (auth()->user()->staff)
                <div class="form-group row">
                    <label class="required col-lg-4" for="name">{{ trans('cruds.staff.fields.name') }}</label>
                    <input class="col {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="staff[name]" id="name" value="{{ old('name', auth()->user()->staff->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group row">
                    <label class="required col-lg-4" for="nip">{{ trans('cruds.staff.fields.nip') }}</label>
                    <input class="col date {{ $errors->has('nip') ? 'is-invalid' : '' }}" type="text" name="staff[nip]" id="nip" value="{{ old('nip', auth()->user()->staff->nip) }}" required>
                    @if($errors->has('nip'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nip') }}
                        </div>
                    @endif
                </div>
                @endif
                
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="card col-lg-9 mx-4">
        <div class="card-header">
            {{ trans('global.change_password') }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route("profile.password.update") }}">
                @csrf
                <div class="form-group">
                    <label class="required" for="password">New {{ trans('cruds.user.fields.password') }}</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                    @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="password_confirmation">Repeat New {{ trans('cruds.user.fields.password') }}</label>
                    <input class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" type="password" name="password_confirmation" id="password_confirmation" required>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection