<!DOCTYPE html>
<html>
<head>
	<title>Receipt</title>
</head>
<body onload="window.print()">
		<img src="{{ asset('img/logo.jpg') }}" width="70px" align="left">
		<img src="{{ asset('img/logo.jpg') }}" width="70px" align="right">
		
		<center>
		<strong>{{ config('app.name')}}</strong> <br>
		Jl. Sadang Luhur, Sekeloa, Coblong <br>
		Kota Bandung, Jawa Barat, 40134<br>
		<strong>Receipt</strong>
		</center>
		<hr>

		<tr>
			<td width="10%"><strong>Name</strong></td>
			<td width="1%">:</td>
			<td>{!! $transaction->user->name !!}</td>
		</tr>
		<tr>
			<td><strong>Class</strong></td>
			<td>:</td>
			<td>{!! $transaction->user->kelas !!}</td>
		</tr>
		<tr>
			<td><strong>Charges</strong></td>
			<td>:</td>
			<td>Rp. {!! number_format($transaction->transactionDetail()->sum('denda')) !!}</td>
		</tr>
		<br>
		<br>
			
		<table border="1" width="100%">
			<tr>
				<th>No</th>
				<th>Title</th>
				<th>Date of Borrowing</th>
				<th>Return Date</th>
				<th>Charges</th>
			</tr>
			@foreach ($transaction->transactionDetail as $row)
				<tr align="center">
					<td>{!! $loop->iteration !!}</td>
					<td>{!! $row->book->title !!} <small>{!! $row->status != 'returned' ?  '<font color="red">' . $row->status . ' </font>' : '' !!}</td>
					<td>{!! $row->tgl_pinjam !!}</td>
					<td>{!! $row->tgl_kembali !!}</td>
					<td>Rp. {!! number_format($row->denda) !!} </small></td>
				</tr>
			@endforeach
		</table>
</body>
</html>  