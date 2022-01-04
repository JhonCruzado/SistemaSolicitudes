<x-modal class="modal-lg">
    <div class="modal-header">
        <h6 class="modal-title m-title" id="myModalLabel33">
            <b class="text-wprimary">Editar</b> - Producto
        </h6>
    </div>
    <form class="needs-validation" novalidate>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-3">
                    <div class="d-flex align-items-center flex-column gap-1">
                        <h6>
                            <i class="fas fa-camera"></i>&nbsp;&nbsp;Foto del producto
                        </h6>
                        <div class="col-lg">
                            <div class="d-flex align-items-center">
                                @if ($foto !== $oldFoto)
                                    @if ($foto)
                                        <img src="{{ $foto->temporaryUrl() }}" class="image-preview">
                                    @endif
                                @else
                                    <img src="{{ asset("storage/$oldFoto") }}" class="image-preview">
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-primary round btn-file mb-1" type="button">
                            <span><i class="far fa-arrow-alt-from-bottom"></i>&nbsp;&nbsp;Subir</span>
                            <input type="file" id="formFile" wire:model="foto">
                        </button>
                        @error('foto') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-lg">
                    <h6>
                        <i class="fas fa-box"></i>&nbsp;&nbsp;Información del producto
                    </h6>
                    <div class="row">
                        <div class="col-lg mb-1">
                            <label class="form-label">Nombre</label>
                            <input wire:model.defer="producto" type="text"
                                class="form-control @error('producto') is-invalid @enderror" required />
                            @error('producto')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-1">
                            <label class="form-label">Medida</label>
                            <select wire:model.defer="medida_id"
                                class="form-select @error('medida_id') is-invalid @enderror" required>
                                <option value="">--- Seleccionar ---</option>
                                @foreach ($medidas as $m)
                                    <option value="{{ $m->id }}">{{ $m->medida }}</option>
                                @endforeach
                            </select>
                            @error('medida_id')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-1">
                            <label class="form-label">Ubicación</label>
                            <input wire:model.defer="ubicacion" type="text"
                                class="form-control @error('ubicacion') is-invalid @enderror" required />
                            @error('ubicacion')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg col-md mb-1">
                            <label class="form-label">Stock</label>
                            <input wire:model.defer="stock" type="number"
                                class="form-control @error('stock') is-invalid @enderror" placeholder="00.00"
                                required />
                            @error('stock')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg col-md mb-1">
                            <label class="form-label">Stock minímo</label>
                            <input wire:model.defer="stock_minimo" type="number"
                                class="form-control @error('stock_minimo') is-invalid @enderror" placeholder="00.00"
                                required />
                            @error('stock_minimo')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg col-md mb-1">
                            <label class="form-label">Precio compra</label>
                            <input wire:model.defer="precio_compra" type="number"
                                class="form-control @error('precio_compra') is-invalid @enderror" placeholder="00.00"
                                required />
                            @error('precio_compra')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg col-md mb-1">
                            <label class="form-label">Precio venta</label>
                            <input wire:model.defer="precio_venta" type="number"
                                class="form-control @error('precio_venta') is-invalid @enderror" placeholder="00.00"
                                required />
                            @error('precio_venta')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg col-md mb-1">
                            <label class="form-label">Categoria</label>
                            <select wire:model="categoria_id"
                                class="form-select @error('categoria_id') is-invalid @enderror" required>
                                <option value="">--- Seleccionar ---</option>
                                @foreach ($categorias as $c)
                                    <option value="{{ $c->id_categoria }}">{{ $c->categoria }}</option>
                                @endforeach
                            </select>
                            @error('categoria_id')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg col-md mb-1">
                            <label class="form-label">Subcategoria</label>
                            <select wire:model.defer="subcategoria_id"
                                class="form-select @error('subcategoria_id') is-invalid @enderror" required>
                                <option value="">--- Seleccionar ---</option>
                                @foreach ($subcategorias as $s)
                                    <option value="{{ $s->id_subcategoria }}">{{ $s->subcategoria }}</option>
                                @endforeach
                            </select>
                            @error('subcategoria_id')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md mb-1">
                            <label class="form-label">Perecible</label>
                            <div class="form-check form-check-primary">
                                <input wire:model.defer="vto" type="checkbox" class="form-check-input" id="colorCheck1">
                                <label class="form-check-label" for="colorCheck1">Si</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md mb-1"></div>
                        <div class="col-lg mb-1">
                            <label class="form-label">Estado</label>
                            <select wire:model.defer="estado"
                                class="form-select @error('estado') is-invalid @enderror" id="select-country1" required>
                                <option value="">--- Seleccionar ---</option>
                                <option value="Habilitado">Habilitado</option>
                                <option value="Deshabilitado">Deshabilitado</option>
                            </select>
                            @error('estado')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button wire:click="limpiarCampos" type="button" class="btn btn-outline-secondary">Cancelar</button>
            <button wire:click="$emit('confirmUpdate',{{ $idProducto }})" type="button" class="btn btn-primary">Actualizar</button>
        </div>
    </form>
</x-modal>
