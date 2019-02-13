<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- evita cache -->
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
  <!-- evita cache -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/estyle-print.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <link rel="shortcut icon" href="{{ asset('favicon-96x96.png') }}" >
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <?php date_default_timezone_set('America/La_Paz'); ?>
    <title>Farmacia</title>
    
</head>
<body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">

        <header class="main-header">
  
          <!-- Logo -->
          <a href="{{url('/')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>FR</b>VN</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>FARMACIA VANE</b></span>
          </a>
  
          <!-- Header Navbar: style can be found in header.less -->
          <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
              <span class="sr-only">Navegación</span>
            </a>
            <!-- Navbar Right Menu -->
            {{-- @if(Auth::check()) --}}
            <div class="navbar-custom-menu">
              @if (Auth::user()->id)
              <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu stocker">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-frown-o"></i>
                    <span class="label label-warning" id="alertStock"></span>
                  </a>
                  <ul class="dropdown-menu mstock">
                    <li style="text-align: center;" class="header">  Stocks en Alerta</li>
                    <li></li>
                  </ul>
                </li>

                <!-- segundo alert de fecha -->
                <li class="dropdown messages-menu avence">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-hourglass-end"></i>
                  
                  <span class="label label-warning" id="alertVence"></span>
                </a>
                <ul class="dropdown-menu mvence">
               <li style="text-align: center;" class="header"> Cerca a Vencer</li>
                <li>
                </li>
                </ul>
                </li>
                <!-- vencidos y acabados-->
                <li class="dropdown messages-menu avence">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                 
                  <span class="label label-danger" id="alertVencido"></span>
                </a>
                <ul class="dropdown-menu mvencido">
               <li style="text-align: center;" class="header">  Vencidos</li>
                <li >
                 
                </li>
                </ul>
                </li>
                <!-- vencidos y acabados-->
                <li class="dropdown messages-menu agotado">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  
                  <span class="label label-danger" id="alertAgotados"></span>
                </a>
                <ul class="dropdown-menu magotado">
               <li style="text-align: center;" class="header">  Agotados</li>
                <li >
                 
                </li>
                </ul>
                </li>
                        <a href="#" class="dropdown-toggle btn btn-primary" > 
                    {{-- <small class="bg-red">Usuario: {{ Auth::user()->name }}</small> --}}
                    {{-- <!--<span class="hidden-xs">{{Auth::user()->idRol }}</span>--> --}}
                        Usuario: {{ Auth::user()->name }}      
                      </a>
                      <a href="{{ route('logout') }}" class="btn btn-danger"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      Cerrar Sesion
                    </a>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                    @endif
                    
            </div>
  
          </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
          <!-- sidebar: style can be found in sidebar.less -->
          <section class="sidebar">
            <!-- Sidebar user panel -->
  
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header"></li>
                @if (Auth::user()->id==1)
    
                <li class="treeview">
                  <a href="{{url('my-proveedors')}}">
                    <i class="fa fa-users"></i>
                    <span>Proveedores</span>
                    <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                  <!-- <ul class="treeview-menu">
                    <li><a href="{{url('my-proveedors')}}"><i class="fa fa-circle-o"></i> Listar Proveedores</a></li>
                  </ul> -->
                </li>
       
                <li class="treeview">
                  <a href="{{url('my-categories')}}">
                    <i class="fa fa-list-alt"></i>
                    <span>Categorias</span>
                    <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                  <!-- <ul class="treeview-menu">
                    <li><a href="{{url('my-categories')}}"><i class="fa fa-circle-o"></i> Listar categorias</a></li>
                  </ul> -->
                </li>
                <li class="treeview">
                  <a href="{{url('my-estante')}}">
                    <i class="fa fa-th"></i>
                    <span>Estantes</span>
                    <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                  <!-- <ul class="treeview-menu">
                    <li><a href="{{url('my-estante')}}"><i class="fa fa-circle-o"></i> Listar estantes</a></li>
                  </ul> -->
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-medkit"></i>
                    <span>Medicamentos  </span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{url('my-productos')}}"><i class="fa fa-circle-o"></i>Productos Por Vencer</a></li>
                  </ul>
                  <ul class="treeview-menu">
                    <li><a href="{{url('my-productosStock')}}"><i class="fa fa-circle-o"></i>Stock de Medicamentos</a></li>
                  </ul>
                </li>
                <li class="treeview">
                    <a href="{{url('my-usuario')}}">
                      <i class="fa fa-key"></i>
                      <span>Acceso</span>
                    </a>
                  </li>
                  <li class="treeview">
                      <a href="#">
                        <i class="fa fa-calendar"></i>
                        <span>Reporte</span>
                        <i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="{{url('reporte')}}"><i class="fa fa-circle-o"></i>Generar Reporte de Compra</a></li>
                         <li><a href="{{url('reporte/venta')}}"><i class="fa fa-circle-o"></i>Generar de Reporte Ventas</a></li>
                        <li><a href="{{url('my-venta')}}"><i class="fa fa-circle-o"></i>Reporte diario de Ventas</a></li>
                      </ul>
                    </li>
                @endif
  
                @if(Auth::user()->id==1 || Auth::user()->id!=1)
  
                <li class="treeview">
                  <a href="{{url('my-venta')}}">
                    <i class="fa fa-cart-plus"></i>
                    <span>Vender</span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{url('allproductos')}}">
                    <i class="fa fa-search"></i>
                    <span>Buscar</span>
                  </a>
                </li>
                
               <!--  <li>
                  <a href="{{url('acercaDe')}}">
                    <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                    <small class="label pull-right bg-yellow">INFO</small>
                  </a>
                </li> -->
  
                @endif
    
              </ul>
          </section>
        </aside>
        <div class="content-wrapper">
  
          <!-- Main content -->
          <section class="content">
  
            <div class="row">
              <div class="col-md-12">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Farmacia Vane</h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
  
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                        <div class="row">

                            
                             @if(Request::path()!='home' && Request::path()!='/')
                             
                             <div class="col-md-12">
                               <div class="input-group">
                                 <span style="background: #d2d6de;" class="input-group-addon">Buscar</span>
                                 <input id="filtrar" type="text" class="form-control" placeholder="Ingresa criterio de Busqueda...">
                                </div>
                                                           
                            @endif
                              <div> 
                                  @yield('contenidocat')
                              </div>
                              <div>
                                  @yield('contenidoes')
                              </div>
                              <div>
                                  @yield('contenidoprov')
                              </div>
                              <div>
                                  @yield('contenidoprod')
                              </div>
                              <div>
                                @yield('reportesVentas')
                              </div>
                              <div>
                                @yield('allproductos')
                              </div>

                             </div>
                             
                          </div>
  
                            </div>
                        </div><!-- /.row -->
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
              </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <!--Fin-Contenido-->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.1.0
      </div>
      <strong>
      <?php $fecha=date('Y');
        echo "© ".$fecha." <a href='#'>MscSoft</a> All rights Reserved.";
       ?>
       
       </strong> 
    </footer>

    <script >


    var cat ="<?php echo route('categories.index'); ?>"
        var url ="<?php echo route('proveedors.index'); ?>"
        var est ="<?php echo route('estante.index'); ?>"
        var prod ="<?php echo route('productos.index'); ?>"
        var usuario ="<?php echo route('usuario.index'); ?>"
        var prodS ="<?php echo url('productosS'); ?>"
        var venta ="<?php echo route('venta.index'); ?>"
        var cli ="<?php echo route('clientes.index'); ?>"
        var pagotados ="<?php echo url('my-productosStock'); ?>"
         var prodRV ="<?php echo url('prodRV'); ?>"
        var pvencidos ="<?php echo url('my-productos'); ?>"
        //var rojo=document.getElementById('alertStock').value;
        

    </script>
    
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <script src="{{asset('js/Chart.min.js')}}"></script>
    
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('js/app.min.js')}}"></script>
    <script src="{{asset('js/proveedores-ajax.js')}}"></script> 
    <script src="{{asset('js/categoria-ajax.js')}}"></script>
    
    <script src="{{asset('js/venta-ajax.js')}}"></script>
    <script src="{{asset('js/estante-ajax.js')}}"></script>
    <script src="{{asset('js/clientes.js')}}"></script>
    <script src="{{asset('js/toaster.min.js')}}"></script>
    <script src="{{asset('js/validator.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/productos-ajax.js')}}"></script> 
    <script src="{{asset('js/usuario-ajax.js')}}"></script> 
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    
</body>
</html>