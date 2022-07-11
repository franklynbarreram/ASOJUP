<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row pb-5">
                <div class="col-12">
                    <h1 class=" text-white text-center">¡Bienvenido!</h1>
                </div>

            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Nuevos Inscritos</h5>
                                    <span class="h2 font-weight-bold mb-0">
                                        {{$inscribed}}
                                    </span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> </span>
                                <span class="text-nowrap">En el ultimo mes</span>
                            </p>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->role_id == 1 || (Auth::user()->role_id == 2 && $permission_delegated!=0 ) )
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Listados Generados</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$listings}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                                <span class="text-nowrap">En el ultimo mes</span>
                            </p>
                        </div>
                    </div>
                </div>
                @endif


                @if(Auth::user()->role_id == 1 || (Auth::user()->role_id == 2 && $permission_delegated!=0 ) )
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Permisos Pendientes</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$permissions}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fa fa-user-plus"></i> </span>
                                <span class="text-nowrap">Hay {{$permissions}} Pendientes</span>
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                @if(Auth::user()->role_id == 3)
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Solicitudes Pendientes</h5>
{{--                                    reemplazar con solicitudes --}}
                                    <span class="h2 font-weight-bold mb-0">{{$permissions}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>