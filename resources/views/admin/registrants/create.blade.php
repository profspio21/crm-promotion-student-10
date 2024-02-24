@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.registrant.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.registrants.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Data Pendaftar</label><br>
                        <span class="help-block">Wajib diisi</span>
                    </div>
                    <hr><hr>
                    <div class="form-group">
                        <label>{{ trans('cruds.registrant.fields.status') }}</label>
                        <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                            <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach(App\Models\Registrant::STATUS_SELECT as $key => $label)
                                <option value="{{ $key }}" {{ old('status', $status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('status'))
                            <span class="text-danger">{{ $errors->first('status') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.registrant.fields.status_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="nomor_daftar">{{ trans('cruds.registrant.fields.nomor_daftar') }}</label>
                        <input class="form-control {{ $errors->has('nomor_daftar') ? 'is-invalid' : '' }}" type="text" name="nomor_daftar" id="nomor_daftar" value="{{ old('nomor_daftar', '') }}">
                        @if($errors->has('nomor_daftar'))
                            <span class="text-danger">{{ $errors->first('nomor_daftar') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.registrant.fields.nomor_daftar_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ trans('cruds.registrant.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                        @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.registrant.fields.name_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="phone">{{ trans('cruds.registrant.fields.phone') }}</label>
                        <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="tel" name="phone" id="phone" value="{{ old('phone', '') }}">
                        @if($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.registrant.fields.phone_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir">{{ trans('cruds.registrant.fields.tgl_lahir') }}</label>
                        <input class="form-control date {{ $errors->has('tgl_lahir') ? 'is-invalid' : '' }}" type="text" name="tgl_lahir" id="tgl_lahir" value="{{ old('tgl_lahir', '') }}">
                        @if($errors->has('tgl_lahir'))
                            <span class="text-danger">{{ $errors->first('tgl_lahir') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.registrant.fields.tgl_lahir_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="prodi">{{ trans('cruds.registrant.fields.prodi') }}</label>
                        <input class="form-control {{ $errors->has('prodi') ? 'is-invalid' : '' }}" type="text" name="prodi" id="prodi" value="{{ old('prodi', '') }}">
                        @if($errors->has('prodi'))
                            <span class="text-danger">{{ $errors->first('prodi') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.registrant.fields.prodi_helper') }}</span>
                    </div>
                    
                    <div class="form-group">
                        <label for="photo">{{ trans('cruds.registrant.fields.photo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                        </div>
                        @if($errors->has('photo'))
                            <span class="text-danger">{{ $errors->first('photo') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.registrant.fields.photo_helper') }}</span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Data Pendaftar</label><br>
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
            <br>
            <div class="row" style="justify-content: center">
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

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.registrants.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($registrant) && $registrant->photo)
      var file = {!! json_encode($registrant->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection