<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header ">

                <div class=" profile-element">
                    <a href="{{ url('/') }}" alt="Ir a Inicio"> <h1>Control de Servicios</h1></a>
                </div>
                <div class="logo-element">
                    CS
                </div>
            </li>
            <li class=" @if (Route::getCurrentRoute()->getPath() == '/')
                    active
                 @elseif (Route::getCurrentRoute()->getPath() == 'servicios/busqueda-avanzada')
                    active
                @elseif(Route::getCurrentRoute()->getPath() == 'servicios/add')
                    active
                @endif ">

                <a href="index.html"><i class="fa fa-search" aria-hidden="true"></i> <span class="nav-label">Servicios o Equipo</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == '/') ? 'active' : '' }}"><a href="{{ url('/') }}" >Listar</a></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'servicios/busqueda-avanzada') ? 'active' : '' }}"><a href="{{ url('/servicios/busqueda-avanzada') }}"  >Busqueda Avanzada</a></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'servicios/add') ? 'active' : '' }}"><a href="{{ url('/servicios/add') }}" >Agregar</a></li>
                </ul>
            </li>

            <li class=" @if (Route::getCurrentRoute()->getPath() == 'tipo-servicios')
                    active
                 @elseif (Route::getCurrentRoute()->getPath() == 'tipo-servicios/add')
                    active
                @endif ">
                <a href="index.html"><i class="fa fa-plus-square"></i> <span class="nav-label">Tipos de Servicios</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'tipo-servicios') ? 'active' : '' }}"><a href="{{ url('tipo-servicios') }}"><a href="{{ url('/tipo-servicios') }}">Listar</a></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'tipo-servicios/add') ? 'active' : '' }}"><a href="{{ url('tipo-servicios/add') }}"><a href="{{ url('/tipo-servicios/add') }}">Agregar</a></li>
                </ul>
            </li>

            <li class=" @if (Route::getCurrentRoute()->getPath() == 'procedencia')
                    active
                 @elseif (Route::getCurrentRoute()->getPath() == 'procedencia/add')
                    active
                @endif ">
                <a href="index.html"><i class="fa fa-building-o" aria-hidden="true"></i> <span class="nav-label">Procedencia/ Ubicación</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'procedencia') ? 'active' : '' }}"><a href="{{ url('procedencia') }}"><a href="{{ url('/procedencia') }}">Listar</a></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'procedencia/add') ? 'active' : '' }}"><a href="{{ url('procedencia/add') }}"><a href="{{ url('/procedencia/add') }}">Agregar</a></li>
                </ul>
            </li>

            <li class=" @if (Route::getCurrentRoute()->getPath() == 'tipo-procedencia')
                    active
                 @elseif (Route::getCurrentRoute()->getPath() == 'tipo-procedencia/add')
                    active
                @endif ">
                <a href="index.html"><i class="fa fa-map-marker" aria-hidden="true"></i> <span class="nav-label">Tipos de Procedencia</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'tipo-procedencia') ? 'active' : '' }}"><a href="{{ url('tipo-procedencia') }}"><a href="{{ url('/tipo-procedencia') }}">Listar</a></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'tipo-procedencia/add') ? 'active' : '' }}"><a href="{{ url('tipo-procedencia/add') }}"><a href="{{ url('/tipo-procedencia/add') }}">Agregar</a></li>
                </ul>
            </li>


            <li class=" @if (Route::getCurrentRoute()->getPath() == 'ciudad')
                    active
                 @elseif (Route::getCurrentRoute()->getPath() == 'ciudad/add')
                    active
                @endif ">
                <a href="index.html"><i class="fa fa-globe"></i> <span class="nav-label">Ciudad</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'ciudad') ? 'active' : '' }}"><a href="{{ url('ciudad') }}"><a href="{{ url('/ciudad') }}">Listar</a></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'ciudad/add') ? 'active' : '' }}"><a href="{{ url('ciudad/add') }}"><a href="{{ url('/ciudad/add') }}">Agregar</a></li>
                </ul>
            </li>

            <li class=" @if (Route::getCurrentRoute()->getPath() == 'operadora')
                    active
                 @elseif (Route::getCurrentRoute()->getPath() == 'operadora/add')
                    active
                @endif ">
                <a href="index.html"><i class="fa fa-phone-square" aria-hidden="true"></i><span class="nav-label">Operadora</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'operadora') ? 'active' : '' }}"><a href="{{ url('operadora') }}"><a href="{{ url('/operadora') }}">Listar</a></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'operadora/add') ? 'active' : '' }}"><a href="{{ url('operadora/add') }}"><a href="{{ url('/operadora/add') }}">Agregar</a></li>
                </ul>
            </li>

            <li class=" @if (Route::getCurrentRoute()->getPath() == 'estatus')
                    active
                 @elseif (Route::getCurrentRoute()->getPath() == 'estatus/add')
                    active
                @endif ">
                <a href="index.html"><i class="fa fa-circle" aria-hidden="true"></i><span class="nav-label">Estatus</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'operadora') ? 'active' : '' }}"><a href="{{ url('estatus') }}"><a href="{{ url('/estatus') }}">Listar</a></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'operadora/add') ? 'active' : '' }}"><a href="{{ url('estatus/add') }}"><a href="{{ url('/estatus/add') }}">Agregar</a></li>
                </ul>
            </li>

            <li class=" @if (Route::getCurrentRoute()->getPath() == 'compania')
                    active
                 @elseif (Route::getCurrentRoute()->getPath() == 'compania/add')
                    active
                @endif ">
                <a href="index.html"><i class="fa fa-briefcase" aria-hidden="true"></i><span class="nav-label">Compa&ntilde;ia</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'compania') ? 'active' : '' }}"><a href="{{ url('compania') }}"><a href="{{ url('/compania') }}">Listar</a></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'compania/add') ? 'active' : '' }}"><a href="{{ url('compania/add') }}"><a href="{{ url('/compania/add') }}">Agregar</a></li>
                </ul>
            </li>





        </ul>

    </div>
</nav>