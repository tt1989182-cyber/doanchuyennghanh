<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle -->
    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    {{-- Actions --}}
    <a href="{{ route('storage.link') }}" class="btn btn-outline-warning btn-sm mr-2">
        <i class="fas fa-folder-open"></i> Lưu trữ
    </a>

    <a href="{{ route('cache.clear') }}" class="btn btn-outline-danger btn-sm mr-3"
       onclick="return confirm('Bạn có chắc muốn làm sạch cache?')">
        <i class="fas fa-broom"></i> Làm sạch
    </a>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        {{-- Home --}}
        <li class="nav-item mx-1">
            <a class="nav-link" href="{{ route('home') }}" target="_blank"
               data-toggle="tooltip" data-placement="bottom" title="Trang chủ">
                <i class="fas fa-home fa-fw"></i>
            </a>
        </li>

        {{-- Notifications --}}
        <li class="nav-item dropdown no-arrow mx-1">
            @include('backend.notification.show')
        </li>

        {{-- Messages --}}
        <li class="nav-item dropdown no-arrow mx-1" id="messageT"
            data-url="{{ route('messages.five') }}">
            @include('backend.message.message')
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        {{-- User --}}
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown"
               role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    {{ auth()->user()->name }}
                </span>

                <img class="img-profile rounded-circle"
                     src="{{ auth()->user()->photo ?? asset('backend/img/avatar.png') }}">
            </a>

            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                 aria-labelledby="userDropdown">

                <a class="dropdown-item" href="{{ route('admin-profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Hồ sơ
                </a>

                <a class="dropdown-item" href="{{ route('change.password.form') }}">
                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                    Đổi mật khẩu
                </a>

                <a class="dropdown-item" href="{{ route('settings') }}">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cài đặt
                </a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                    Đăng xuất
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>

    </ul>
</nav>
