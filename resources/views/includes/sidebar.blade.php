<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @php
                    $role = App\User::where('email', Session::get('email'))->first()->roles ?? '';
                @endphp

                @if ($role == 'ADMIN')
                    <li class="{{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard.index') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard
                        </a>
                    </li>

                    <li class="menu-title">Data</li><!-- /.menu-title -->

                    <li class="{{ request()->is('admin/pegawai*') ? 'active' : '' }}">
                        <a href="{{ route('admin.pegawai.index') }}"><i class="menu-icon fa fa-user"></i>Pegawai </a>
                    </li>
                    <li class="{{ request()->is('admin/biro*') ? 'active' : '' }}">
                        <a href="{{ route('admin.biro.index') }}"><i class="menu-icon fa fa-user"></i>Biro </a>
                    </li>
                    <li class="{{ request()->is('admin/yth*') ? 'active' : '' }}">
                        <a href="{{ route('admin.yth.index') }}"><i class="menu-icon fa fa-user"></i>Yth </a>
                    </li>
                    <li class="{{ request()->is('admin/surat-nota-dinas*') ? 'active' : '' }}">
                        <a href="{{ route('admin.surat-nota-dinas.index') }}"><i
                                class="menu-icon fa fa-envelope"></i>Surat
                            Nota
                            Dinas </a>
                    </li>
                    <li class="{{ request()->is('admin/surat-undangan*') ? 'active' : '' }}">
                        <a href="{{ route('admin.surat-undangan.index') }}"><i
                                class="menu-icon fa fa-envelope"></i>Surat
                            Undangan </a>
                    </li>
                @else
                    <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.index') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard
                        </a>
                    </li>
                    <li class="{{ request()->is('nota-dinas*') ? 'active' : '' }}">
                        <a href="{{ route('nota.dinas.index') }}"><i class="menu-icon fa fa-envelope"></i>Surat Nota
                            Dinas</a>
                    </li>
                    <li class="{{ request()->is('undangan*') ? 'active' : '' }}">
                        <a href="{{ route('undangan.index') }}"><i class="menu-icon fa fa-envelope"></i>Surat
                            Undangan</a>
                    </li>
                @endif

                <li class="">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i
                            class="menu-icon fa fa-sign-out"></i>Logout </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>



            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
