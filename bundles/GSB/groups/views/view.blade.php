@layout('layouts/left40')

@section('content-left')
@include('groups::navigation')
@endsection

@section('content-right')

<div class="page-header">
    <h2>{{ $group->get_name() }}<br>
</div>

Headline<br>
{{ $group->get_headline() }}<br><br>

Description<br>
{{ $group->get_description() }}<br><br>

Graduating Year<br>
{{ $group->get_graduating_year() }}<br><br>

Max Size / Current Buddies<br>
{{ $group->get_max_size() }} / {{ $group->get_buddy_count() }}<br><br>

Admin<br>
{{ $group->get_admin_name() }}<br><br>

Co-Admin<br>
{{ $group->get_co_admin_name() }}<br><br>

@if ($group->has_spots())
@include('groups::partials.view.join-modal')
@endif

@endsection