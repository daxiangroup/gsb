@layout('layouts/left40')

@section('content-left')
@include('groups::navigation')
@endsection

@section('content-right')

<div class="page-header">
    <h2>Available Study Groups<br>
    <small>Search for Study Groups</small></h2>
</div>

<div id="ctr-groups-filter" class="container">
    @include('groups::partials.index.filter')
</div>
<br />

<div id="lst-groups" class="container">
@foreach ($groups as $group)
    @include('groups::partials.index.listing')
@endforeach
</div>

@endsection