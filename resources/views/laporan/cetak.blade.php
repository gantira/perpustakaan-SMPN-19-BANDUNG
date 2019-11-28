<!DOCTYPE html>
<html>
<head>
	<title>Report</title>
</head>
<body onload="window.print()">
		<img src="{{ asset('img/logo.jpg') }}" width="70px" align="left">
		<img src="{{ asset('img/logo.jpg') }}" width="70px" align="right">
		
		<center>
		<strong>{{ config('app.name')}}</strong> <br>
		Jl. Sadang Luhur, Sekeloa, Coblong <br>
		Kota Bandung, Jawa Barat, 40134<br>
		<strong>Report</strong>
		</center>
		<hr>

		<table border="1" width="100%">
			<tr>
				<td>USER</td>
				<td>BOOK(S)</td>
				<td>DATE</td>
				<td>STATUS</td>
				<td>CHARGES</td>
			</tr>
			@foreach ($laporan as $row)
			<tr>
				<td align="center">{!! $row->user->name !!}</td>
				<td>
                    <ol>
					@foreach ($row->transactionDetail as $val)
                    	<li>{!! $val->book->title !!}</li>
                    @endforeach
                    </ol> 
                </td>
                <td>
                	@foreach ($row->transactionDetail as $val)
                    	{!! \Carbon\Carbon::parse($val->tgl_pinjam)->format('d, M y') . ' - ' . \Carbon\Carbon::parse($val->tgl_kembali)->format('d, M y') !!} <br>
                    @endforeach
                </td>
                <td>
                	@foreach ($row->transactionDetail as $val)
                        {!! $val->status !!} <br>
                    @endforeach	
                </td>
				<td>
					@foreach ($row->transactionDetail as $val)
	                    Rp. {!! number_format($val->denda) !!} <br>
	                @endforeach
				</td>
			</tr>
			@endforeach
		
		</table>
</body>
</html>