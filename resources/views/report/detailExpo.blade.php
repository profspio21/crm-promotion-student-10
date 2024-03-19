<!DOCTYPE html>
<html>
<head>
	<title>Report Data Expo</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
	<style>
		.expo > thead > tr > th , .expo > tbody > tr > td {
			font-size: 16px;
		}
		.detailExpo > thead > tr > th , .detailExpo > tbody > tr > td {
			font-size: 12px;
		}
	</style>
</head>
<body>

	<div style="text-align: right; padding-bottom:10px">
		{{-- <img src="" width="30%" alt="logo UKDW"> --}}
	</div>


	<center style="padding-bottom: 19px">
		<h4>Data Expo</h4>
		<p style="font-size: 12px">Dokumen ini dibuat pada : {{ $now }}</p>
	</center>

	<div class="table-responsive">
		<table class="table no-border expo">
			<tbody>
				<tr>
					<td>Tanggal : {{ $expo->tanggal_label }}</td> 
					<td>Tempat : {{ $expo->tempat }} </td>
					<td>PIC : {{ $expo->pic }} </td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="table-responsive">
		<table class="table table-bordered detailExpo">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama</th> 
					<th>Email</th>
					<th>Whatsapp</th>
					<th>Jurusan</th>
					<th>Minat Prodi</th>
				</tr>
			</thead>
			<tbody>
				@foreach($expo->detailExpo as $index => $detail)
					<tr>
						<td>{{ $index+1 }}</td>
						<td> {{ $detail->name }} </td>
						<td> {{ $detail->email ?? '-'}} </td>
						<td> {{ $detail->phone ?? '-'}} </td>
						<td> {{ $detail->jurusan ?? '-'}} </td>
						<td> {{ $detail->prodi ?? '-'}} </td>
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