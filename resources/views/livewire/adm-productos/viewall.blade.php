<main>
    <div class="content-detached content-right pb-1">
        <div class="content-body">
            <!-- E-commerce Content Section Starts -->
            <section id="ecommerce-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ecommerce-header-items">
                            <div class="result-toggler">
                                <button class="navbar-toggler shop-sidebar-toggler" type="button"
                                    data-bs-toggle="collapse">
                                    <span class="navbar-toggler-icon d-block d-lg-none"><i
                                            data-feather="menu"></i></span>
                                </button>
                                <div class="search-results">{{ $productos->count() . ' de ' . $total }} de productos
                                </div>
                            </div>
                            <div class="view-options d-flex">
                                <div class="btn-group" role="group">
                                    <input type="radio" class="btn-check" name="radio_options" id="radio_option2"
                                        autocomplete="off" checked />
                                    <label class="btn btn-icon btn-outline-primary view-btn list-view-btn"
                                        for="radio_option2"><i class="fas fa-th-large"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- E-commerce Content Section Starts -->

            <!-- background Overlay when sidebar is shown  starts-->
            <div class="body-content-overlay"></div>
            <!-- background Overlay when sidebar is shown  ends-->

            <!-- E-commerce Search Bar Starts -->
            <section id="ecommerce-searchbar" class="ecommerce-searchbar">
                <div class="row mt-1">
                    <div class="col-sm-12">
                        <div class="input-group input-group-merge">
                            <input wire:model="search" type="text" class="form-control search-product" id="shop-search"
                                placeholder="Buscar Producto" aria-label="Search..." aria-describedby="shop-search" />
                            <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                        </div>
                    </div>
                </div>
            </section>
            <!-- E-commerce Search Bar Ends -->

            <!-- E-commerce Products Starts -->
            <section id="ecommerce-products" class="grid-view">
                @if (count($productos))
                @foreach ($productos as $p)
                    <div class="card ecommerce-card shadow">
                        <div class="item-img text-center justify-content-center">
                            <a href="javascript:void(0);">
                                <img class="img-fluid card-img-top" src="{{ asset('storage/' . $p->foto) }}"
                                    alt="img-placeholder" title="{{ $p->producto }}"/></a>
                        </div>
                        <div class="card-body">
                            <div class="item-wrapper">
                                <div class="item-rating">
                                    <ul class="unstyled-list list-inline d-none">
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <h6 class="item-price">{{ 'S/' . number_format($p->precio_venta, 2) }}</h6>
                                </div>
                            </div>
                            <h6 class="item-name mb-1">
                                <a class="text-body" href="javascript:void(0);">{{ $p->producto }}</a>
                            </h6>
                            <div class="item-wrapper">
                                <div class="row flex-column">
                                    <div class="col-lg">
                                        <i class="fad fa-box"></i>
                                        <b>&nbsp;Stock:&nbsp;</b>{{ $p->stock }}
                                    </div>
                                    <div class="col-lg">
                                        <i class="fad fa-ruler"></i>
                                        <b>&nbsp;Medida:&nbsp;</b>{{ $p->medidas->medida }}
                                    </div>
                                    <div class="col-lg">
                                        <i class="fad fa-calendar-alt"></i>
                                        <b>&nbsp;Vencimiento:&nbsp;</b>
                                        {{ $p->fecha_vence ? date('d/m/Y', strtotime($p->fecha_vence)) : 'No vence' }}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="item-options text-center">
                            <div class="item-wrapper">
                                <div class="item-cost">
                                    <h4 class="item-price">{{ 'S/' . number_format($p->precio_venta, 2) }}</h4>
                                </div>
                            </div>
                            <a href="#" class="btn btn-light btn-wishlist" style="cursor: default">
                                <i class="fas fa-barcode"></i>
                                <span>{{ $p->id_producto }}</span>
                            </a>
                            <a href="#" class="btn btn-primary btn-cart btn-copy" aria-label="{{ $p->id_producto }}">
                                <i class="far fa-copy"></i>
                                <span class="add-to-cart">Copiar SKU</span>
                            </a>
                        </div>
                    </div>
                @endforeach
                @else
                    <span>No hay productos</span>
                @endif
            </section>
            <!-- E-commerce Products Ends -->

            <!-- E-commerce Pagination Starts -->
            <section class="d-flex justify-content-center">
                {{ $productos->links() }}
            </section>
            <!-- E-commerce Pagination Ends -->
        </div>
    </div>
    <div class="sidebar-detached sidebar-left">
        <div class="sidebar">
            <!-- Ecommerce Sidebar Starts -->
            <div class="sidebar-shop">
                <div class="row">
                    <div class="col-sm-12">
                        <h6 class="filter-heading d-none d-lg-block">Filtros</h6>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <!-- Categories Starts -->
                        <div id="product-categories">
                            <h6 class="filter-title mt-0">Categorias</h6>
                            <ul class="list-unstyled categories-list">
                                <li>
                                    <div class="form-check p-0">
                                        <input wire:model="categoria" type="radio" id="category" name="category"
                                            class="" value="" checked />
                                        <label class="form-check-label" for="category">Todo</label>
                                    </div>
                                </li>
                                @foreach ($categorias as $c)
                                    <li>
                                        <div class="form-check p-0">
                                            <input wire:model="categoria" type="radio"
                                                id="category{{ $c->categoria_id }}" name="category"
                                                class="" value="{{ $c->categoria_id }}" />
                                            <label class="form-check-label" for="category{{ $c->categoria_id }}">
                                                {{ $c->categorias->categoria }}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Categories Ends -->

                        <!-- Brands starts -->
                        <div class="brands">
                            <h6 class="filter-title">Subcategorias</h6>
                            <ul class="list-unstyled brand-list">
                                <li>
                                    <div class="form-check p-0">
                                        <input wire:model="subcategoria" type="radio" id="sub" name="subcategory"
                                            class="" value="" checked />
                                        <label class="   form-check-label" for="sub">Todo</label>
                                    </div>
                                </li>
                                @foreach ($subcategorias as $s)
                                    <li>
                                        <div class="form-check p-0">
                                            <input wire:model="subcategoria" type="radio"
                                                id="sub{{ $s->id_subcategoria }}" name="subcategory"
                                                class="" value="{{ $s->id_subcategoria }}" />
                                            <label class="form-check-label" for="sub{{ $s->id_subcategoria }}">
                                                {{ $s->subcategoria }}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Brand ends -->

                        <!-- Clear Filters Starts -->
                        <div id="clear-filters">
                            <button wire:click="limpiar" type="button" class="btn w-100 btn-primary">Limpiar
                                filtros</button>
                        </div>
                        <!-- Clear Filters Ends -->
                    </div>
                </div>
            </div>
            <!-- Ecommerce Sidebar Ends -->
        </div>
    </div>
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('rs/vendors/css/extensions/nouislider.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('rs/css/pages/dashboard-ecommerce.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('rs/css/pages/app-ecommerce.css') }}">
    @endpush
    @push('scripts')
        <script src="{{ asset('rs/vendors/js/extensions/wNumb.min.js') }}"></script>
        <script src="{{ asset('rs/vendors/js/extensions/nouislider.min.js') }}"></script>
        <script src="{{ asset('rs/js/scripts/pages/app-ecommerce.js') }}"></script>
    @endpush
    @push('js')
        <script>
            var isRtl = $('html').attr('data-textdirection') === 'rtl';

            function copyToClipboard(value) {
                var tempInput = document.createElement('input');
                tempInput.value = value;
                document.body.appendChild(tempInput);
                tempInput.select();
                toastr['success'](tempInput.value.split("'")[1], 'SKU copiado! 📋', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                });
                document.execCommand('copy');
                document.body.removeChild(tempInput);
            }
            $(document).on('click', '.btn-copy', function(e) {
                code = e.currentTarget.ariaLabel;
                copyToClipboard(code);
            });
        </script>
    @endpush
</main>
