@extends('layouts.admin')
@section('content')
<div class="row container">
    <div class="col-lg-3" style="text-align: right">
        <img class="card-img-top" src="{{ $information->poster ? $information->poster->getUrl() : asset('img/poster.jpg')}}" alt="Card image cap" style="max-width: 100%">
    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Detail Kegiatan</h5>
              <p class="card-text"> {!! $information->detail !!} </p>
            </div>
          </div>
    </div>
</div>
<br>
<div class="row" style="justify-content: center">
    <button class="btn btn-success" onclick="history.back();">{{ trans('global.back') }}</button>
</div>
@endsection