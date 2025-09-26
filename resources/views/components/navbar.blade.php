<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm">
    <div class="container-fluid">
        <button class="btn btn-link" id="sidebar-toggle">
            <i class="fas fa-bars"></i>
        </button>

        <div class="d-flex align-items-center">
            <div class="dropdown">
                <a class="nav-link rounded-circle border border-dark border-3 px-1" 
                   style="width: 30px; height:30px;" 
                   href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user mx-auto"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Sidebar Backdrop -->
<div class="sidebar-backdrop"></div>

<!-- Sidebar -->
<nav class="sidebar">
    <div class="sidebar-menu">
        <div class="sidebar-item">
            <a href="{{ route('dashboard') }}" class="sidebar-link">
                <i class="fas fa-chart-area"></i>
                <span>Dashboard</span>
            </a>
        </div>
        <div class="sidebar-item">
            <a href="{{ route('keuangan.index') }}" class="sidebar-link">
                <i class="fas fa-coins"></i>
                <span>Keuangan</span>
            </a>
        </div>
        <div class="sidebar-item">
            <a href="{{ route('imam.index') }}" class="sidebar-link">
                <i class="fas fa-mosque"></i>
                <span>Jadwal Imam & Khotib</span>
            </a>
        </div>
        <div class="sidebar-item">
            <a href="{{ route('pengajian.index') }}" class="sidebar-link">
                <i class="fas fa-book-open"></i>
                <span>Jadwal Pengajian</span>
            </a>
        </div>
    </div>
</nav>
