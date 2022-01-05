<!-- BEGIN: Main Menu-->
@php
    /* $user = Auth::user()->roles->rol; */
@endphp
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="/dashboard">
                    <span class="brand-logo">
                        <img src="{{asset('images/logo1.png')}}" alt="Olano S.A.C logo" style="height: 24px;">
                    </span>
                    <h2 class="brand-text text-dark">Comercial El Valle</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <i class="d-none d-xl-block menu-icon font-medium-4 text-dark" data-feather="menu"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{ setActive('dashboard') }}">
                <a class="d-flex align-items-center" href="/dashboard">
                    <i data-feather='layout'></i>
                    <span class="menu-title text-truncate" data-i18n="Clientes">Dashboard</span>
                </a>
            </li>
            <li class=" navigation-header">
                <span data-i18n="Apps &amp; Pages">General</span>
                <i data-feather="more-horizontal"></i>
            </li>
            {{-- @if (isA($user)) --}}
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather="grid"></i>
                        <span class="menu-title text-truncate">Administrar</span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{ setActive('departamentos') }}">
                            <a class="d-flex align-items-center" href="{{ route('departamentos') }}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate">Departamentos</span>
                            </a>
                        </li>
                        <li class="{{ setActive('areas') }}">
                            <a class="d-flex align-items-center" href="{{ route('areas') }}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate">Areas</span>
                            </a>
                        </li>
                    </ul>
                </li>
            {{-- @endif
            @if(isA($user) || isA($user)) --}}
                <li class="nav-item {{ setActive('colaboradores') }}">
                    <a class="d-flex align-items-center" href="{{ route('colaboradores') }}">
                        <i data-feather='users'></i>
                        <span class="menu-title text-truncate">Colaboradores</span>
                    </a>
                </li>
            {{-- @endif --}}
            <hr>
            {{-- @if (isA($user)) --}}
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='share-2'></i>
                        <span class="menu-title text-truncate">Asignar</span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{ setActive('asignar') }}">
                            <a class="d-flex align-items-center" href="{{ route('asignar') }}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate">Jefes Departamentos</span>
                            </a>
                        </li>
                        <li class="{{ setActive('asignar2') }}">
                            <a class="d-flex align-items-center" href="{{ route('asignar2') }}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate">Jefes Areas</span>
                            </a>
                        </li>
                        {{-- <li class="{{ setActive('asignar-colaborador') }}">
                            <a class="d-flex align-items-center" href="{{ route('asignar3') }}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate">Colaboradores</span>
                            </a>
                        </li> --}}
                    </ul>
                </li>
           {{--  @endif --}}
          {{--   @if (isA($user) || isA($user) || isA($user))
                <li class="nav-item {{ setActive('asignar') }}">
                    <a class="d-flex align-items-center" href="{{ route('asignar') }}">
                        <i data-feather='folder-plus'></i>
                        <span class="menu-title text-truncate">Asignar Colaboradores</span>
                    </a>
                </li>
            @endif --}}
            <hr>
            {{-- @if (isA($user) || isA($user)) --}}
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='shopping-bag'></i>
                        <span class="menu-title text-truncate">Solicitudes de Compras</span>
                    </a>
                    <ul class="menu-content">
                       {{--  @if (isA($user)) --}}
                            <li class="{{ setActive('nueva-solicitud') }}">
                                <a class="d-flex align-items-center" href="{{ route('nueva-solicitud') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Registrar Solicitud</span>
                                </a>
                            </li>
                       {{--  @endif --}}
                        <li class="{{ setActive('solicitudes') }}">
                            <a class="d-flex align-items-center" href="{{ route('solicitudes') }}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate">Solicitudes realizadas</span>
                            </a>
                        </li>
                    </ul>
                </li>
            {{-- @endif --}}
            {{--
            @if (isA($user))
                <li class="nav-item {{ setActive('proveedores') }}">
                    <a class="d-flex align-items-center" href="{{ route('proveedores') }}">
                        <i data-feather='truck'></i>
                        <span class="menu-title text-truncate">Proveedores</span>
                    </a>
                </li>
            @endif
            @if (isA($user) || isA($user) || isA($user))
                <li class="nav-item {{ setActive('productos') }}">
                    <a class="d-flex align-items-center" href="{{ route('productos') }}">
                        <i data-feather="package"></i>
                        <span class="menu-title text-truncate">Productos</span>
                    </a>
                </li>
            @endif
            @if (isA($user) || isA($user))
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='trending-up'></i>
                        <span class="menu-title text-truncate">Reportes</span>
                    </a>
                    <ul class="menu-content">
                        @if (isA($user))
                            <li class="{{ setActive('rep-ventas') }}">
                                <a class="d-flex align-items-center" href="{{ route('rep-ventas') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Reporte ventas</span>
                                </a>
                            </li>
                        @endif
                        @if (isA($user) || isA($user))
                            <li class="{{ setActive('rep-compras') }}">
                                <a class="d-flex align-items-center" href="{{ route('rep-compras') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Reporte compras</span>
                                </a>
                            </li>
                        @endif
                        @if (isA($user) || isA($user))
                            <li class="{{ setActive('rep-movimientos') }}">
                                <a class="d-flex align-items-center" href="{{ route('rep-movimientos') }}" target="_blank">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Reporte movimientos</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (isA($user) || isA($user))
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather='shopping-cart'></i>
                    <span class="menu-title text-truncate">Ventas</span>
                </a>
                <ul class="menu-content">
                    @if (isA($user))
                        <li class="{{ setActive('nueva-venta') }}">
                            <a class="d-flex align-items-center" href="{{ route('nueva-venta') }}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate">Nueva venta</span>
                            </a>
                        </li>
                    @endif
                    <li class="{{ setActive('ventas') }}">
                        <a class="d-flex align-items-center" href="{{ route('ventas') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Ventas realizadas</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            @if (isA($user) || isA($user))
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='credit-card'></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboards">Movimientos</span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{setActive('caja')}}">
                            <a class="d-flex align-items-center" href="{{route('caja')}}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Analytics">Caja</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if (isA($user))
                <li class="nav-item {{ setActive('kardex') }}">
                    <a class="d-flex align-items-center" href="{{ route('kardex') }}">
                        <i data-feather='folder'></i>
                        <span class="menu-title text-truncate">Kardex</span>
                    </a>
                </li>
            @endif
            @if (isA($user))
                <li class=" navigation-header">
                    <span data-i18n="Apps &amp; Pages">Operaciones</span>
                    <i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='settings'></i>
                        <span class="menu-title text-truncate">Configuraciones</span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{ setActive('empresa') }}">
                            <a class="d-flex align-items-center" href="{{ route('empresa') }}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate">Datos de la empresa</span>
                            </a>
                        </li>
                        <li class="{{ setActive('usuarios') }}">
                            <a class="d-flex align-items-center" href="{{ route('usuarios') }}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate">Usuarios</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif --}}
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
