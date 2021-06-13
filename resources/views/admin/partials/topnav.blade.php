@if(session()->has('errors') || session()->has('message'))
<?php
        $typeAlert = "success";
        $message = session('message');
        if(session()->has('errors')):
            $message = "";        
            $typeAlert = "danger";
            foreach ($errors->all() as $error) {
                $message .= $error."\n";
            }
        endif;
        ?>
<x-alert :type='$typeAlert' :message="$message" />
@endif
<form class="form-inline mr-auto" action="">
</form>
<ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="https://image.freepik.com/free-vector/doodle-soccer-ball_1034-741.jpg"
                class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-title">Menu</div>
            {{-- <a href="{{ Auth::user()->profilelink }}" class="dropdown-item has-icon">
            <i class="far fa-user"></i> Profile Settings
            </a> --}}
            <div class="dropdown-divider"></div>
            <a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off"></i> {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </li>
</ul>
