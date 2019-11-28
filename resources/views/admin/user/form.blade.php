
<div class="form-group row">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 col-form-label text-md-right']) !!}

    <div class="col-md-4">
        {!! Form::text('name', null, ['class' => $errors->has('name') ? 'form-control is-invalid' : $errors->has('name') ? 'form-control is-invalid' : 'form-control']) !!}
        @if ($errors->has('name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    {!! Form::label('nik', 'NIS / NIP', ['class' => 'col-md-4 col-form-label text-md-right']) !!}

    <div class="col-md-4">
        {!! Form::text('nik', null, ['class' => $errors->has('nik') ? 'form-control is-invalid' : $errors->has('nik') ? 'form-control is-invalid' : 'form-control']) !!}
        @if ($errors->has('nik'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('nik') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
	{!! Form::label('email', 'Email', ['class' => 'col-md-4 col-form-label text-md-right']) !!}

	<div class="col-md-4">
    	{!! Form::email('email', null, ['class' => $errors->has('email') ? 'form-control is-invalid' : $errors->has('email') ? 'form-control is-invalid' : 'form-control']) !!}
        @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
	{!! Form::label('image', 'Image', ['class' => 'col-md-4 col-form-label text-md-right']) !!}

	<div class="col-md-4">
    	{!! Form::file('image', ['class' => $errors->has('image') ? 'form-control is-invalid' : $errors->has('image') ? 'form-control is-invalid' : 'form-control']) !!}
        @if ($errors->has('image'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('image') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    {!! Form::label('roles', 'Role', ['class' => 'col-md-4 col-form-label text-md-right']) !!}

    <div class="col-md-4">
        {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('name','name') : null, ['class' => $errors->has('roles') ? 'form-control is-invalid' : $errors->has('roles') ? 'form-control is-invalid' : 'form-control', 'multiple']) !!}
        @if ($errors->has('roles'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('roles') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    {!! Form::label('kelas', 'Kelas', ['class' => 'col-md-4 col-form-label text-md-right']) !!}

    <div class="col-md-4">
        {!! Form::select('kelas', ['admin'=>'admin','head of library'=>'head of library','7'=>'7','8'=>'8','9'=>'9',], null, ['class' => $errors->has('kelas') ? 'form-control is-invalid' : 'form-control', 'placeholder'=>'']) !!}
        @if ($errors->has('kelas'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('kelas') }}</strong>
            </span>
        @endif
    </div>
</div>


<div class="form-group row">
    {!! Form::label('status', 'Status', ['class' => 'col-md-4 col-form-label text-md-right']) !!}

    <div class="col-md-4">
        <div class="form-check">
            {!! Form::radio('status', 'active', true, ['class'=>'form-check-input', 'id'=>'active']) !!}
            <label class="form-check-label" for="active">
                Active
            </label>
        </div>
        <div class="form-check">
            {!! Form::radio('status', 'not active', null, ['class'=>'form-check-input', 'id'=>'notactive']) !!}
            <label class="form-check-label" for="notactive">
                Not Active
            </label>
        </div>
       
        @if ($errors->has('status'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('status') }}</strong>
            </span>
        @endif
    </div>
</div>


<div class="form-group row">
    {!! Form::label('password', 'Password', ['class' => 'col-md-4 col-form-label text-md-right']) !!}

    <div class="col-md-4">
        {!! Form::password('password', ['class' => $errors->has('password') ? 'form-control is-invalid' : $errors->has('password') ? 'form-control is-invalid' : 'form-control']) !!}
        @if ($errors->has('password'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
	{!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-md-4 col-form-label text-md-right']) !!}

	<div class="col-md-4">
    	{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
    </div>
</div>