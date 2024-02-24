@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.information.title') }} {{ App\Models\Information::TYPE_SELECT[$type]}} - Hanya bisa diakses staff
    </div>
    <br>
    @can('information_access')
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.informations.create',  ['type' => $type]) }}">
                {{ trans('global.add') }} {{ trans('global.data') }}
            </a>
        </div>
    @endcan

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Information">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.information.fields.title') }}
                        </th>
                        @if ($type == 1)
                            <th>
                                {{ trans('cruds.information.fields.detail') }}
                            </th>
                        @endif
                        <th>
                            {{ trans('cruds.information.fields.target') }}
                        </th>
                        <th>
                            {{ trans('cruds.information.fields.media_informasi') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($informations as $key => $information)
                        <tr data-entry-id="{{ $information->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $information->title ?? '' }}
                            </td>
                            @if ($information->type == 1)
                                <td style="max-width: 300px;">
                                    {!! $information->detail ?? '' !!}
                                </td>
                            @endif
                            <td>
                                {{ App\Models\Information::TARGET_SELECT[$information->target] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Information::MEDIA_SELECT[$information->media_informasi] ?? '' }}
                            </td>
                            <td>
                                @can('information_crud')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.informations.show', ['information' => $information->id ,  'type' => $type ]) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.informations.edit', ['information' => $information->id ,  'type' => $type ]) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                    <form action="{{ route('admin.informations.destroy',['information' => $information->id ,  'type' => $type ]) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('information_crud')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.informations.massDestroy') }}",
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
  let table = $('.datatable-Information:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection