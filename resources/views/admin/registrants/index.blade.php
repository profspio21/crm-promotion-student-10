@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.registrant.title_singular') }} {{ App\Models\Registrant::STATUS_SELECT[$status]}}  - Hanya bisa diakses staff
    </div>
    <br>
    @can('registrant_create')
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.registrants.create', ['status' => $status]) }}">
                {{ trans('global.add') }} {{ trans('cruds.registrant.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.importData') }}
            </button>
            @include('csvImport.modal', ['model' => 'Registrant', 'route' => 'admin.registrants.parseCsvImport', 'status' => $status])
        </div>
    @endcan

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Registrant">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.registrant.fields.created_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.registrant.fields.nomor_daftar') }}
                        </th>
                        @if ($status == 2)
                        <th>
                            {{ trans('cruds.registrant.fields.nim') }}
                        </th>
                        @endif
                        <th>
                            {{ trans('cruds.registrant.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.registrant.fields.tgl_lahir') }}
                        </th>
                        <th>
                            {{ trans('cruds.registrant.fields.prodi') }}
                        </th>
                        {{-- <th>
                            {{ trans('cruds.registrant.fields.status') }}
                        </th> --}}
                        <th>
                            {{ trans('cruds.user.fields.username') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registrants as $key => $registrant)
                        <tr data-entry-id="{{ $registrant->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $registrant->created_at_label ?? '' }}
                            </td>
                            <td>
                                {{ $registrant->nomor_daftar ?? '' }}
                            </td>
                            @if ( $status == 2 )
                                <td>
                                    {{ $registrant->nim ?? '-'}}
                                </td>
                            @endif
                            <td>
                                {{ $registrant->name ?? '' }}
                            </td>
                            <td>
                                {{ $registrant->tgl_lahir ?? '' }}
                            </td>
                            <td>
                                {{ $registrant->prodi ?? '' }}
                            </td>
                            {{-- <td>
                                {{ App\Models\Registrant::STATUS_SELECT[$registrant->status] ?? '' }}
                            </td> --}}
                            <td>
                                {{ $registrant->user->username ?? 'Tidak ada' }}
                            </td>
                            <td>
                                @can('registrant_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.registrants.show', ['registrant' => $registrant->id, 'status' => $status]) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('registrant_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.registrants.edit', ['registrant' => $registrant->id, 'status' => $status]) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('registrant_delete')
                                    <form action="{{ route('admin.registrants.destroy', ['registrant' => $registrant->id, 'status' => $status]) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

    @include('admin.registrants.modal-pdf')
</div>

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  // mass delete
@can('registrant_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.registrants.massDestroy') }}",
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

// pdf
    let pdfCustomButton = {
    text: 'PDF',
    className: 'btn-primary',
    action: function (e, dt, node, config) {
                    $('#pdfModal').modal('show');
                }
    // on click show modal that have input start Date , end Date, and status

    // modal have download or OK button to download PDF
    }

    dtButtons.push(pdfCustomButton)

    $.extend(true, $.fn.dataTable.defaults, {
        orderCellsTop: true,
        order: [[ 1, 'desc' ]],
        pageLength: 100,
    });
    let table = $('.datatable-Registrant:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
  
})

</script>
@endsection