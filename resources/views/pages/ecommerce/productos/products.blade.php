@extends('layouts.app')

@section('content')
<div class="pb-3 container-fluid bg-light">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="m-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">eCommerce</a></li> -->
                        <li class="breadcrumb-item active">Productos</li>
                    </ol>
                </div>
                <h4 class="page-title">Productos</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <!-- ofertas -->
    <div class="tw-flex tw-justify-between tw-align-middle tw-ml-4">
        <div class="nav nav-tabs text-dark ">
            <h3>Productos en oferta</h3>
        </div>
        <ul class="mb-3 nav nav-pills bg-nav-pills nav-justified tw-w-4/12 tw-mr-4">

            <li class="nav-item">
                <a href="#tarjetasOfertas" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                    <i class="bi bi-percent d-md-none d-block"></i>
                    <h2 class="d-none d-md-block">Ofertas generales</h2>
                </a>
            </li>
            <li class="nav-item">
                <a href="#carrouselOfertas" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 ">
                    <i class="bi bi-lightbulb d-md-none d-block"></i>
                    <h2 class="d-none d-md-block">Ofertas personalizadas</h2>
                </a>
            </li>
        </ul>
    </div>

    <div class="pb-5 tab-content">
        <div class="tab-pane show active" id="tarjetasOfertas">
            <div class="favoritos">
                <button id="scrollLeft" class="scrollLeft btn btn-light ">
                    <i class="bi bi-arrow-left-circle font-24 text-danger"></i>
                </button>
                <div id="categorias"
                    class="gap-3 pt-3 categorias scrollbar row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 bg-light">
                    @foreach ($articulosOferta as $ofertaArticulo)
                    <div class="">
                        <div class="card h-100 rounded-3 position-relative">
                            <!-- Ícono de la corazon -->
                            @if (in_array($ofertaArticulo->artcod, $favoritos))
                            <i onclick="heart(this)" data-artcod="{{ $ofertaArticulo->artcod }}"
                                class="top-0 m-2 cursor-pointer bi bi-suit-heart-fill red-heart position-absolute end-0 font-20 heartIcon"></i>
                            @else
                            <i onclick="heart(this)" data-artcod="{{ $ofertaArticulo->artcod }}"
                                class="top-0 m-2 cursor-pointer bi bi-suit-heart position-absolute end-0 font-20 heartIcon"></i>
                            @endif
                            <figure
                                class="m-0 overflow-hidden bg-white d-flex align-items-center justify-content-center"
                                style="height:325px;">
                                <a href="{{ route('info', ['artcod' => $ofertaArticulo->artcod]) }}" class="d-block">
                                    @if ($ofertaArticulo->imagenes->isNotEmpty())
                                    <img src="{{ asset('images/articulos/' . $ofertaArticulo->imagenes->first()->imanom) }}"
                                        class="h-auto d-block w-100" alt="{{ $ofertaArticulo->artnom }}"
                                        title="{{ $ofertaArticulo->artnom }}"
                                        onerror="this.onerror=null; this.src='{{ asset('images/articulos/noimage.jpg') }}';">
                                    @else
                                    <img src="{{ asset('images/articulos/noimage.jpg') }}" class="h-auto d-block w-100"
                                        alt="no hay imagen" title="No hay imagen">
                                    @endif
                                </a>
                            </figure>
                            <div class="pb-0 bg-white card-body">
                                <a href="{{ route('info', ['artcod' => $ofertaArticulo->artcod]) }}">
                                    <h5 class="m-0 card-title text-primary">{{ $ofertaArticulo->artnom }}</h5>
                                    @isset($ofertaArticulo->artobs)
                                    <p class="card-text l3truncate">{{ $ofertaArticulo->artobs }}</p>
                                    @endisset
                                </a>
                            </div>
                            <div class="pt-0 card-footer">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <a class="pe-1"
                                                href="{{ route('info', ['artcod' => $ofertaArticulo->artcod]) }}"
                                                data-toggle="fullscreen" title="Stock disponible o no">
                                                @if ($ofertaArticulo->artstocon == 1 || $ofertaArticulo->artstock >
                                                1)
                                                <i class="mdi mdi-archive-check font-24 text-success"></i>
                                                @else
                                                <i class="mdi mdi-archive-cancel font-24 text-danger"></i>
                                                @endif
                                            </a>
                                            <a class="pe-1" href="{{ asset('images/' . $ofertaArticulo->artdocaso) }}"
                                                data-toggle="fullscreen" title="Ficha técnica">
                                                <i class="uil-clipboard-alt font-24"></i>
                                            </a>
                                            <a class="pe-1"
                                                href="{{ route('info', ['artcod' => $ofertaArticulo->artcod]) }}"
                                                data-toggle="fullscreen" title="Información">
                                                <i class="mdi mdi-information-outline font-24"></i>
                                            </a>
                                        </div>
                                        <div class="text-end">
                                            @if ($ofertaArticulo->precioOferta)
                                            <h5>
                                                <span class="badge badge-danger-lighten">
                                                    OFERTA
                                                    @if ($ofertaArticulo->precioDescuento)
                                                    {{ $ofertaArticulo->precioDescuento }}%
                                                    @endif
                                                </span>
                                            </h5>
                                            <span class="font-18 text-danger fw-bolder">
                                                {{
                                                \App\Services\FormatoNumeroService::convertirADecimal($ofertaArticulo->precioOferta)
                                                }}
                                                €
                                            </span>
                                            <span class="text-decoration-line-through font-14">
                                                {{
                                                \App\Services\FormatoNumeroService::convertirADecimal($ofertaArticulo->precioTarifa)
                                                }}
                                                €
                                            </span>
                                            @elseif(isset($ofertaArticulo->precioTarifa))
                                            <span class="font-18">
                                                {{
                                                \App\Services\FormatoNumeroService::convertirADecimal($ofertaArticulo->precioTarifa)
                                                }}
                                                €</span>
                                            @else
                                            <span class="font-18"></span>
                                            @endif
                                        </div>
                                    </li>
                                    <li class="list-group-item product-card">
                                        <form method="POST"
                                            action="{{ route('cart.add', ['artcod' => $ofertaArticulo->artcod]) }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col">
                                                    @if ($ofertaArticulo->cajas->isNotEmpty() && config('app.caja')
                                                    ==
                                                    'si')
                                                    <div class="row">
                                                        <div class="quantity-input col">
                                                            <input type="number" class="quantity form-control"
                                                                name="quantity" min="1" value="1">
                                                        </div>
                                                        <div class="col-auto">
                                                            @foreach ($ofertaArticulo->cajas as $index => $caja)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    data-id="$caja->cajartcod"
                                                                    value="{{ $caja->cajcod }}" name="input-tipo"
                                                                    id="caja{{ $index }}" @if($caja->cajdef==
                                                                1)
                                                                checked
                                                                @endif
                                                                >
                                                                <label class="form-check-label" for="caja{{ $index }}">
                                                                    @if ($caja->cajreldir > 0)
                                                                    {{ $caja->cajreldir }}
                                                                    {{ $ofertaArticulo->promedcod }}
                                                                    @endif
                                                                    @if ($caja->cajcod == '0003')
                                                                    (Pieza)
                                                                    @elseif($caja->cajcod == '0002')
                                                                    (Media)
                                                                    @else
                                                                    (Caja)
                                                                    @endif
                                                                </label>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <!-- end product price unidades-->
                                                </div>
                                            </div>
                                            <!-- submit -->
                                            <div class="mt-3">
                                                <div class="row align-items-end ">
                                                    <button type="submit" class="btn btn-primary ms-2 col"
                                                        onclick="$('#alertaStock').toast('show')"><i
                                                            class="mdi mdi-cart me-1"></i>
                                                        Añadir</button>
                                                </div>
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button id="scrollRight" class="scrollRight btn btn-light ">
                    <i class="bi bi-arrow-right-circle font-24 text-primary"></i>
                </button>
            </div>
        </div>
        <div class="tab-pane " id="carrouselOfertas">

            <div class="container">
                <div id="carouselExampleIndicators" class="pb-5 carousel slide" data-bs-ride="carousel">
                    <!-- Indicadores del Carrusel -->
                    <div class="carousel-indicators">
                        @foreach ($ofertas as $index => $image)
                        <button type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide-to="{{ $index }}" class="{{ $loop->first ? 'active' : '' }}"
                            aria-current="{{ $loop->first ? 'true' : 'false' }}"
                            aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>

                    <!-- Elementos del Carrusel -->
                    <div class="carousel-inner">
                        @foreach ($ofertas as $image)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <a
                                href="{{ isset($image->ofcartcod) && $image->ofcartcod ? route('info', ['artcod' => $image->ofcartcod]) : 'javascript:void(0)' }}">
                                <img src="{{ asset('images/ofertas/' . trim($image->ofcima)) }}" class="d-block fill"
                                    alt="banner publicitario" style="width: 100%; height: auto; aspect-ratio: 3/1;">
                            </a>
                        </div>
                        @endforeach
                    </div>

                    <!-- Controles del Carrusel -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
    <!-- fin ofertas -->

