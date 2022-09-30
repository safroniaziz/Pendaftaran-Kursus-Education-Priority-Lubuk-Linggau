<li class="header" style="font-weight:bold;">MAIN MENU</li>
<li class="{{ set_active('user.dashboard') }}">
    <a href="{{ route('user.dashboard') }}">
        <i class="fa fa-home"></i> <span>Dashboard</span>
    </a>
</li>

<li class="{{ set_active('user.proof') }}">
    <a href="{{ route('user.proof') }}">
        <i class="fa fa-credit-card"></i> <span>Kirim Bukti Pembayaran</span>
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
