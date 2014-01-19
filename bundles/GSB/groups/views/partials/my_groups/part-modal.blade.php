<!-- Modal -->
<div id="mdl-part" class="modal hide fade" tabindex="-1" ole="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-off"></i></button>
        <h3 id="myModalLabel">Leave Study Group</h3>
    </div>
    <div class="modal-body">
        <p>You are about to leave the Study Group:</p>
        <p><strong>{{ $group->get_name() }}</strong></p>
        <p>Are you sure you would like to leave this group?</p>
    </div>
    <div class="modal-footer">
        {{ Form::open(URL::to_route('groups.part'), 'POST') }}
        {{ Form::token() }}
        {{ Form::hidden('group_id', $group->get_id(), array('id' => 'group_part_group_id')) }}
        {{ Form::hidden('profile_id', Auth::user()->id) }}
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary">Leave This Group</button>
        {{ Form::close() }}
    </div>
</div>