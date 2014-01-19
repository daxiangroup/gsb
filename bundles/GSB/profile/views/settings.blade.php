@layout('layouts/left40')

@section('content-left')
@include('profile::navigation')
@endsection

@section('content-right')

<div class="page-header">
    <h2>Profile Settings<br>
    <small>These settings define how your profile behaves throughout the site</small></h2>
</div>

<div class="row-fluid form-row">
    <div class="span3">{{ Form::label('password_current', 'Login Page') }}</div>
    <div class="span8">
        <div class="btn-group">
            <button class="btn btn-small" data-toggle="dropdown">Action</button>
            <button class="btn btn-small dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <!-- dropdown menu links -->
                <li><a tabindex="-1" href="#">Dashboard</a></li>
                <li><a tabindex="-1" href="#">Profile Page</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="row-fluid control-row">
    <div class="span3"></div>
    <div class="span8">{{ Form::button('Save', array('class'=>'btn btn-primary')) }}</div>
</div>

<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
@endsection