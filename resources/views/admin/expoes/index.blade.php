@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.expo.title_singular') }} {{ App\Models\Expo::TYPE_SELECT[$type]}} - Hanya bisa diakses staff
    </div>
    <br>
    @can('expo_access')
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.expoes.create',  ['type' => $type]) }}">
                {{ trans('global.add') }} {{ trans('global.data') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.importData') }}
            </button>
            @include('csvImport.modal', ['model' => 'DetailExpo', 'route' => 'admin.expos.parseCsvImport', 'type' => $type])
        </div>
    @endcan

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Expo">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.expo.fields.tanggal') }}
                        </th>
                        <th>
                            {{ trans('cruds.expo.fields.tempat') }}
                        </th>
                        <th>
                            {{ trans('cruds.expo.fields.count') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expoes as $key => $expo)
                        <tr data-entry-id="{{ $expo->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $expo->tanggal ?? '' }}
                            </td>
                            <td>
                                {{ $expo->tempat ?? '' }}
                            </td>
                            <td>
                                {{ $expo->detailExpo->count() }}
                            </td>
                            <td>
                                @can('expo_access')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.expoes.show', ['expo' => $expo->id ,  'type' => $type ]) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('expo_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.expoes.edit', ['expo' => $expo->id ,  'type' => $type ]) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('expo_delete')
                                    <form action="{{ route('admin.expoes.destroy',['expo' => $expo->id ,  'type' => $type ]) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('expo_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.expoes.massDestroy') }}",
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
  let table = $('.datatable-Expo:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection