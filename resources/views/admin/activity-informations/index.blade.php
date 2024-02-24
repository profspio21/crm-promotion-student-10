@extends('layouts.admin')
@section('content')
<div class="row" style="justify-content: center">
    @foreach ($informations as $information)
    <div class="card text-center col-lg-3 mx-4">
      <img class="card-img-top" src="{{ $information->poster ? $information->poster->getUrl() : asset('img/poster.jpg')}}" alt="Card image cap" style="margin-top: 20px; max-height: 200px; height: 100%; width: auto; object-fit: contain">
      <div class="card-body">
        <h5 class="card-title">{{ $information->title ?? ''}}</h5>
        <br>
        <a href="{{ route('admin.activity-informations.show', ['information' => $information->id]) }}" class="btn btn-primary">Detail</a>
      </div>
  </div>
    @endforeach
</div>
@endsection