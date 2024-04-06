@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.information.title_singular') }} {{ App\Models\Information::TYPE_SELECT[$type]}}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("admin.informations.update",  ['information' => $information, 'type' => $type] ) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
                <div class="form-group">
                    <label for="title">{{ trans('cruds.information.fields.title') }}</label>
                        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $information->title) }}">
                        @if($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                    <span class="help-block">{{ trans('cruds.information.fields.title_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="target">{{ trans('cruds.information.fields.target') }}</label>
                    <select class="form-control {{ $errors->has('target') ? 'is-invalid' : '' }}" name="target" id="target">
                        <option value disabled {{ old('target', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Information::TARGET_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('target', $information->target) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('target'))
                        <span class="text-danger">{{ $errors->first('target') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.information.fields.target_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="media_informasi">{{ trans('cruds.information.fields.media_informasi') }}</label>
                    <select class="form-control {{ $errors->has('media_informasi') ? 'is-invalid' : '' }}" name="media_informasi" id="media_informasi">
                        <option value disabled {{ old('media_informasi', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Information::MEDIA_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('media_informasi', $information->media_informasi) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('media_informasi'))
                        <span class="text-danger">{{ $errors->first('media_informasi') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.information.fields.media_informasi_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="detail">{{ trans('cruds.information.fields.detail') }}</label>
                        <textarea id="detail" name="detail" class="form-control ">{{ old('detail', $information->detail ?? '') }}</textarea>
                        @if($errors->has('detail'))
                            <span class="text-danger">{{ $errors->first('detail') }}</span>
                        @endif
                    <span class="help-block">{{ trans('cruds.information.fields.detail_helper') }}</span>
                </div>
                @if ($type == 1)
                    <div class="form-group">
                        <label for="poster">{{ trans('cruds.information.fields.poster') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('poster') ? 'is-invalid' : '' }}" id="poster-dropzone">
                        </div>
                        @if($errors->has('poster'))
                            <span class="text-danger">{{ $errors->first('poster') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.information.fields.poster_helper') }}</span>
                    </div>
                @endif
                <br>
                <div class="row">
                    <div class="col-auto">
                        <div class="form-group">
                            <label for="publish_date">{{ trans('cruds.information.fields.publish_date') }}</label>
                        </div>
                    </div>
                </div>
                <div class="row" style="align-items: center">
                    <div class="col-auto">
                        <div class="form-group">
                            <input class="form-control date {{ $errors->has('start_publish_date') ? 'is-invalid' : '' }}" type="text" name="start_publish_date" id="start_publish_date" value="{{ $information->start_publish_date_dmy }}">
                            </select>
                            @if($errors->has('start_publish_date'))
                                <span class="text-danger">{{ $errors->first('start_publish_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.information.fields.start_publish_date_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="form-group">
                            sampai
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="form-group">
                            <input class="form-control date {{ $errors->has('end_publish_date') ? 'is-invalid' : '' }}" type="text" name="end_publish_date" id="end_publish_date" value="{{ $information->end_publish_date_dmy }}">
                            </select>
                            @if($errors->has('end_publish_date'))
                                <span class="text-danger">{{ $errors->first('end_publish_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.information.fields.end_publish_date_helper') }}</span>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col">
                        <button class="btn btn-success" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                    <div class="col" style="text-align: right">
                        <a class="btn btn-default" href="{{ route('admin.informations.index', ['type' => $information->type]) }}">
                            {{ trans('global.back') }}
                        </a>
                    </div>
                </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    Dropzone.options.posterDropzone = {
    url: '{{ route('admin.informations.storeMedia') }}',
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
      $('form').find('input[name="poster"]').remove()
      $('form').append('<input type="hidden" name="poster" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="poster"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($information) && $information->poster)
      var file = {!! json_encode($information->poster) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="poster" value="' + file.file_name + '">')
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
<script>
    $(document).ready(function() {
        CKEDITOR.replace('detail' );
    });
    
</script>
@endsection