<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('admin/dist/img/user2-160x160.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          {{-- <p>Usuario:</p> --}}
          <div>{{Auth::user()->name}} </div>
          <p>{{-- {{Auth::user()->email}}  --}}</p>
        </div>
      </div>
    
      <ul class="sidebar-menu tree" data-widget="tree">
              <li class="header">Opciones Administrador </li>
               <li class="header"></li>
                <li class="active treeview menu-open">
                  <a href="{{ route('admin.index') }}">
                      <i class="fa fa-circle-o"></i>
                      <span>Home</span>
                  </a>
                  <a href="{{ route('user.index') }}">
                      <i class="fa fa-circle-o"></i>
                      <span>index</span>
                  </a>
                  <a href="{{ route('categories.index') }}">
                    <i class="fa fa-folder"></i> 
                    <span>Categorias</span>
                  </a>
                  <a href="{{ route('polls.index') }}">
                    <i class="fa fa-clipboard"></i>         
                    <span>Encuestas</span>
                  </a>
                  <a href="{{ route('ranges.index') }}">
                    <i class="fa fa-calendar"></i>        
                    <span>Establecer Rangos</span>  
                  </a>
                  <a href="{{ route('polls_users.index') }}">
                    <i class="fa fa-calendar"></i>
                    <span>Asignar Encuestas</span>
                  </a>
                  <a href="{{ route('general_definitions.index') }}">
                      <i class="fa fa-circle-o"></i>
                      <span>Definiciones Generales</span>
                  </a>
                  @if (Auth::user()->level < 2)
                    <a href="{{ route('admins.index') }}">
                      <i class="fa fa-calendar"></i>
                      <span>Usuarios</span>
                    </a>
                  @endif
                  
                  <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      <i class="fa fa-sign-out"></i><span>Salir</span></a></li> 
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                  </a>
                  </li>
                </li>
              </ul>
    </section>
    <!-- /.sidebar -->
  </aside>