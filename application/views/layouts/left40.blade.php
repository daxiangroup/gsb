@include('layouts/master-head')

<div class="row-fluid">
    <div class="span3">@yield('content-left')</div>
    <div class="span9">@yield('content-right')</div>
</div>

@include('layouts/master-footer')