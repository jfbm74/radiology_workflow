<div id="left-sidebar" class="sidebar ">
    {{-- Main Menu --}}
    <div id="left-sidebar" class="sidebar ">
        <h5 class="brand-name">PORTAL <a href="javascript:void(0)" class="menu_option float-right"><i
                    class="icon-grid font-16" data-toggle="tooltip" data-placement="left"
                    title="Grid & List Toggle"></i></a></h5>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul class="metismenu">
                <li class="g_heading">Menú</li>
                @if (auth()->user()->is_staff == 1)
                        <li class="">
                        <a href="javascript:void(0)" class="has-arrow arrow-c"><i
                                class="fa fa-gear"></i><span>Configuración</span></a>
                        <ul>
                            <li class=""><a href="index.html"><span>Usuarios</span></a></li>
                            <li><a href="{{ route('package.index') }}"><span>Paquetes</span></a></li>
                            <li><a href="hr-users.html"><span>Radiometría</span></a></li>

                        </ul>
                    </li>
                    <li class="">
                        <a href="javascript:void(0)" class="has-arrow arrow-c"><i
                                class="fa fa-list-alt"></i><span>Administración</span></a>
                        <ul>
                            <li class="active"><a href="{{route('user.index')}}"><span>Usuarios</span></a></li>
                            <li><a href="hr-users.html"><span>Pacientes</span></a></li>
                            <li><a href="{{ route('admission.list') }}"><span>Ingresos</span></a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="javascript:void(0)" class="has-arrow arrow-c"><i
                                class="fa fa-dashboard"></i><span>Reportes</span></a>
                        <ul>
                            <li class=""><a href="{{route('dashboard.manager.index')}}"><span>Dashboard</span></a></li>
                            <li><a href="{{route('dashboard.manager.index')}}"><span>Reportes</span></a></li>
                        </ul>
                    </li>

                    <li><a href="{{ route('admission.index') }}"><i class="fa fa-plus-circle"></i><span>Admisión</span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="has-arrow arrow-c"><i
                                class="fa fa-user-md"></i><span>Atención</span></a>
                        <ul>
                            <li><a href="{{ route('attention.index') }}"><span>Toma Imágenes</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="has-arrow arrow-c"><i class="fa fa-archive"></i><span>Gestión
                                Documental</span></a>
                        <ul>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="has-arrow arrow-c"><i
                                class="fa fa-clipboard"></i><span>Inventario</span></a>
                        <ul>
                            {{-- <li><a href="login.html">Login</a></li> --}}

                        </ul>
                    </li>
                @endif

                <li>
                    <a href="javascript:void(0)" class="has-arrow arrow-c"><i
                            class="fa fa-universal-access"></i><span>Portal Pacientes</span></a>
                    <ul>
                        <li><a href="{{ route('portal.index') }}">Pacientes</a></li>

                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    {{-- End Main Menu --}}
</div>
