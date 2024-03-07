@extends('layouts.admin')

@section('content')
@foreach ($informations as $information)
    <div class="card">
        <div id="card-header-{{ $information->id }}" class="card-header row" style="align-items: center;">
            <div class="col-lg-9">
                <h5 class="card-title">{{ $information->title ?? ''}} akan diumumkan melalui {{ App\Models\Information::MEDIA_SELECT[$information->media_informasi] ?? ''}} pada tanggal {{ $information->start_publish_date_label ?? ''}}</h5>
            </div>
            <div class="col--lg-2">
                <button type="button" class="btn btn-primary showMessages">Tanggapi</button>
            </div>
        </div>

        <div id="card-body-{{ $information->id }}" class="card-body" style="display: none;">
            <form action="{{route('admin.comments.store', ['information_id' => $information->id])}}" method="post" style="align-items: center;">
                @csrf
                <div class="row">
                    <div class="col-lg-9">
                        @foreach ($information->comments as $comment)
                            @if ($comment->sender_id === auth()->user()->id)
                                <p style="text-align: right">{{ $comment->content }}</p>  
                            @else
                                <p>{{ $comment->sender }} : {{ $comment->content }}</p>  
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="content">
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-success">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endforeach
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // jQuery function to handle button click
        $('.showMessages').click(function() {
            // Find the closest card body element
            var cardBody = $(this).closest('.card').find('.card-body');
            
            // Toggle the visibility of the card body
            cardBody.toggle();

            // Toggle the button text between "Messages" and "Cancel"
            if (cardBody.is(':visible')) {
                $(this).text("Batal");
                $(this).removeClass("btn-primary");
                $(this).addClass("btn-danger");
            } else {
                $(this).text("Tanggapi");
                $(this).removeClass("btn-danger");
                $(this).addClass("btn-primary");
            }
        });

        // Parameter information_id, jika sesuai maka akan dibuka
        var url = window.location.href;
        var queryString = url.split('?')[1];
        var queryParams = queryString.split('&');
        var params = {};
        queryParams.forEach(function(param) {
            var keyValue = param.split('=');
            var key = decodeURIComponent(keyValue[0]);
            var value = decodeURIComponent(keyValue[1]);
            params[key] = value;
        });
        var informationId = params['information_id'];
        
        if (informationId) {
            var elementId = '#card-header-' + informationId;
            var messagesOpen = $(elementId);
            console.log(messagesOpen.find('button'))
            messagesOpen.find('button').click()
        }
    });
</script>


@endsection