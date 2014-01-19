<ul>
    @if (!Auth::guest())
    <li>{{ HTML::link_to_route('dashboard', 'Dashboard') }}</li>
    <li>{{ HTML::link_to_route('profile', 'Profile Settings') }}</li>
    <li>{{ HTML::link_to_route('groups', 'Study Groups') }}</li>
    <li>{{ HTML::link_to_route('logout', 'Logout') }}</li>
    @endif
</ul>
