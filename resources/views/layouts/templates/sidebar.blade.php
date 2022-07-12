<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="d-flex d-md-block justify-content-between align-items-center w-100">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- User -->

        <!-- Brand -->
        <a class="d-none d-md-flex justify-content-center pt-0 " href="{{ route('home') }}">
            <img src="{{ asset('imgs') }}/AsojupLogo.png" class="" alt="..." id="LogoNavbar">
        </a>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>


            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Inicio') }}
                    </a>
                </li>

                <!-- Collapse -->
                @if(Auth::user()->role_id == 1)
                <li class="nav-item">
                    <!-- Opciones para delegados -->
                    <a class="nav-link collapsed" href="#delegates-options" id="delegates-link" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="delegates-options">
                        <i class="fas fa-user-shield"></i>
                        <span class="nav-link-text">{{ __('Delegados') }}</span>
                    </a>

                    <div class="collapse" id="delegates-options">
                        <ul class="nav nav-sm flex-column">
                            <!-- Nuevo Inscrito -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('delegates.create') }}">
                                    <i class="fas fa-plus"></i>
                                    {{ __('Nuevo') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('delegates.index') }}">
                                    <i class="fas fa-list-alt"></i>
                                    {{ __('Ver Todos') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                <!-- Collapse -->
                @if(Auth::user()->role_id == 1 || (Auth::user()->role_id == 2 && $permission_delegated!=0 ) )
                <li class="nav-item">
                    <!-- Opciones para inscritos -->
                    <a class="nav-link collapsed" href="#listing-options" id="listing-link" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="listing-options">
                        <i class="fas fa-clipboard-list"></i>
                        <span class="nav-link-text">{{ __('Listados') }}</span>
                    </a>

                    <div class="collapse" id="listing-options">
                        <ul class="nav nav-sm flex-column">
                            <!-- Nuevo Inscrito -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('listings.create') }}">
                                    <i class="fas fa-plus"></i>
                                    {{ __('Nuevo') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('listings.index') }}">
                                    <i class="fas fa-list-alt"></i>
                                    {{ __('Ver Todos') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Fin funciones para inscritos -->
                </li>
                <!-- End of Collapse -->

                @endif

                <!-- Collapse Inscritos-->
                @if(Auth::user()->role_id == 1 || (Auth::user()->role_id == 2 && $permission_delegated!=0 ) )
                <li class="nav-item">
                    <!-- Opciones para inscritos -->
                    <a class="nav-link collapsed" href="#inscribed-users-options" id="inscribed-users-link" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="inscribed-users-options">
                        <i class="fas fa-users text-green"></i>
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
                @endif
                <!-- End of Collapse -->

                @if(Auth::user()->role_id == 1 || (Auth::user()->role_id == 2 ) )
                <!-- Collapse Medicamentos -->
                <li class="nav-item">
                    <!-- Opciones para inscritos -->
                    <a class="nav-link collapsed" href="#medicines-options" id="medicine-link" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="medicines-options">
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
                @endif

                @if(Auth::user()->role_id == 1 || (Auth::user()->role_id == 2 ) )
                <li class="nav-item">
                    <a class="nav-link" href="{{route('needs.index', ['type' => 1])}}">
                        <i class="fas fa-stethoscope text-orange"></i> {{ __('Enfermedades') }}
                    </a>
                </li>
                @endif

                @if(Auth::user()->role_id == 1 || (Auth::user()->role_id == 2 ) )
                <li class="nav-item">
                    <a class="nav-link" href="{{route('needs.index', ['type' => 2])}}">
                        <i class="fas fa-hands-helping text-info"></i> {{ __('Beneficios') }}
                    </a>
                </li>
                @endif

                @if(Auth::user()->role_id == 1 || (Auth::user()->role_id == 2 ) )
                <li class="nav-item">
                    <a class="nav-link" href="{{route('permissions.index')}}">
                        <i class="fas fa-exclamation-circle text-yellow"></i> {{ __('Permisos') }}
                    </a>
                </li>
                @endif

                @if(Auth::user()->role_id == 3)
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('inscribed_users.view')}}">
                            <i class="fas fa-exclamation-circle text-yellow"></i> {{ __('Ver mis datos') }}
                        </a>
                    </li>
                @endif
            </ul>



        </div>
        <div class="">
            <ul class="align-items-center d-flex d-md-none">
                <li class="nav-item dropdown">
                    <a class="nav-link p-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                            <span class=" rounded-circle">
                                <i style="font-size: 2rem;" class=" fa fa-user-circle " aria-hidden="true"></i>
                            </span>
                            <div class="media-body ml-2 d-none d-md-block">
                                <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">{{ __('¡Bienvenido!') }}</h6>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>{{ __('Mi Perfil') }}</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('admin.logout') }}" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>{{ __('Cerrar Sesión') }}</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>

    </div>

</nav>