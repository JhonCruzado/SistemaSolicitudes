<main class="content-body">
    <div class="d-flex justify-content-between mb-4">
        {{-- <h2 class="content-header-title float-start mb-0 text-dark">Proforma de Compra</h2> --}}
    </div>
    <div class="row">
        <div class="col-lg"></div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center mb-2">
                                <h2 class="m-0">
                                    <b><i data-feather='check'></i>&nbsp;&nbsp;Aprobar la solicitud de compra</b>
                                </h2>
                            </div>
                            <div class="d-flex justify-content-center mb-2">
                                <h5 class="m-0 text-center">
                                    Usted está por aprobar la solicitud N° 2345, con monto de S/ 1500, si tiene alguna observación ingrésela a continuación:
                                </h5>
                            </div>
                            <div class="row">
                                <div class="col-lg mb-1 text-center" >
                                    <div class="form-group mb-1 input"><br>
                                        <label class="form-label">Observación</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" >
                                        </div>
                                    </div><br>
                                    <div class="form-group d-flex justify-content-center mb-1 input">
                                            <button onclick="window.location.href='http://127.0.0.1:8000/solicitudes' "class="btn btn-info" id="button-addon2"
                                                type="button">
                                                {{-- <i class="far fa-user-plus"></i> --}}Aprobar
                                            </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg"></div>
    </div>
</main>
