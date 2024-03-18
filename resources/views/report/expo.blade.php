<!DOCTYPE html>
<html>
<head>
	<title>Report Pendaftar</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
	<style>
		.table > thead > tr > th , .table > tbody > tr > td {
			font-size: 12px;
		}
	</style>
</head>
<body>

	<div style="text-align: right; padding-bottom:10px">
		{{-- <img src="" width="30%" alt="logo UKDW"> --}}
	</div>


	<center style="padding-bottom: 19px">
		<h4>Data {{$type}}</h4>
		<p style="font-size: 12px">Dokumen ini dibuat pada : {{ $now }}</p>
		<p style="font-size: 14px">Tanggal Expo : {{ $startDate }} - {{ $endDate }}</p>
	</center>


<div class="table-responsive">
	<table class="table table-bordered datatable">
		<thead>
			<tr>
				<th>No.</th>
				<th>Tanggal</th> 
				<th>Tempat</th>
				<th>PIC</th>
			</tr>
		</thead>
		<tbody>
			@foreach($expos as $index => $expo)
				<tr>
					<td>{{ $index+1 }}</td>
					<td> {{ $expo->tanggal_label }} </td>
					<td> {{ $expo->tempat ?? '-'}} </td>
					<td> {{ $expo->pic ?? '-'}} </td>
				</tr>
			@endforeach
			<tr>
				<td></td>
			</tr>
		</tbody>
	</table>
</div>

	<br>
	{{-- Some text --}}
	<b></b> 
	<p style="font-size: 10pt"></p>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>