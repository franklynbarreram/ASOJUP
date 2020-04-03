<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Inicio') }}
                    </a>
                </li>

                <!-- Collapse -->
                <li class="nav-item">
                    <!-- Opciones para inscritos -->
                    <a class="nav-link collapsed" href="#inscribed-users-options" id="inscribed-users-link"
                        data-toggle="collapse"
                        role="button"
                        aria-expanded="false"
                        aria-controls="inscribed-users-options"
                    >
                        <i class="fas fa-users"></i>
                        <span class="nav-link-text">{{ __('Inscritos') }}</span>
                    </a>

                    <div class="collapse" id="inscribed-users-options">
                        <ul class="nav nav-sm flex-column">
                            <!-- Nuevo Inscrito -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('inscribedUsers.create') }}">
                                    <i class="fas fa-plus"></i>
                                    {{ __('Nuevo') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('inscribedUsers.index') }}">
                                    <i class="fas fa-list-alt"></i>
                                    {{ __('Ver Todos') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Fin funciones para inscritos -->
                </li>
                <!-- End of Collapse -->

                <!-- Collapse Medicamentos -->
                <li class="nav-item">
                    <!-- Opciones para inscritos -->
                    <a class="nav-link collapsed" href="#medicines-options" id="medicine-link"
                        data-toggle="collapse"
                        role="button"
                        aria-expanded="false"
                        aria-controls="medicines-options"
                    >
                        <i class="fas fa-capsules text-blue"></i>
                        <span class="nav-link-text">{{ __('Medicamentos') }}</span>
                    </a>

                    <div class="collapse" id="medicines-options">
                        <ul class="nav nav-sm flex-column">
                            <!-- Nuevo Inscrito -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('medicines.create') }}">
                                    <i class="fas fa-plus-square"></i>
                                    {{ __('Crear') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('medicines.index') }}">
                                    <i class="fas fa-list-alt"></i>
                                    {{ __('Ver Todos') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('forms.index') }}">
                                    <i class="fas fa-first-aid"></i>
                                    {{ __('Formas Farmacéuticas') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('units.index') }}">
                                    <i class="fas fa-balance-scale"></i>
                                    {{ __('Unidades de Concentración') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Fin funciones para inscritos -->
                </li>
                <!-- End of Collapse -->


                <li class="nav-item">
                    <a class="nav-link" href="{{route('needs.index', ['type' => 1])}}">
                        <i class="fas fa-stethoscope text-orange"></i> {{ __('Enfermedades') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('needs.index', ['type' => 2])}}">
                        <i class="fas fa-hands-helping text-info"></i> {{ __('Beneficios') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>