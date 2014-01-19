{{ Form::open() }}
{{ Form::token() }}

Name: {{ Form::text('groups_filter_name') }}
Year: {{ Form::text('groups_filter_year') }}
Size: {{ Form::text('groups_filter_size') }}<br>
{{ Form::submit('Filter', array('class'=>'btn btn-primary')) }}

{{ Form::close() }}