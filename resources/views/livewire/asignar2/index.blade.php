<main class="content-body">
    <div class="d-flex justify-content-between mb-2">
        <h2 class="content-header-title float-start mb-0 text-dark">Asignar Jefes de Areas</h2>
        @if ($cantAsignada == 7)
            <button type="button" class="btn btn-primary" wire:click="$set('_create', true)" disabled>
                <i class="far fa-plus"></i>&nbsp;&nbsp;Asignar
            </button>
        @else
            <button type="button" class="btn btn-primary" wire:click="$set('_create', true)">
                <i class="far fa-plus"></i>&nbsp;&nbsp;Asignar
            </button>
        @endif
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
                                <input wire:model="search" type="text" class="form-control"
                                    placeholder="Buscar..." aria-label="Buscar..."
                                    aria-describedby="basic-addon-search2" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-sm-12">
            <div class="card box-shadow">
                <div class="card-body">
                    <h6 class="mb-1">Filtros</h6>
                    <div class="row">
                        <div class="col-lg">
                            <select wire:model="cargo" class="form-select">
                                <option value="">--- Colaboradores ---</option>
                                @foreach ($colaboradores2 as $c)
                                    <option value="{{ $c->id_colaborador }}">{{$c->nombres}} - {{$c->cargos->cargo}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg">
                            <select wire:model="cargo" class="form-select">
                                <option value="">--- Departamentos ---</option>
                                @foreach ($departamento as $d)
                                    <option value="{{ $d->id_departamento }}">{{ $d->departamento }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Accordion start -->
    <div class="row">
        <div class="col-sm-12 mb-3">
            <div class="table-responsive bg-white table-shadow">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Jefe Asignado</th>
                            <th>Area</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($colArea as $c)
                            <tr>
                                <td>{{ $c->colaboradores->nombres }}</td>
                                <td>{{ $c->areas->area }}</td>
                                <td>{{ $c->estado }}</td>
                                <td class="text-center">
                                    {{-- <button type="button"
                                        class="btn btn-icon btn-icon rounded-circle btn-flat-success title-edit"
                                        wire:click="edit({{ $c->id_colaborador }})" wire:loading.attr="disabled">
                                        <i class="far fa-pen"></i>
                                    </button> --}}
                                    <button type="button"
                                        class="btn btn-icon btn-icon rounded-circle btn-flat-danger title-delete"
                                        wire:click="$emit('confirmDelete',{{ $c->id_col_area }})"
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
                        {{ $colArea->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Accordion end -->
    @if ($_create)
        @include('livewire.asignar2.create')
    @endif
    @if ($_edit)
        @include('livewire.asignar2.edit')
    @endif

    @push('js')
        <script>
            var isRtl = $('html').attr('data-textdirection') === 'rtl'
            const url = 'asignar-colaboradores2';

            /****** Start events for Categoria *****/

            Livewire.on('confirmUpdate', id => {
                Swal.fire(
                    alertBody("El jefe asignado será actualizado.", 'btn-primary')
                ).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo(url, 'update', id);
                    }
                })
            });

            Livewire.on('confirmDelete', id => {
                Swal.fire(
                    alertBody("El jefe asignado será eliminado.", 'btn-danger')
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

            Livewire.on('alertWarning', msj => {
                toastr['warning'](`${msj}`, 'Progress Bar', {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true,
                    rtl: isRtl
                });
            })

            window.addEventListener('alertWarning', event => {
                toastr['warning'](`${event.detail.text}`, `${event.detail.title}`, {
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
