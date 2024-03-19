@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6>Dashboard</h6>
                </div>
                <br>
                <div class="card-header">
                    <h4>Pengumuman Seleksi</h4>
                </div>
                <br>

                @foreach ($selection_informations as $information)
                <div class="card">
                    <div id="card-header-{{ $information->id }}" class="card-header row" style="align-items: center;">
                        <div class="col-lg-9">
                            <h5 class="card-title">{{ $information->title ?? ''}} akan diumumkan melalui {{ App\Models\Information::MEDIA_SELECT[$information->media_informasi] ?? ''}} pada tanggal {{ $information->start_publish_date_label ?? ''}}</h5>
                        </div>
                        <div class="col--lg-2">
                            <button type="button" class="btn btn-primary showMessages">Tanggapi</button>
                        </div>
                        <div class="col-lg-1">
            
                        </div>
                        <div class="col--lg-2">
                            <a class="btn btn-info" href="{{ route('admin.selection-informations.show', $information->id) }}">Detail</a>
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
                                        @elseif ( $comment->user->staff )
                                            <p>{{ $comment->user->staff->name }} : {{ $comment->content }}</p>
                                        @elseif ( $comment->user->registrant )
                                        <p>{{ $comment->user->registrant->name }} : {{ $comment->content }}</p>  
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
            </div>
        </div>
    </div>
    <br>
    <div class="card-header">
        <h4>Pengumuman Kegiatan</h4>
    </div>
    <br>
    <div class="row" style="justify-content: center">
        @foreach ($activity_informations as $information)
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
    <br>

    {{-- Grafik --}}
    <div class="card-header">
        <h4>Grafik</h4>
        <div class="row" style="align-items: center">
            <div class="col-lg-3">
                Pilih Range Tanggal
            </div>
            <div class="col-lg-3">
                Dari : <input type="date" id="startDate" name="startDate" placeholder="Dari">
            </div>
            <div class="col-lg-3">
                Sampai : <input type="date" id="endDate" name="endDate" placeholder="Sampai">
            </div>
            <div class="col-lg-3">
                <button type="button" class="btn btn-info" onclick="graph()">Generate Grafik</button>
            </div>
        </div>
    </div>
    <br>
    <div class="card container">
        <div class="row">
            <div class="col-lg-4">
                Perbandingan Expo Jawa dan Luar Jawa
                <canvas id="expoChart"></canvas>
            </div>
            <div class="col-lg-4">
                Minat Prodi dari Expo
                <canvas id="expoProdiChart"></canvas>
            </div>
            <div class="col-lg-4">
                Perbandingan Status Pendaftar
                <canvas id="registrantsChart"></canvas>
            </div>
        </div>
        <div class="row">
            
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
<script>
    var expoChart = null;
    var expoProdiChart = null;
    var registrantsChart = null;

    function graph() {
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();

        if(startDate == '' || endDate == '') {
            return alert('pilih rentang tanggal')
        }

        const url = "{{ route('admin.dashboard') }}";

        $.ajax({
            method: 'GET',
            url: url,
            data: {
            "startDate" : startDate,
            "endDate" : endDate,
            }
        }).then(function(response) {
            if(response.success) {
                filterdata = response;
                updateChartData();      
            } else {
                alert('Error');
            }
        });

        function updateChartData() {
            // Update pie chart for expo
            var expoLabels = Object.keys(filterdata.expo);
            var expoData = Object.values(filterdata.expo);
            updatePieChart('expoChart', expoLabels, expoData, expoChart);

            // Update pie chart for expo_prodi
            var expoProdiLabels = filterdata.expo_prodi.map(item => item.prodi);
            var expoProdiData = filterdata.expo_prodi.map(item => item.count);
            updatePieChart('expoProdiChart', expoProdiLabels, expoProdiData, expoProdiChart);

            // Update pie chart for registrants
            var registrantsLabels = filterdata.registrants.map(item => item.status_label);
            var registrantsData = filterdata.registrants.map(item => item.count);
            updatePieChart('registrantsChart', registrantsLabels, registrantsData, registrantsChart);
        }

        function updatePieChart(chartId, labels, data, existingChart) {
            if(existingChart) {
                existingChart.data.labels = labels;
                existingChart.data.datasets[0].data = data;
                existingChart.update();
            } else {
                var ctx = document.getElementById(chartId).getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.5)',
                                'rgba(54, 162, 235, 0.5)',
                                'rgba(255, 206, 86, 0.5)',
                                'rgba(75, 192, 192, 0.5)',
                                'rgba(153, 102, 255, 0.5)',
                                'rgba(255, 159, 64, 0.5)'
                            ]
                        }]
                    },
                    options: {
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        var label = context.label || '';
                                        var value = context.formattedValue || '';
                                        var dataset = context.dataset;
                                        var total = dataset.data.reduce(function(previousValue, currentValue) {
                                            return previousValue + currentValue;
                                        });
                                        var currentValue = dataset.data[context.dataIndex];
                                        var percentage = Math.round((currentValue / total) * 100);
                                        return label + ': ' + value + ' (' + percentage + '%)';
                                    }
                                }
                            }
                        }
                    }
                });
                
                switch(chartId) {
                    case 'expoChart':
                        expoChart = chart;
                        break;
                    case 'expoProdiChart':
                        expoProdiChart = chart;
                        break;
                    case 'registrantsChart':
                        registrantsChart = chart;
                        break;
                    default:
                        break;
                }
            }
        }
        
    }
</script>

@endsection