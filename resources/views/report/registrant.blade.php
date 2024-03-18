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
		<h4>Data {{$status}}</h4>
		<p style="font-size: 12px">Dokumen ini dibuat pada : {{ $now }}</p>
		<p style="font-size: 14px">Tanggal Daftar : {{ $startDate }} - {{ $endDate }}</p>
	</center>


<div class="table-responsive">
	<table class="table table-bordered datatable">
		<thead>
			<tr>
				<th>No.</th>
				<th>Nomor Daftar</th>
				<th>Tanggal Daftar</th>
				@if ($status == 2)
					<th>NIM</th>
				@endif
				<th>Nama</th>
				<th>Prodi</th>
				<th>Tanggal Lahir</th>
			</tr>
		</thead>
		<tbody>
			@foreach($registrants as $index => $registrant)
				<tr>
					<td>{{ $index+1 }}</td>
					<td> {{ $registrant->nomor_daftar ?? '-'}} </td>
					<td> {{ date_format($registrant->created_at, 'd F Y')}} </td>
					@if ($status == 2)
						<td> {{ $registrant->nim ?? '-'}} </td>
					@endif
					<td> {{ $registrant->name ?? '-'}} </td>
					<td> {{ $registrant->prodi ?? '-'}} </td>
					<td> {{ $registrant->tgl_lahir ?? '-'}} </td>
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