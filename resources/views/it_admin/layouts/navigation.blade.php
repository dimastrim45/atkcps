<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{ route('profile.showITAdmin') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item {{ $title === 'adminhome' ? 'bg-primary rounded' : '' }}">
                <a href="{{ route('homeadminit') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item {{ $title === 'users' ? 'bg-primary rounded' : '' }}">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('Users') }}
                    </p>
                </a>
            </li>

            <li class="nav-item {{ $title === 'items' ? 'bg-primary rounded' : '' }}">
                <a href="{{ route('items') }}" class="nav-link">
                    <i class="nav-icon bi bi-boxes fas"></i>
                    <p>
                        {{ __('Item Master Data') }}
                    </p>
                </a>
            </li>

            <li class="nav-item {{ $title === 'barangmasuks' ? 'bg-primary rounded' : '' }}">
                <a href="{{ route('barangmasuks') }}" class="nav-link">
                    <i class="nav-icon bi bi-box-arrow-in-down fas"></i>
                    <p>
                        {{ __('Barang Masuk') }}
                    </p>
                </a>
            </li>

            <li class="nav-item  {{ $title === 'permintaans' ? 'bg-primary rounded' : '' }}">
                <a href="{{ route('permintaans') }}" class="nav-link">
                    <i class="nav-icon far fa-envelope"></i>
                    <p>
                        {{ __('Permintaan') }}
                    </p>
                </a>
            </li>

            <li class="nav-item {{ $title === 'pengeluarans' ? 'bg-primary rounded' : '' }}">
                <a href="{{ route('pengeluarans') }}" class="nav-link">
                    <i class="nav-icon far bi bi-dropbox"></i>
                    <p>
                        {{ __('Pengeluaran Barang') }}
                    </p>
                </a>
            </li>

            <li class="nav-item {{ $title === 'selisihs' ? 'bg-primary rounded' : '' }}">
                <a href="{{ route('selisihs') }}" class="nav-link">
                    <i class="nav-icon far bi bi-plus-slash-minus"></i>
                    <p>
                        {{ __('Selisih Stock') }}
                    </p>
                </a>
            </li>

            <li class="nav-item {{ $title === 'feedbacks' ? 'bg-primary rounded' : '' }}">
                <a href="{{ route('feedbacks') }}" class="nav-link">
                    <i class="nav-icon far fa-comments"></i>
                    <p>
                        {{ __('Feedback') }}
                    </p>
                </a>
            </li>

            <li class="nav-item {{ $title === 'plants' ? 'bg-primary rounded' : '' }}">
                <a href="{{ route('plants') }}" class="nav-link">
                    <i class="nav-icon far fa-building"></i>
                    <p>
                        {{ __('Plant Management') }}
                    </p>
                </a>
            </li>

            <li class="nav-item {{ $title === 'reports' ? 'bg-primary rounded' : '' }}">
                <a href="{{ route('reports') }}" class="nav-link">
                    <i class="nav-icon far fa-building"></i>
                    <p>
                        {{ __('Reports') }}
                    </p>
                </a>
            </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
