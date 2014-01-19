@layout('layouts/left40')

@section('content-left')
@include('profile::navigation')
@endsection

@section('content-right')

{{ Form::open() }}
{{ Form::token() }}
<div class="page-header">
    <h2>Account<br>
    <small>Change your primary account settings</small></h2>
</div>

@if (Session::get('success') === false)
<div class="alert alert-error">{{ Lang::line('profile::strings.account.save_error')->get('en') }}</div>
@endif

@if (Session::get('success') === true)
<div class="alert alert-success">{{ Lang::line('profile::strings.account.save_success')->get('en') }}</div>
@endif

<div class="row-fluid form-row{{ $errors->has('account_username') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('account_username', Lang::line('profile::strings.labels.username')->get('en')) }}
    </div>
    <div class="span8">
        {{ Form::text('account_username', $form_values['account_username']) }}
        {{ $errors->has('account_username') ? $errors->first('account_username', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid form-row{{ $errors->has('account_email') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('account_email', Lang::line('profile::strings.labels.email')) }}
    </div>
    <div class="span8">
        {{ Form::text('account_email', $form_values['account_email']) }}
        {{ $errors->has('account_email') ? $errors->first('account_email', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid form-row{{ $errors->has('account_full_name') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('account_full_name', Lang::line('profile::strings.labels.full_name')) }}
    </div>
    <div class="span8">
        {{ Form::text('account_full_name', $form_values['account_full_name']) }}
        {{ $errors->has('account_full_name') ? $errors->first('account_full_name', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid form-row{{ $errors->has('account_graduating_year') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('account_graduating_year', Lang::line('profile::strings.labels.graduating_year')) }}
    </div>
    <div class="span8">
        {{ Form::text('account_graduating_year', $form_values['account_graduating_year']) }}
        {{ $errors->has('account_graduating_year') ? $errors->first('account_graduating_year', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid form-row{{ $errors->has('account_bio') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('account_bio', Lang::line('profile::strings.labels.bio')) }}
    </div>
    <div class="span8">
        {{ Form::text('account_bio', $form_values['account_bio']) }}
        {{ $errors->has('account_bio') ? $errors->first('account_bio', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid control-row">
    <div class="span3"></div>
    <div class="span8">{{ Form::button('Save', array('class'=>'btn btn-primary')) }}</div>
</div>
{{ Form::close() }}

@endsection