@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.information.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.informations.index', ['type' => $information->type]) }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.information.fields.id') }}
                        </th>
                        <td>
                            {{ $information->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.information.fields.title') }}
                        </th>
                        <td>
                            {{ $information->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.information.fields.target') }}
                        </th>
                        <td>
                            {{ App\Models\Information::TARGET_SELECT[$information->target] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.information.fields.media_informasi') }}
                        </th>
                        <td>
                            {{ App\Models\Information::MEDIA_SELECT[$information->media_informasi] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.information.fields.detail') }}
                        </th>
                        <td>
                            {!! $information->detail ?? '' !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.information.fields.publish_date') }}
                        </th>
                        <td>
                            {{ $information->start_publish_date_label ?? 'Tidak ada tanggal mulai publish' }} --- {{ $information->end_publish_date_label ?? 'Tidak ada tanggal akhir publish'}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.information.fields.poster') }}
                        </th>
                        <td>
                            @if($information->poster)
                                <a href="{{ $information->poster->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $information->poster->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.informations.index', ['type' => $information->type]) }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection