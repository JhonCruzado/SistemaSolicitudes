<main class="content-body">
    <div class="d-flex justify-content-between mb-2">
        <h2 class="content-header-title float-start mb-0 text-dark">Usuarios</h2>
        <button type="button" class="btn btn-primary" wire:click="$set('_create', true)">
            <i class="far fa-plus"></i>&nbsp;&nbsp;Agregar
        </button>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card box-shadow">
                <div class="card-body">
                    <h6 class="mb-1">Filtros</h6>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text" id="basic-addon-search2">
                            <i class="far fa-search"></i>
                        </span>
                        <input wire:model="search" type="text" class="form-control" placeholder="Buscar..."
                            aria-label="Buscar..." aria-describedby="basic-addon-search2" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Accordion start -->
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive bg-white table-shadow">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nombres</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $u)
                            <tr>
                                <td width="30%">{{ $u->nombre }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->roles->rol }}</td>
                                <td class="text-center">
                                    @if ($u->estado == 'Habilitado')
                                        <span class="badge rounded-pill badge-light-success">{{ $u->estado }}</span>
                                    @else
                                        <span class="badge rounded-pill badge-light-danger">{{ $u->estado }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button"
                                        class="btn btn-icon btn-icon rounded-circle btn-flat-success title-edit"
                                        wire:click="edit({{ $u->id }})" wire:loading.attr="disabled">
                                        <i class="far fa-pen"></i>
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
                        {{ $usuarios->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Accordion end -->
    @if ($_create)
        @include('livewire.usuarios.create')
    @endif
    @if ($_edit)
        @include('livewire.usuarios.edit')
    @endif

    @push('js')
        <script>
            var isRtl = $('html').attr('data-textdirection') === 'rtl'
            const url = 'usuarios';

            /****** Start events for Categoria *****/

            Livewire.on('confirmUpdate', id => {
                Swal.fire(
                    alertBody("El usuario será actualizado.", 'btn-primary')
                ).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo(url, 'update', id);
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
