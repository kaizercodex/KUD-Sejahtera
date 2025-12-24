<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">@yield('breadcrumb', 'Dashboard')</li>
      </ol>
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        <span class="d-none d-md-block text-sm text-dark font-weight-bold">
          {{ Auth::user()->name ?? 'User' }}
        </span>
      </div>
      <ul class="navbar-nav d-flex align-items-center justify-content-end">
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </li>
        <li class="nav-item dropdown pe-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body font-weight-bold px-0" id="dropdownMenuUser" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="material-symbols-rounded">account_circle</i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuUser">
            <li class="mb-2">
              <a class="dropdown-item border-radius-md" href="javascript:;">
                <div class="d-flex py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="text-sm font-weight-normal mb-1">
                      <i class="material-symbols-rounded opacity-10 me-2">person</i>
                      <span class="font-weight-bold">{{ Auth::user()->name ?? 'User' }}</span>
                    </h6>
                    <p class="text-xs text-secondary mb-0">
                      {{ Auth::user()->email ?? '' }}
                    </p>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="dropdown-item border-radius-md">
                  <div class="d-flex py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="text-sm font-weight-normal mb-0">
                        <i class="material-symbols-rounded opacity-10 me-2">logout</i>
                        <span class="font-weight-bold">Logout</span>
                      </h6>
                    </div>
                  </div>
                </button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->
