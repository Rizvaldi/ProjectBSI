<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <!-- Sidenav Menu Heading (Account)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <div class="sidenav-menu-heading d-sm-none">Account</div>
            <!-- Sidenav Link (Alerts)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <a class="nav-link d-sm-none" href="#!">
                <div class="nav-link-icon"><i data-feather="bell"></i></div>
                Alerts
                <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
            </a>
            <!-- Sidenav Link (Messages)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <a class="nav-link d-sm-none" href="#!">
                <div class="nav-link-icon"><i data-feather="mail"></i></div>
                Messages
                <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
            </a>
            <!-- Sidenav Menu Heading (Core)-->
            <div class="sidenav-menu-heading">Menu</div>
            <!-- Sidenav Link (Dashboard)-->
            <a class="nav-link {{ (request()->is('admin/dashboard')) ? 'active' : '' }}" href="{{ route('admin-dashboard') }}">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Dashboard
            </a>
            <a class="nav-link {{ (request()->is('admin/department*')) ? 'active' : '' }}" href="{{ route('department.index') }}">
                <div class="nav-link-icon"><i data-feather="home"></i></div>
                Data Unit Kerja
            </a>
            
            <a class="nav-link {{ (request()->is('admin/letter/create')) ? 'active' : '' }}" href="{{ route('letter.create') }}">
                <div class="nav-link-icon"><i data-feather="mail"></i></div>
                Tambah Surat
            </a>
            <a class="nav-link {{ (request()->is('admin/letter/surat-peminjaman-recovery')) ? 'active' : '' }}" href="{{ route('surat-peminjaman-recovery') }}">
                <div class="nav-link-icon"><i data-feather="arrow-right"></i></div>
                Surat Peminjaman Recovery
            </a>
            <a class="nav-link {{ (request()->is('admin/letter/surat-penyerahan-recovery')) ? 'active' : '' }}" href="{{ route('surat-penyerahan-recovery') }}">
                <div class="nav-link-icon"><i data-feather="arrow-left"></i></div>
                Surat Penyerahan Recovery
            </a>
            <a class="nav-link {{ (request()->is('admin/letter/surat-pelunasan')) ? 'active' : '' }}" href="{{ route('surat-pelunasan') }}">
                <div class="nav-link-icon"><i data-feather="arrow-right"></i></div>
                Surat Pelunasan
            </a>
            <a class="nav-link {{ (request()->is('admin/letter/surat-penyerahan-afo')) ? 'active' : '' }}" href="{{ route('surat-penyerahan-afo') }}">
                <div class="nav-link-icon"><i data-feather="arrow-left"></i></div>
                Surat Penyerahan AFO
            </a>
            <a class="nav-link {{ (request()->is('admin/letter/surat-permohonan-appraisal')) ? 'active' : '' }}" href="{{ route('surat-permohonan-appraisal') }}">
                <div class="nav-link-icon"><i data-feather="arrow-left"></i></div>
                Surat Permohonan Appraisal
            </a>
            <a class="nav-link {{ (request()->is('admin/user*')) ? 'active' : '' }}" href="{{ route('user.index') }}">
                <div class="nav-link-icon"><i data-feather="user"></i></div>
                Data User
            </a>
            <a class="nav-link {{ (request()->is('admin/setting*')) ? 'active' : '' }}" href="{{ route('setting.index') }}">
                <div class="nav-link-icon"><i data-feather="settings"></i></div>
                Profile
            </a>
        </div>
    </div>
    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title">{{ Auth::user()->name }}</div>
        </div>
    </div>
</nav>