</div>

<!-- CARDS DE PRODUCTOS -->

<section class="py-5" id="productos">
    <div class="container">
        @isset($catnom)
        <h3 class="pb-2 text-primary">{{$catnom}}</h3>
        @else
        <h3>Todos los Productos</h3>
        @endisset


        <div class="gap-3 pb-3 d-flex justify-content-end">
            <!-- Ver todos los productos -->
            @isset($catnom)
            <a class="btn btn-primary" href="{{ route('search') }}">
                Ver todos los productos
            </a>
            @endisset

            <!-- ver todas las categorías -->
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#categoriasCollapse"
                aria-expanded="false" aria-controls="categoriasCollapse">
                Categorías
            </button>
            <!-- fin ver todas las categorías -->

            <!-- Botón para controlar el collapse ordenaciones -->
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                data-bs-target="#menuLateralFormulario" aria-expanded="false" aria-controls="menuLateralFormulario">
                Opciones de Ordenación
            </button>

            <!--end Botón para controlar el collapse ordenaciones -->
            <div class="app-search dropdown d-none d-lg-block" style="width: auto;">
                <!-- buscar producto -->
                <form method="GET" action="{{ route('search') }}">
                    <div class="input-group">
                        <input type="search" class="form-control dropdown-toggle" placeholder="Buscar artículos..."
                            id="top-search" name="query">
                        <span class="mdi mdi-magnify search-icon"></span>
                        <button class="input-group-text btn btn-primary" type="submit">Buscar</button>
                    </div>
                </form>
                <!-- end buscar producto -->
            </div>
        </div>

        <!-- Collapse ordenaciones  -->
        <div class="collapse" id="menuLateralFormulario">

            <div class="card card-body">

                <form action="{{ route('filtrarArticulos', ['catnom' => $catnom ?? null]) }}" method="GET"
                    class="container mt-4 ordenacion-formulario">

                    <h3 class="mb-4 text-center">Ordenar Productos</h3>
                    <p class="text-center">Seleccione cómo desea ordenar los productos. Puede combinar múltiples
                        criterios.</p>

                    <!-- Opciones de Ordenación -->
                    <div class="ordenacion-opciones row justify-content-center">

                        <!-- Sección: Ordenar por Nombre -->
                        <div class="mb-3 col-md-4">
                            <p class="font-weight-bold">Ordenar por nombre:</p>
                            <div class="form-check">
                                <input type="checkbox" name="orden_nombre" value="asc" id="orden_nombre_asc"
                                    class="form-check-input checkbox-orden-nombre">
                                <label class="form-check-label" for="orden_nombre_asc">A - Z</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="orden_nombre" value="desc" id="orden_nombre_desc"
                                    class="form-check-input checkbox-orden-nombre">
                                <label class="form-check-label" for="orden_nombre_desc">Z - A</label>
                            </div>

                        </div>

                        <!-- Sección: Ordenar por Precio -->
                        <div class="mb-3 col-md-4">
                            <p class="font-weight-bold">Ordenar por precio:</p>
                            <div class="form-check">
                                <input type="checkbox" name="orden_precio" value="asc" id="orden_precio_asc"
                                    class="form-check-input checkbox-orden-precio" @guest disabled @endguest>
                                <label class="form-check-label" for="orden_precio_asc">Menor a Mayor</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="orden_precio" value="desc" id="orden_precio_desc"
                                    class="form-check-input checkbox-orden-precio" @guest disabled @endguest>
                                <label class="form-check-label" for="orden_precio_desc">Mayor a Menor</label>
                            </div>
                        </div>

                        <!-- Sección: Ofertas Especiales -->
                        <div class="mb-3 text-center col-12">
                            <p class="m-0 align-middle font-weight-bold d-inline-block pe-2">
                                <i class="fas fa-star"></i> Ofertas Especiales:
                            </p>
                            <div class="ml-2 form-check d-inline-block">
                                <input type="checkbox" name="orden_oferta" value="1" id="orden_oferta"
                                    class="form-check-input" @guest disabled @endguest>
                                <label class="form-check-label" for="orden_oferta">Mostrar primero productos en
                                    oferta</label>
                            </div>
                        </div>

                    </div>

                    <!-- Botón de Envío -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Aplicar Ordenación</button>
                    </div>
                </form>

            </div>
        </div>
        <!--end Collapse ordenaciones  -->

        <!-- Collapse categorias  -->
        <div class="collapse" id="categoriasCollapse">
            <div class="p-3 card">
                <x-categorias :categorias="$categorias" />

            </div>
        </div>
        <!--end Collapse categorias  -->

        <div class="p-3 row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
            @if($articulos->isNotEmpty())
            @foreach($articulos as $articulo)
            <div class="col">

                <div class="border shadow-lg card h-100 border-primary rounded-3 position-relative">

                    <!-- Ícono de la corazon -->
                    @if(in_array($articulo->artcod, $favoritos))
                    <i onclick="heart(this)" data-artcod="{{$articulo->artcod}}"
                        class="top-0 m-2 cursor-pointer bi bi-suit-heart-fill red-heart position-absolute end-0 font-20 heartIcon"></i>
                    @else
                    <i onclick="heart(this)" data-artcod="{{$articulo->artcod}}"
                        class="top-0 m-2 cursor-pointer bi bi-suit-heart position-absolute end-0 font-20 heartIcon"></i>
                    @endif

                    <figure class="m-0 overflow-hidden bg-white d-flex align-items-center justify-content-center"
                        style="height:325px;">
                        <a href="{{route('info', ['artcod' => $articulo->artcod])}}" class="d-block">
                            @if($articulo->imagenes->isNotEmpty())
                            <img src="{{ asset('images/articulos/' . $articulo->imagenes->first()->imanom) }}"
                                class="h-auto d-block w-100" alt="{{ $articulo->artnom }}"
                                title="{{ $articulo->artnom }}"
                                onerror="this.onerror=null; this.src='{{ asset('images/articulos/noimage.jpg') }}';">
                            @else
                            <img src="{{ asset('images/articulos/noimage.jpg') }}" class="h-auto d-block w-100"
                                alt="no hay imagen" title="No hay imagen">
                            @endif

                        </a>
                    </figure>

                    <div class="pb-0 bg-white card-body">
                        <a href="{{route('info', ['artcod' => $articulo->artcod])}}">
                            <h5 class="m-0 card-title text-primary">{{ $articulo->artnom }}</h5>
                            @isset($articulo->artobs)<p class="card-text l3truncate">{{$articulo->artobs}}</p>@endisset
                        </a>

                    </div>

                    <div class="pt-0 card-footer">

                        <ul class="list-group list-group-flush">

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <a class="pe-2" href="{{route('info', ['artcod' => $articulo->artcod])}}"
                                        data-toggle="fullscreen" title="Stock disponible o no">
                                        @if($articulo->artstocon == 1 || $articulo->artstock > 1)
                                        <i class="mdi mdi-archive-check font-24 text-success"></i>
                                        @else
                                        <i class="mdi mdi-archive-cancel font-24 text-danger"></i>
                                        @endif
                                    </a>
                                    <a class="pe-2" href="{{ asset('images/' . $articulo->artdocaso) }}"
                                        data-toggle="fullscreen" title="Ficha técnica">
                                        <i class="uil-clipboard-alt font-24"></i>
                                    </a>
                                    <a class="pe-2" href="{{route('info', ['artcod' => $articulo->artcod])}}"
                                        data-toggle="fullscreen" title="Información">
                                        <i class="mdi mdi-information-outline font-24"></i>
                                    </a>
                                </div>

                                <div class="text-end">
                                    @if ($articulo->precioOferta)
                                    <h5>
                                        <span class="badge badge-danger-lighten">
                                            OFERTA
                                            @if($articulo->precioDescuento)
                                            {{$articulo->precioDescuento}}%
                                            @endif
                                        </span>
                                    </h5>
                                    <span class="font-18 text-danger fw-bolder">
                                        {{
                                        \App\Services\FormatoNumeroService::convertirADecimal($articulo->precioOferta)
                                        }}
                                        €
                                    </span>
                                    <span class="text-decoration-line-through font-14">
                                        {{
                                        \App\Services\FormatoNumeroService::convertirADecimal($articulo->precioTarifa)
                                        }}
                                        €
                                    </span>
                                    @elseif(isset($articulo->precioTarifa))
                                    <span class="font-18">
                                        {{
                                        \App\Services\FormatoNumeroService::convertirADecimal($articulo->precioTarifa)
                                        }}
                                        €</span>
                                    @else
                                    <span class="font-18"></span>
                                    @endif
                                </div>
                            </li>


                            <li class="list-group-item product-card">
                                <form method="POST" action="{{ route('cart.add', ['artcod' => $articulo->artcod]) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            @if($articulo->cajas->isNotEmpty() && config('app.caja') == 'si')
                                            <div class="row">
                                                <div class="quantity-input col">
                                                    <input type="number" class="quantity form-control" name="quantity"
                                                        min="1" value="1">
                                                </div>
                                                <div class="col-auto">
                                                    @foreach($articulo->cajas as $index => $caja)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            data-id="$caja->cajartcod" value="{{ $caja->cajcod }}"
                                                            name="input-tipo" id="caja{{ $index }}" @if($caja->cajdef ==
                                                        1)
                                                        checked
                                                        @endif
                                                        >
                                                        <label class="form-check-label" for="caja{{ $index }}">
                                                            @if($caja->cajreldir > 0)
                                                            {{ $caja->cajreldir }} {{ $articulo->promedcod }}
                                                            @endif
                                                            @if($caja->cajcod == "0003")
                                                            (Pieza)
                                                            @elseif($caja->cajcod == "0002")
                                                            (Media)
                                                            @else
                                                            (Caja)
                                                            @endif

                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endif
                                            <!-- end product price unidades-->
                                        </div>
                                    </div>

                                    <!-- submit -->
                                    <div class="mt-3">
                                        <div class="row align-items-end ">
                                            <button type="submit" class="btn btn-primary ms-2 col"
                                                onclick="$('#alertaStock').toast('show')"><i
                                                    class="mdi mdi-cart me-1"></i> Añadir</button>
                                        </div>
                                    </div>
                                </form>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach


            @else
            <div class="container text-center alert alert-primary" role="alert">
                <i class="align-middle ri-information-line me-1 font-22"></i>
                <strong>Actualmente no disponemos de artículos en esta categoría</strong>
            </div>


            @endif
        </div>
        {{ $articulos->links('vendor.pagination.bootstrap-5') }}
    </div>
</section>

<!-- FIN CARDS DE PRODUCTOS -->
@endsection


@push('scripts')
<script src="{{ asset('js/checkbox.js') }}"></script>
<script src="{{ asset('js/scrollbar.js') }}"></script>
<script src="{{ asset('js/Ajax/favorites.js') }}"></script>
@endpush