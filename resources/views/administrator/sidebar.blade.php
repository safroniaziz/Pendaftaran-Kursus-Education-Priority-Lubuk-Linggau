<li class="header" style="font-weight:bold;">MENU UTAMA</li>
<li class="{{ set_active('administrator.dashboard') }}">
    <a href="{{ route('administrator.dashboard') }}">
        <i class="fa fa-home"></i> <span>Dashboard</span>
    </a>
</li>

<li class="{{ set_active('administrator.user') }}">
    <a href="{{ route('administrator.user') }}">
        <i class="fa fa-users"></i> <span>User Terdaftar</span>
    </a>
</li>

<li class="{{ set_active('administrator.settings') }}">
    <a href="{{ route('administrator.settings') }}">
        <i class="fa fa-gear"></i> <span>Pengaturan Aplikasi</span>
    </a>
</li>

<li style="padding-left:2px;">
    <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
        <i class="fa fa-power-off text-danger"></i>{{__('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

</li>
