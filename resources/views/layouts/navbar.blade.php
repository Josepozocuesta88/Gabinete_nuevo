<!-- ========== Topbar Start ========== -->
<div class="navbar-custom @if (!auth()->user()) m-0 @endif">
    <div class="topbar container-fluid">
        <div class="gap-1 d-flex align-items-center gap-lg-2">

            <!-- Sidebar Menu Toggle Button -->
            @auth
            <button class="button-toggle-menu">
                <i class="mdi mdi-menu"></i>
            </button>
            @else
            <a href="{{ route('welcome') }}" class="py-1" style="width: 15%;">
                <img src="{{ asset(config('app.logo')) }}" alt="small logo" class="img-fluid">
            </a>
            @endauth
            <!-- Horizontal Menu Toggle Button -->
            <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>

            <!-- Topbar Search Form -->
            <div class="app-search dropdown d-none d-lg-block">
                <form method="GET" action="{{ route('search') }}">
                    <div class="input-group">
                        <input type="search" class="form-control dropdown-toggle" placeholder="Buscar articulos..."
                            id="top-search" name="query">
                        <span class="mdi mdi-magnify search-icon"></span>
                        <button class="input-group-text btn text-white" style="background-color:#293480;" type="submit">Buscar</button>
                    </div>
                </form>
            </div>
        </div>

        <ul class="gap-3 topbar-menu d-flex align-items-center">
            <li class="dropdown d-lg-none">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <i class="ri-search-line font-22"></i>
                </a>
                <div class="p-0 dropdown-menu dropdown-menu-animated dropdown-lg">
                    <form class="p-3">
                        <input type="search" class="form-control" placeholder="Search ..."
                            aria-label="Recipient's username">
                    </form>
                </div>
            </li>

            <!-- regalo puntos -->
            <li class="d-none d-md-inline-block">
                <a class="nav-link" href="{{ route('all.points') }}">
                    <!--mdi mdi-gift es el cerrado -->
                    <i class="mdi mdi-gift-open font-22"></i>
                </a>
            </li>

            <!-- full scream -->
            <li class="d-none d-md-inline-block">
                <a class="nav-link" href="" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line font-22"></i>
                </a>
            </li>

            <!-- productos favoritos -->
            <li class="d-none d-md-inline-block">
                <a class="nav-link" href="{{ route('favoritos.show') }}">
                    <!--mdi mdi-gift es el cerrado -->
                    <i class="bi bi-suit-heart-fill font-22"></i>

                </a>
            </li>

            <!-- añadir carrito -->
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="javascript:void(0);"
                    role="button" aria-haspopup="false" aria-expanded="false" onclick="cargarCarrito()">
                    <i class=" ri-shopping-cart-line font-22"></i>
                    <span class="position-absolute start-100 translate-middle badge rounded-pill bg-danger font-8">
                        {{ $contador }}
                    </span>
                </a>
                <div class="py-0 dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">
                    <div class="p-2 border border-dashed border-top-0 border-start-0 border-end-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0 font-16 fw-semibold"> Cesta</h6>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('cart.show') }}" class="text-dark text-decoration-underline">
                                    <small>Ir a la cesta</small>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="p-2 modalCesta"></div>
                    <!-- All-->
                    <a href="{{ route('cart.show') }}"
                        class="py-2 text-center dropdown-item text-primary notify-item border-top">
                        Ir a la cesta
                    </a>

                </div>
            </li>
            @auth
            <li class="dropdown">
                <a class="px-2 nav-link dropdown-toggle arrow-none nav-user" data-bs-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="account-user-avatar">
                        <!-- <img src="{{ asset('images/florys/banner.jpg') }}" alt="user-image" width="32"
                                                            class="rounded-circle"> -->
                        <i class="bi bi-person-circle font-25
                                            @if (Auth::user() && Auth::user()->usugrucod === 'admin') text-danger
                                            @else
                                                text-primary @endif">
                        </i>
                    </span>
                    <span class="gap-1 d-lg-flex flex-column d-none">

                        <h5 class="my-0">{{ Auth::user()->name }}</h5>
                        <h6 class="my-0 fw-normal">{{ Auth::user()->usugrucod }}</h6>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="m-0 text-overflow">Bienvenid@ !</h6>
                    </div>



                    <!-- item-->
                    @auth
                    @if (Auth::user() && Auth::user()->usugrucod === 'Admin')
                    <a href="{{ route('accounts') }}" class="dropdown-item">
                        <i class="uil-users-alt me-1"></i>
                        <span>Iniciar sesión como usuario</span>
                    </a>
                    <!-- descargar logs de usuario -->
                    <a href="{{ route('userlog.downloadFile') }}" class="dropdown-item">
                        <i class="bi bi-cloud-arrow-down me-1"></i>
                        <span>Descargar logs de usuarios</span>
                    </a>
                    @endif
                    @endauth


                    <!-- item-->
                    @if (session()->has('impersonate'))
                    <a href="{{ route('account.logout') }}" class="dropdown-item">
                        <i class="uil-users-alt me-1"></i>
                        <span>Salir de este usuario</span>
                    </a>
                    @else
                    <!-- item-->
                    <a href="{{ route('myaccount') }}" class="dropdown-item">
                        <i class="mdi mdi-account-circle me-1"></i>
                        <span>Mi Cuenta</span>
                    </a>

                    <!-- item-->
                    <a href="{{ route('form-report') }}" class="dropdown-item">
                        <i class="mdi mdi-lifebuoy me-1"></i>
                        <span>Soporte Técnico</span>
                    </a>

                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout me-1"></i>
                        {{ __('Salir') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @endif

                </div>
            </li>
            @else
            <li class="dropdown">
                <a class="px-2 nav-link dropdown-toggle arrow-none nav-user" href="{{ route('login') }}" role="button">
                    <span class="account-user-avatar">
                        <i class="bi bi-person-circle font-25 text-primary"></i>
                    </span>
                    <span class="gap-1 d-lg-flex flex-column d-none">
                        <h5 class="my-0">Iniciar Sesión</h5>
                    </span>
                </a>
            </li>
            @endauth
        </ul>
    </div>
</div>
<!-- ========== Topbar End ========== -->

<!-- ========== Left Sidebar Start ========== -->
@auth
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{ route('home') }}" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset(config('app.logo')) }}" alt="logo" class="mt-3  w-100 h-100">
        </span>
        <span class="logo-sm">
            <img src="{{ asset(config('app.logo')) }}" alt="small logo" class="w-100 h-100">
        </span>
    </a>


    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="align-middle ri-checkbox-blank-circle-line"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="align-middle ri-close-fill"></i>
    </div>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title text-light">Navegación</li>

            <li class="side-nav-item">
                <a href="{{ route('dashboard') }}" class="side-nav-link text-light">
                    <i class="uil-home-alt"></i>
                    <!-- <span class="badge bg-success float-end">5</span> -->
                    <span> Panel de Control</span>
                </a>
            </li>

            <li class="side-nav-title text-light">Ventas</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages"
                    class="side-nav-link text-light">
                    <i class="uil-store"></i>
                    <span> Comercio </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('history') }}">Histórico</a>
                        </li>
                        <li>
                            <a onclick="window.location.href='/articles/search?query=';" href="#">Productos</a>
                        </li>
                        <li>
                            <a href="{{ route('show.categorias') }}">Categorías</a>
                        </li>
                        <li>
                            <a href="{{ route('pedido.mostrarPedido') }}">Mis Pedidos</a>
                        </li>
                    </ul>
                </div>
            </li>



            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#gestion" aria-expanded="false" aria-controls="sidebarPages"
                    class="side-nav-link text-light">
                    <i class=" ri-booklet-line"></i>
                    <span> Gestión documental </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="gestion">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('get.documentos', ['doctip' => 'Facturas']) }}">Facturas</a>
                        </li>
                        @if (Auth::user() && Auth::user()->usugrucod === 'Admin')
                        <li>
                            <a href="{{ route('get.documentos', ['doctip' => 'Albaranes']) }}">Albaranes</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>

            <!-- Help Box -->
            <div aria-live="polite" aria-atomic="true" class="p-3">
                <div class="p-0 m-0 toast show help-box">
                    <div class="toast-header">
                        <h5 class="m-0 text-dark"><i class="mdi mdi-gift-open font-22 pe-1"></i>{{ config('app.points')
                            }}</h5>
                        <button type="button" class="m-auto text-white btn-close float-end me-2" data-bs-dismiss="toast"
                            aria-label="Cerrar"></button>
                    </div>
                    <div class="text-center text-white toast-body">
                        <p class="mb-3">Acumula puntos por tus compras para recibir descuentos y otras
                            ventajas</p>
                        <a href="{{ route('all.points') }}" class="btn btn-warning btn-sm text-dark fw-bolder">Ver mis
                            puntos</a>
                    </div>
                </div>
            </div>
            <!-- end Help Box -->

            <!-- representantes  -->
            @isset($representante)
            <div class="p-1 bg-white show help-box">
                <div class="text-dark">
                    <i class="bi bi-whatsapp pe-1"></i>Repr.:
                    <a href="https://wa.me/{{ str_replace(' ', '', $representante->rprtel) }}">{{ $representante->rprtel
                        }}</a>
                </div>
            </div>
            @endisset

        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
@endauth
<!-- ========== Left Sidebar End ========== -->