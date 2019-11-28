@if(Session::has('message'))
    <div class="alert alert-icon {{ Session::get('alert-class') }}" role="alert">
        <i class="fe {{ Session::get('fe-alert') }} mr-2" aria-hidden="true"></i> {!! Session::get('message') !!}
    </div>
@endif