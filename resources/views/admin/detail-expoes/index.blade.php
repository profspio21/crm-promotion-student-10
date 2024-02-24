@extends('layouts.admin')
@section('content')
@can('expo_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.detail-expoes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.detail-expo.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'DetailExpo', 'route' => 'admin.detail-expoes.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.detail-expo.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-DetailExpo">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.detail-expo.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.detail-expo.fields.nomor_daftar') }}
                        </th>
                        <th>
                            {{ trans('cruds.detail-expo.fields.nim') }}
                        </th>
                        <th>
                            {{ trans('cruds.detail-expo.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.detail-expo.fields.tgl_lahir') }}
                        </th>
                        <th>
                            {{ trans('cruds.detail-expo.fields.prodi') }}
                        </th>
                        <th>
                            {{ trans('cruds.detail-expo.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.detail-expo.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.detail-expo.fields.photo') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detail-expoes as $key => $detail-expo)
                        <tr data-entry-id="{{ $detail-expo->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $detail-expo->id ?? '' }}
                            </td>
                            <td>
                                {{ $detail-expo->nomor_daftar ?? '' }}
                            </td>
                            <td>
                                {{ $detail-expo->nim ?? '' }}
                            </td>
                            <td>
                                {{ $detail-expo->name ?? '' }}
                            </td>
                            <td>
                                {{ $detail-expo->tgl_lahir ?? '' }}
                            </td>
                            <td>
                                {{ $detail-expo->prodi ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\DetailExpo::STATUS_SELECT[$detail-expo->status] ?? '' }}
                            </td>
                            <td>
                                {{ $detail-expo->user->name ?? '' }}
                            </td>
                            <td>
                                @if($detail-expo->photo)
                                    <a href="{{ $detail-expo->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $detail-expo->photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('student_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.detail-expoes.show', $detail-expo->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('student_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.detail-expoes.edit', $detail-expo->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('student_delete')
                                    <form action="{{ route('admin.detail-expoes.destroy', $detail-expo->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('student_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.detail-expoes.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-DetailExpo:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection