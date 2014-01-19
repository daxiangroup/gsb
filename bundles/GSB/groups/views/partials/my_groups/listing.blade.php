<div class="listing group-study" data-id="{{ $group->get_id() }}">
    <div class="lbl">Name:</div>
    <div class="fld">{{ $group->get_name() }}</div>

    <div class="lbl">Headline:</div>
    <div class="fld">{{ $group->get_headline() }}</div>

    <div class="lbl">Graduating Year:</div>
    <div class="fld">{{ $group->get_graduating_year() }}</div>

    <div class="lbl">Max Size:</div>
    <div class="fld">{{ $group->get_max_size() }}</div>

    <div data-toggle="modal" data-target="#mdl-leave">clicker</div>

    {{ Form::button('Leave This Group', array('class'=>'btn btn-mini', 'data-toggle'=>'modal', 'data-target'=>'#mdl-part')) }}
</div>