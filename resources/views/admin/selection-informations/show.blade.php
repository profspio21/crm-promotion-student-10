@extends('layouts.admin')
@section('content')
<div class="row container">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Detail Informasi {!! $information->title !!}</h5>
            <p class="card-text"> {!! $information->detail ?? '--- Tunggu tanggal pengumuman ---' !!} </p>
        </div>
        </div>
</div>
<br>
<div class="row" style="justify-content: center">
    <button class="btn btn-success" onclick="history.back();">{{ trans('global.back') }}</button>
</div>
@endsection