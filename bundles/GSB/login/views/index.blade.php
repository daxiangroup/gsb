@layout('layouts/master')

@section('content')
{{ Form::open('/login', 'POST') }}
{{ Form::token() }}

<div class="form-row">
    <div class="form-label">{{ Form::label('login', 'Login') }}</div>
    <div class="form-input">{{ Form::text('login', '', array('autofocus'=>'autofocus')) }}</div>
</div>

<div class="form-row">
    <div class="form-label">{{ Form::label('password', 'Password') }}</div>
    <div class="form-input">{{ Form::password('password') }}</div>
</div>

<div class="form-row">
    <div class="form-label"></div>
    <div class="form-input">{{ Form::checkbox('remember_me', 1, 0, array('id'=>'remember_me')).Form::label('remember_me', 'Remember Me') }}</div>
</div>

<div class="form-row">
    <div class="form-label"></div>
    <div class="form-input">{{ Form::submit('Let\'s Go', array('class'=>'btn btn-primary')) }}</div>
</div>

{{ Form::close() }}
@endsection