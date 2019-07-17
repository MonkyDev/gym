<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
            {{ config('app.name') }} 
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        @auth
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fas fa-book"></i>
                        Administración
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('clientes.index') }}">
                            <i class="fas fa-angle-right"></i> 
                            Registro Clientes
                        </a>
                        <a class="dropdown-item" href="{{ route('mensualidades.index') }}">
                            <i class="fas fa-angle-right"></i> 
                            Pagos Mensualidad
                        </a>
                        <a class="dropdown-item" href="{{ route('ingresos.index') }}">
                            <i class="fas fa-angle-right"></i> 
                            Otros Ingresos
                        </a>
                        <a class="dropdown-item" href="{{ route('gastos.index') }}">
                            <i class="fas fa-angle-right"></i> 
                            Otros Gastos
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fas fa-unlock-alt"></i>
                        Permisos
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @can('user.index')
                        <a class="dropdown-item" href="{{ route('users.index') }}">
                            <i class="fas fa-user-edit"></i> 
                            Usuarios
                        </a>
                        @endcan
                        @can('role.index')
                        <a class="dropdown-item" href="{{ route('roles.index') }}">
                            <i class="fas fa-project-diagram"></i>
                            Roles
                        </a>
                        @endcan
                    </div>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fas fa-user-cog"></i>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            Cerrar sesiòn
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        @endauth
    </div>
</nav>