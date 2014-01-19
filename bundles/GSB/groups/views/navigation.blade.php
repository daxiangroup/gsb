<ul class="nav nav-list">
  <li{{ $active_link == 'groups' ? ' class="active"' : '' }}>{{ HTML::link_to_route('groups', 'Study Groups') }}</li>
  <li{{ $active_link == 'groups.my_groups' ? ' class="active"' : '' }}>{{ HTML::link_to_route('groups.my_groups', 'My Study Groups') }}</li>
</ul>
