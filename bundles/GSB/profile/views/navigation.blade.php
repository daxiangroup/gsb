<ul class="nav nav-list">
  <li{{ $active_link == 'profile' ? ' class="active"' : '' }}>{{ HTML::link_to_route('profile', 'Account') }}</li>
  <li{{ $active_link == 'profile.password' ? ' class="active"' : '' }}>{{ HTML::link_to_route('profile.password', 'Password') }}</li>
  <li{{ $active_link == 'profile.settings' ? ' class="active"' : '' }}>{{ HTML::link_to_route('profile.settings', 'Profile Settings') }}</li>
</ul>
