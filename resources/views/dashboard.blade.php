<main>
    <section class="row">
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{asset('images/logo2.png')}}" alt="Olano S.A.C" style="height:10%; width:20%" class="portada">
                    </div>
                    <br>
                    <p class="jumbotron" style="font-size:20px;text-align:center">
                        <b></b>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="row justify-content-center">
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-success p-50 mb-1">
                        <div class="avatar-content">
                            <i class="far fa-truck fa-2x"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder">{{$sc}}</h2>
                    <p class="card-text">Solicitudes De Compra</p>
                </div>
            </div>
        </div>
         <div class="col-xl-3 col-md-3 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-secondary p-50 mb-1">
                        <div class="avatar-content">
                            <i class="far fa-box fa-2x"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder">{{$pr}}</h2>
                    <p class="card-text">Productos</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-3 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-info p-50 mb-1">
                        <div class="avatar-content">
                            <i class="far fa-user-tie fa-2x"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder">{{$co}}</h2>
                    <p class="card-text">Colaboradores</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-3 col-sm">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-dark p-50 mb-1">
                        <div class="avatar-content">
                            <i class="far fa-users fa-2x"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder">{{$us}}</h2>
                    <p class="card-text">Usuarios</p>
                </div>
            </div>
        </div>
    </section>
</main>
