{!! Form::open(['route'=>['transactionDetail.update', $id], 'method'=>'patch', 'class'=>'form']) !!}
	<div class="form-group">
		{!! Form::select('status', ['loan'=>'loan', 'returned'=>'returned', 'late'=>'late', 'lost'=>'lost', 'broken'=>'broken'], $status, ['class'=>'form-control form-control-sm']) !!} 
	</div>
	<div class="form-group">
		{!! Form::date('tgl_kembali', $tgl_kembali, ['class'=>'form-control form-control-sm']) !!} 
	</div>
	<button type="submit" class="btn btn-primary btn-block btn-sm"><span class="fa fa-check"></span></button>
{!! Form::close() !!}