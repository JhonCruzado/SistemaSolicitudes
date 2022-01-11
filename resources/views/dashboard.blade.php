<main>
    <section class="row">
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{asset('images/logo5.png')}}" alt="Comercial El Valle " style="height:25%; width:35%" class="portada">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="row justify-content-center">
        <div class="col-xl col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-danger p-50 mb-1">
                        <div class="avatar-content">
                            <i class="far fa-layer-group fa-2x"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder">{{$dp}}</h2>
                    <p class="card-text">Departamentos</p>
                </div>
            </div>
        </div>
         <div class="col-xl col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-info p-50 mb-1">
                        <div class="avatar-content">
                            <i class="fal fa-table fa-2x"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder">{{$ar}}</h2>
                    <p class="card-text">Areas</p>
                </div>
            </div>
        </div>
        <div class="col-xl col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-secondary p-50 mb-1">
                        <div class="avatar-content">
                            <i class="fal fa-users fa-2x"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder">{{$co}}</h2>
                    <p class="card-text">Colaboradores</p>
                </div>
            </div>
        </div>
        <div class="col-xl col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-success p-50 mb-1">
                        <div class="avatar-content">
                            <i class="fal fa-shopping-cart fa-2x"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder">{{$sc}}</h2>
                    <p class="card-text">Solicitudes de Compra</p>
                </div>
            </div>
        </div>
        <div class="col-xl col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-warning p-50 mb-1">
                        <div class="avatar-content">
                            <i class="far fa-sack-dollar fa-2x"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder">{{ number_format($egresos[0]->total, 2) }}</h2>
                    <p class="card-text">Egresos</p>
                </div>
            </div>
        </div>
    </section>
</main>
