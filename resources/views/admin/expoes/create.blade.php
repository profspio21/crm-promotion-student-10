@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.expo.title_singular') }} {{ App\Models\Expo::TYPE_SELECT[$type]}}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.expoes.store",  ['type' => $type] ) }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="tanggal">{{ trans('cruds.expo.fields.tanggal') }}</label>
                            <input class="form-control date {{ $errors->has('tanggal') ? 'is-invalid' : '' }}" type="text" name="tanggal" id="tanggal" value="{{ old('tanggal', '') }}">
                            @if($errors->has('tanggal'))
                                <span class="text-danger">{{ $errors->first('tanggal') }}</span>
                            @endif
                        <span class="help-block">{{ trans('cruds.expo.fields.tanggal_helper') }}</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="tempat">{{ trans('cruds.expo.fields.tempat') }}</label>
                        <input class="form-control {{ $errors->has('tempat') ? 'is-invalid' : '' }}" type="text" name="tempat" id="tempat" value="{{ old('tempat', '') }}">
                        @if($errors->has('tempat'))
                            <span class="text-danger">{{ $errors->first('tempat') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.expo.fields.tempat_helper') }}</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="pic">{{ trans('cruds.expo.fields.pic') }}</label>
                        <input class="form-control {{ $errors->has('pic') ? 'is-invalid' : '' }}" type="text" name="pic" id="pic" value="{{ old('pic', '') }}">
                        @if($errors->has('pic'))
                            <span class="text-danger">{{ $errors->first('pic') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.expo.fields.pic_helper') }}</span>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Expo">
                    <thead>
                        <th>{{trans('cruds.detail-expo.fields.name')}}</th>
                        <th>{{trans('cruds.detail-expo.fields.email')}}</th>
                        <th>{{trans('cruds.detail-expo.fields.phone')}}</th>
                        <th>{{trans('cruds.detail-expo.fields.jurusan')}}</th>
                        <th>{{trans('cruds.detail-expo.fields.prodi')}}</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input class="form-control" type="text" name="detail[name][]" value="">
                            </td>
                            <td>
                                <input class="form-control" type="text" name="detail[email][]" value="">
                            </td>
                            <td>
                                <input class="form-control" type="text" name="detail[phone][]" value="">
                            </td>
                            <td>
                                <input class="form-control" type="text" name="detail[jurusan][]" value="">
                            </td>
                            <td>
                                <input class="form-control" type="text" name="detail[prodi][]" value="">
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="deleteRow(this)">{{trans('global.delete')}}</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row" style="justify-content: center">
                <div class="form-group">
                    <button type="button" class="btn btn-success" onclick="addRow()">
                        {{trans('global.addRow') }}
                    </button>
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

@section('scripts')
<script>
function addRow() {
    var table = document.querySelector(".datatable-Expo tbody");
    var newRow = table.insertRow(table.rows.length);
    var cells = ["detail[name][]", "detail[email][]", "detail[phone][]", "detail[jurusan][]", "detail[prodi][]", "delete[]"];

    cells.forEach(function(cell, index) {
        var newCell = newRow.insertCell(index);
        if (index < 5) { // For input fields
            var input = document.createElement("input");
            input.type = "text";
            input.className = "form-control";
            input.name = cell;
            newCell.appendChild(input);
        } else { // For the 'Delete' button
            var button = document.createElement("button");
            button.type = "button"
            button.className = "btn btn-danger";
            button.onclick = function() { deleteRow(this); };
            button.textContent = "{{trans('global.delete')}}";
            newCell.appendChild(button);
        }
    });
}
function deleteRow(button) {
    button.closest('tr').remove();
}
</script>
@endsection