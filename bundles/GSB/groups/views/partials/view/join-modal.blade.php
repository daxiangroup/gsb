{{ Form::button('Join This Group', array('class'=>'btn btn-primary', 'data-toggle'=>'modal', 'data-target'=>'#mdl-join')) }}

<!-- Modal -->
<div id="mdl-join" class="modal hide fade" tabindex="-1" ole="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-off"></i></button>
        <h3 id="myModalLabel">Join Study Group</h3>
    </div>
    <div class="modal-body">
        <p>You are attempting to join the Study Group:</p>
        <p><strong>{{ $group->get_name() }}</strong></p>
        <p>Before you can join the group, the adminstrator has to approve your membership.</p>
    </div>
    <div class="modal-footer">
        {{ Form::open(URI::current().'/join', 'POST') }}
        {{ Form::token() }}
        {{ Form::hidden('group_id', $group->get_id()) }}
        {{ Form::hidden('profile_id', Auth::user()->id) }}
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary">Join This Group</button>
        {{ Form::close() }}
    </div>
</div>