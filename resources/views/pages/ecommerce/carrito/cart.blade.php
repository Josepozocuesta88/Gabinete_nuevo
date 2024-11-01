<!-- ======================================================================================= -->
<!-- CLIENTE o TODOS: Carrito de compra -->
<!-- ======================================================================================= -->

@extends('layouts.app')

@section('content')
<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="m-0 breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('search') }}">Productos</a></li>
                            <li class="breadcrumb-item active">Carrito de Compras</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Carrito de Compras</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                {{-- @if (session('success') || session('error'))
                <div aria-live="polite" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
                    <div class="toast show bg-primary" data-bs-delay="5000">
                        <div class="toast-header">
                            <strong class="mr-auto text-primary">Alerta</strong>
                            <button type="button" class="m-auto btn-close me-2" data-bs-dismiss="toast" aria-label="Cerrar"></button>
                        </div>
                        <div class="text-white toast-body">
                            {{ session('success') ?? session('error') }}
            </div>
        </div>
    </div>
    @endif --}}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-9">
                    @if (isset($message))
                    <div class="alert alert-dark" role="alert">
                        <h5>{{ $message }}</h5>
                    </div>
                    @else
                    <div class="table-responsive" data-simplebar data-simplebar-primary>
                        <table class="table mb-0 table-borderless table-nowrap table-centered">
                            <thead class="table-light">
                                <tr>
                                    <th>Producto</th>
                                    @if (config('app.caja') == 'si')
                                    <th class="px-0">Bulto</th>
                                    <th>Tipo</th>
                                    @endif
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                <tr>
                                    <!-- producto -->
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if ($item['image'])
                                            <img src="{{ asset('images/articulos/' . $item['image']) }}" alt="img" class="rounded me-2 tw-h-12" height="48" />
                                            @else
                                            <img src="{{ asset('images/articulos/noimage.jpg') }}" alt="img" class="rounded me-2 tw-h-12" height="48" />
                                            @endif
                                            <p class="m-0 align-middle d-inline-block text-truncate" style="max-width: 150px;">
                                                <a href="{{ route('info', ['artcod' => $item['artcod']]) }}" class="text-body fw-semibold">{{ $item['name'] }}</a>
                                                <br>
                                                <small>{{ $item['cantidad_unidades'] }} x {{ $item['price'] }}</small>
                                            </p>
                                        </div>
                                    </td>
                                    <!-- bulto -->
                                    <td class="px-0">
                                        <!-- Campo para la cantidad de cajas -->
                                        <div class="">
                                            <input type="number" class="quantity-update box_quantity form-control" name="box_quantity" min="1" data-cartcod="{{ $item['cartcod'] }}" data-update-type="" value="{{ $item['cantidad_cajas'] }}" style="width: 80px;">
                                        </div>
                                    </td>
                                    @if (config('app.caja') == 'si')
                                    <!-- tipo -->
                                    <td>
                                        <select class="tipoCajaSelect form-select" data-cartcod="{{ $item['cartcod'] }}" data-artcod="{{ $item['artcod'] }}" data-cajcod="{{ $item['cajcod'] }}" data-cartcant="{{ $item['cantidad_cajas'] }}"></select>
                                    </td>
                                    <!-- cantidad ud -->
                                    <td class="pe-0">
                                        <div class="d-flex align-items-center justify-content-start">
                                            <input type="number" class="form-control me-1" disabled data-cartcod="{{ $item['cartcod'] }}" name="ud_quantity" min="1" value="{{ $item['cantidad_unidades'] }}" style="width:90px;">
                                            <label for="unit-quantity-input" class="mb-0 quantity-update">{{ $item['promedcod'] }}</label>
                                        </div>
                                    </td>
                                    @endif
                                    <!-- precio -->
                                    <td>
                                        {{ \App\Services\FormatoNumeroService::convertirADecimal($item['price'])  }}
                                        €
                                        @if ($item['isOnOffer'])
                                        <small class="text-decoration-line-through">{{ \App\Services\FormatoNumeroService::convertirADecimal($item['tarifa']) }} €</small>
                                        @endif
                                    </td>
                                    <!-- total -->
                                    <td>
                                        {{ \App\Services\FormatoNumeroService::convertirADecimal($item['total'])  }}
                                        €
                                    </td>
                                    <td>
                                        <form method="POST" id="removeItem" action="{{ route('cart.removeItem', ['artcod' => $item['artcod']]) }}">
                                            @csrf
                                            <input type="hidden" name="artcod" value="{{ $item['artcod'] }}">
                                            <button type="submit" class="remove-item action-icon btn btn-white">
                                                <i class="mdi mdi-delete text-primary font-22"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive-->
                    <!-- direcciones en forma de  -->
                    <!-- direcciones en forma de tarjeta -->
                    <div class="mt-5">
                        <div class="mb-3 h4">Selecciona los datos de envío</div>
                        <div id="direcciones" class="row">
                            @foreach ($direcciones as $direccion)
                            <div class="mb-1 col-11 col-md-5 col-lg-4">
                                <div class="card direccion-card {{ $loop->first ? 'selected' : '' }}" data-direccion-id="{{ $direccion->dirid }}">
                                    <div class="card-body">
                                        <p class="card-text">
                                            <strong>Nombre:</strong>
                                            {{ $direccion->dirnom }}<br>
                                            <strong>Apellidos:</strong>
                                            {{ $direccion->dirape }}<br>
                                            <strong>Dirección:</strong>
                                            {{ $direccion->dirdir }}<br>
                                            <strong>Población:</strong>
                                            {{ $direccion->dirpob }}<br>
                                            <strong>País:</strong>
                                            {{ $direccion->dirpai }}<br>
                                            <strong>Código Postal:</strong>
                                            {{ $direccion->dircp }}<br>
                                            <strong>Teléfono:</strong>
                                            {{ $direccion->dirtfno1 }}<br>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Add note input-->
                    <div class="mt-3">
                        <label for="comentario" class="form-label">Añadir un comentario:</label>
                        <textarea class="form-control" id="comentario" rows="3" placeholder="Este campo es opcional, puedes escribir algún comentario si lo deseas..">{{ session('comentario') }}</textarea>
                    </div>
                    <!-- action buttons-->
                    <div class="mt-4 row">
                        <div class="col-sm-12">
                            <div class="text-sm-end">
                                <a onclick="window.location.href='/articles/search?query=';" class="btn btn-info">
                                    <i class="mdi mdi-arrow-left"></i> Continuar comprando
                                </a>
                                <button class="btn btn-danger" id="procesarPedido">
                                    <i class="mdi mdi-cart-plus me-1"></i> Procesar el pedido
                                </button>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row-->
                </div>
                <div class="mt-4 col-lg-12 col-xl-3 mt-xl-0">
                    <div class="p-3 border rounded">
                        <h4 class="mb-3 header-title">Detalles del pedido</h4>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td>Subtotal :</td>
                                        <td class="ps-0">
                                            {{ \App\Services\FormatoNumeroService::convertirADecimal($subtotal) }}
                                            €
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Descuento: </td>
                                        @if($user->usudes1 !== 0)
                                        <td class="ps-0"> {{ $user->usudes1 }} % </td>
                                        @else
                                        <td class="ps-0"> 0 %</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Gastos de envío :</td>
                                        <td class="ps-0">
                                            {{ \App\Services\FormatoNumeroService::convertirADecimal($shippingCost) }}
                                            €
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total IVA :</td>
                                        <td class="ps-0">
                                            {{ \App\Services\FormatoNumeroService::convertirADecimal($artivapor) }}
                                            €
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Recargo :</td>
                                        <td class="ps-0">
                                            {{ \App\Services\FormatoNumeroService::convertirADecimal($artrecpor) }}
                                            €
                                        </td>
                                    </tr>
                                    @if ($artsigimp > 0)
                                    <tr>
                                        <td>Impuesto eliminación de residuos :</td>
                                        <td class="ps-0">
                                            {{ \App\Services\FormatoNumeroService::convertirADecimal($artsigimp) }}
                                            €
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>Total:</th>
                                        <th class="ps-0">
                                            {{ \App\Services\FormatoNumeroService::convertirADecimal($total) }}
                                            €
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                    <div class="mt-3 alert alert-warning" role="alert">
                        ¡ Usa tus <strong>{{ config('app.points') }}</strong> para tener el x% de descuento!
                    </div>
                    <div class="mt-3 input-group">
                        <input type="text" class="form-control" placeholder="Inserta el código de cupón" aria-label="Recipient's username">
                        <button class="input-group-text btn-light" type="button">Aplicar</button>
                    </div>
                    <div class="gap-2 mt-3 d-grid">
                        <a href="{{ route('all.points') }}" class="btn btn-warning text-body fw-bold">
                            <i class="bi bi-coin me-1"></i> Ver mis cupones
                        </a>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end card-body-->
</div> <!-- end card-->
</div> <!-- end col -->
</div>
<!-- end row -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.direccion-card');
        cards.forEach(card => {
            card.addEventListener('click', function() {
                cards.forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
            });
        });
    });

    document.getElementById('procesarPedido').addEventListener('click', function(event) {
        event.preventDefault();
        const selectedCard = document.querySelector('.direccion-card.selected');
        if (!selectedCard) {
            showToast('Por favor, selecciona una dirección de envío.');
            return;
        }
        const direccionId = selectedCard.getAttribute('data-direccion-id');
        const comentario = document.getElementById('comentario').value; // Obtener el comentario
        const formData = new FormData(); // Crear un objeto FormData
        formData.append('direccionId', direccionId); // Agregar el ID de dirección
        formData.append('comentario', comentario); // Agregar el comentario

        fetch('/order', { // Cambiar a una petición POST
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Incluir el token CSRF
                }
            })
            .then(response => {
                console.log(response)
                if (response.ok) {
                    window.location.href = `/order/ok`; // Redirigir si la respuesta es correcta
                } else {
                    showToast('Error al procesar el pedido.'); // Manejar error
                }
            });
    });

    function showToast(message) {
        const toastContainer = document.createElement('div');
        toastContainer.setAttribute('aria-live', 'polite');
        toastContainer.setAttribute('aria-atomic', 'true');
        toastContainer.style.position = 'fixed';
        toastContainer.style.top = '20px';
        toastContainer.style.right = '20px';
        toastContainer.style.zIndex = '1050';

        const toast = document.createElement('div');
        toast.classList.add('toast', 'show', 'bg-primary');
        toast.setAttribute('data-bs-delay', '5000');

        const toastHeader = document.createElement('div');
        toastHeader.classList.add('toast-header');

        const strong = document.createElement('strong');
        strong.classList.add('mr-auto', 'text-primary');
        strong.innerText = 'Alerta';

        const button = document.createElement('button');
        button.type = 'button';
        button.classList.add('btn-close', 'me-2', 'm-auto');
        button.setAttribute('data-bs-dismiss', 'toast');
        button.setAttribute('aria-label', 'Cerrar');

        const toastBody = document.createElement('div');
        toastBody.classList.add('toast-body', 'text-white');
        toastBody.innerText = message;

        toastHeader.appendChild(strong);
        toastHeader.appendChild(button);
        toast.appendChild(toastHeader);
        toast.appendChild(toastBody);
        toastContainer.appendChild(toast);

        document.body.appendChild(toastContainer);

        setTimeout(() => {
            toast.classList.remove('show');
            document.body.removeChild(toastContainer);
        }, 5000);
    }
</script>

<style>
    .direccion-card.selected {
        border: 2px solid #007bff;
    }
</style>
</div> <!-- container -->
@endsection