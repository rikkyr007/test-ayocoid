<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="#">PT. XYZ</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">XYZ</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ Request::route()->getName() == 'home' ? ' active' : '' }}"><a class="nav-link"
                href="{{ route('home') }}"><i class="fa fa-columns"></i> <span>Dashboard</span></a></li>
        <li class="menu-header">Management</li>
        <li class="{{ Request::route()->getName() == 'teams.index' ? ' active' : '' }}"><a class="nav-link"
                href="{{ route('teams.index') }}"><i class="fa fa-sitemap"></i> <span>Teams & Players</span></a></li>
        <li class="{{ Request::route()->getName() == 'schedules.index' ? ' active' : '' }}"><a class="nav-link"
                href="{{ route('schedules.index') }}"><i class="fa fa-calendar"></i> <span>Schedules</span></a></li>
    </ul>
</aside>
