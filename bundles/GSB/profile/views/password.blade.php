@layout('layouts/left40')

@section('content-left')
@include('profile::navigation')
@endsection

@section('content-right')

{{ Form::open() }}
{{ Form::token() }}
<div class="page-header">
    <h2>Password<br>
    <small>Change your password or remember your current one</small></h2>
</div>

@if (Session::get('success') === false)
<div class="alert alert-error">{{ Lang::line('profile::strings.password.save_error')->get('en') }}</div>
@endif

@if (Session::get('success') === true)
<div class="alert alert-success">{{ Lang::line('profile::strings.password.save_success')->get('en') }}</div>
@endif

<div class="row-fluid form-row{{ $errors->has('password_current') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('password_current', Lang::line('profile::strings.labels.password')->get('en')) }}
    </div>
    <div class="span8">
        {{ Form::password('password_current') }}
        {{ $errors->has('password_current') ? $errors->first('password_current', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid form-row{{ $errors->has('password_new') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('password_new', Lang::line('profile::strings.labels.new_password')->get('en')) }}
    </div>
    <div class="span8">
        {{ Form::password('password_new') }}
        {{ $errors->has('password_new') ? $errors->first('password_new', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid form-row{{ $errors->has('password_verify') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('password_verify', Lang::line('profile::strings.labels.verify_password')->get('en')) }}
    </div>
    <div class="span8">
        {{ Form::password('password_verify') }}
        {{ $errors->has('password_verify') ? $errors->first('password_verify', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid control-row">
    <div class="span3"></div>
    <div class="span8">{{ Form::button('Save', array('class'=>'btn btn-primary')) }}</div>
</div>
{{ Form::close() }}

@endsection