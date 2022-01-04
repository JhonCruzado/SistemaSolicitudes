<main class="content-body">
    <div class="d-flex justify-content-between mb-2">
        <h2 class="content-header-title float-start mb-0 text-dark">Productos</h2>
        <button type="button" class="btn btn-primary" wire:click="$set('_create', true)">
            <i class="far fa-plus"></i>&nbsp;&nbsp;Agregar
        </button>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card box-shadow">
                <div class="card-body">
                    <h6 class="mb-1">Filtros</h6>
                    <div class="row">
                        <div class="col-lg">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-search2">
                                    <i class="far fa-search"></i>
                                </span>
                                <input wire:model="search" type="text" class="form-control" placeholder="Buscar..."
                                    aria-label="Buscar..." aria-describedby="basic-addon-search2" />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <select wire:model="categoria" class="form-select">
                                <option value="">--- Categorias ---</option>
                                @foreach ($categorias as $c)
                                    <option value="{{ $c->id_categoria }}">{{ $c->categoria }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <select wire:model="subcategoria" class="form-select">
                                <option value="">--- Subcategorias ---</option>
                                @foreach ($subcategorias as $s)
                                    <option value="{{ $s->id_subcategoria }}">{{ $s->subcategoria }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 mb-3">
            <div class="table-responsive bg-white box-shadow">
                <table class="table table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th>SKU</th>
                            <th>foto</th>
                            <th>Producto</th>
                            <th>Medida</th>
                            <th>Stock</th>
                            <th>P. compra</th>
                            <th>P. venta</th>
                            <th>Perecible</th>
                            <th>Categoria</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $p)
                            <tr>
                                <td>{{ $p->id_producto }}</td>
                                <td>
                                    <img src="{{ asset("storage/$p->foto") }}" alt="{{ $p->producto }}"
                                        class="tab-foto">
                                </td>
                                <td width="25%">{{ $p->producto }}</td>
                                <td>{{ $p->medidas->medida }}</td>
                                <td>{{ $p->stock }}</td>
                                <td>{{ number_format($p->precio_compra, 2) }}</td>
                                <td>{{ number_format($p->precio_venta, 2) }}</td>
                                <td>{{ $p->vence }}</td>
                                <td width="15%">
                                    {{ $p->categoria }}{{ $p->subcategoria ? ', ' . $p->subcategoria : '' }}
                                </td>
                                <td width="5%" class="text-center">
                                    @if ($p->estado == 'Habilitado')
                                        <span class="badge rounded-pill badge-light-success">{{ $p->estado }}</span>
                                    @else
                                        <span class="badge rounded-pill badge-light-danger">{{ $p->estado }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button"
                                        class="btn btn-icon btn-icon rounded-circle btn-flat-success title-edit"
                                        wire:click="edit({{ $p->id_producto }})" wire:loading.attr="disabled">
                                        <i class="far fa-pen"></i>
                                    </button>
                                    <button type="button"
                                        class="btn btn-icon btn-icon rounded-circle btn-flat-danger title-delete"
                                        wire:click="$emit('confirmDelete',{{ $p->id_producto }})"
                                        wire:loading.attr="disabled">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex px-1 align-items-center">
                    <div class="col-lg-1">
                        <div class="mb-1">
                            <label class="form-label" for="basicSelect">Mostrar</label>
                            <select wire:model="paginate" class="form-select form-select-sm" id="basicSelect">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg">
                        {{ $productos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($_create)
        @include('livewire.adm-productos.create')
    @endif
    @if ($_edit)
        @include('livewire.adm-productos.edit')
    @endif

    @push('js')
        <script>
            var isRtl = $('html').attr('data-textdirection') === 'rtl'
            const url = 'adm-productos';

            /****** Start events for Categoria *****/

            Livewire.on('confirmUpdate', id => {
                Swal.fire(
                    alertBody("El producto será actualizado.", 'btn-primary')
                ).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo(url, 'update', id);
                    }
                })
            });

            Livewire.on('confirmDelete', id => {
                Swal.fire(
                    alertBody("El producto será eliminado.", 'btn-danger')
                ).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo(url, 'delete', id);
                    }
                })
            });

            Livewire.on('alertSuccess', msj => {
                toastr['success'](`${msj}`, 'Progress Bar', {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true,
                    rtl: isRtl
                });
            })

            window.addEventListener('alertSuccess', event => {
                toastr['success'](`${event.detail.text}`, `${event.detail.title}`, {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true,
                    rtl: isRtl
                });
            })

            /****** End events for Tipo *****/

            function alertBody(texto, button) {
                let body = {
                    title: '¿Estás seguro?',
                    text: texto,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn round me-1 ' + button + '',
                        cancelButton: 'btn round btn-secondary',
                    }
                }
                return body;
            }
        </script>
    @endpush
</main>
