<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">Anich</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">Ac</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="fas fa-fire"></i><span>Dashboard</span>
                </a>
            </li>
            <li class="menu-header">Category</li>
            <li class="{{ Route::is('admin.category') ? 'active' : '' }}">
                <a href="{{ route('admin.category') }}" class="nav-link">
                    <i class="fas fa-bars"></i><span>Categories</span>
                </a>
            </li>
            <li class="{{ Route::is('admin.subcategory') ? 'active' : '' }}">
                <a href="{{ route('admin.subcategory') }}" class="nav-link">
                    <i class="fas fa-list"></i><span>Sub Categories</span>
                </a>
            </li>

            <li class="menu-header">Video</li>
            <li class="{{ (Route::is('admin.item') or Route::is('admin.item.create')) ? 'active' : '' }}">
                <a href="{{ route('admin.item') }}" class="nav-link">
                    <i class="fas fa-video"></i><span>All Item Movies</span></a>
            </li>
            <li><a href="#" class="nav-link"><i class="fas fa-film"></i><span>Single Items</span></a></li>
            <li><a href="#" class="nav-link"><i class="fas fa-tv"></i><span>Episode Items</span></a></li>
            <li class="{{ Route::is('admin.genre') ? 'active' : '' }}">
                <a href="{{ route('admin.genre') }}" class="nav-link">
                    <i class="fas fa-podcast"></i><span>Genre</span>
                </a>
            </li>
            <li class="{{ Route::is('admin.status') ? 'active' : '' }}">
                <a href="{{ route('admin.status') }}" class="nav-link">
                    <i class="fas fa-signal"></i><span>Status</span>
                </a>
            </li>

            <li class="menu-header">Website</li>
        </ul>
    </aside>
</div>
