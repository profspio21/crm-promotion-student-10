<!DOCTYPE html>
<html>
<head>
	<title>Report Pendaftar</title>
	<link rel="stylesheet" href="css/bootstrap-4.3.1.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<style type="text/css">
	table tr td,
	table tr th{
		font-size: 9pt;
		text-align: left;
	}
	.less-space > th,
	.less-space > td {
		margin: 0px;
		padding: 5px 10px 0px 0px;
	}
	.table1 tr th {
		width: 50%;
	}
	.table2 thead tr th {
		margin: 0px;
		padding: 0px;
		font-size: 11pt;
		font-weight: normal;
		line-height: 12pt;
	}
	.table2 thead tr th,
	.table2 tbody tr td,
	.table2 tr th, .table2 tr td {
		border-bottom: none;
		border-top: none;
	},

.border-outside {
	border: none;
}

img {
	max-height: 100px;
	max-width: 100%;
}
</style>

<div style="text-align: right; padding-bottom:10px">
	<img src="img/logo_dante2.png" width="30%" alt="logo Darmawan Teknik">
</div>


<div style="padding-bottom: 19px">
	<h4>Data Pendaftar status</h4>
    <p>Tanggal Daftar : {{ $startDate }} - {{ $endDate }}</p>
    <p>Dibuat pada : {{ $now }}</p>
</div>


<table class='table table-bordered'>
	<thead>
		<tr>
			<th>No.</th>
			<th>Nomor Daftar</th>
            @if ($status == 2)
                <th>NIM</th>
            @endif
			<th>Nama</th>
			<th>Tanggal Lahir</th>
			<th>Prodi</th>
		</tr>
	</thead>
	<tbody>
		@foreach($registrants as $index => $registrant)
            <tr>
                <td>{{ $index+1 }}</td>
                <td> {{ $registrant->nomor_daftar ?? '-'}} </td>
                @if ($status == 2)
                    <td> {{ $registrant->nim ?? '-'}} </td>
                @endif
                <td> {{ $registrant->nama ?? '-'}} </td>
                <td> {{ $registrant->tgl_lahir ?? '-'}} </td>
                <td> {{ $registrant->prodi ?? '-'}} </td>
            </tr>
		@endforeach
		<tr>
			<td></td>
		</tr>
	</tbody>
</table>

<br>
{{-- Some text --}}
<b></b> 
<p style="font-size: 10pt"></p>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>