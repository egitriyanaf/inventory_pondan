<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>APLIKASI MANAJEMEN INVENTORY</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('public/assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/bower_components/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/dist/css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/bower_components/morris.js/morris.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/bower_components/jvectormap/jquery-jvectormap.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <a href="index2.html" class="logo">
      <span class="logo-mini"><b>INV</b></span>
      <img src="{{asset('public/logo.png')}}" height="55" width="100">
      <!-- <span class="logo-lg"><b>Administrator</b></span> -->
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('public/assets/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="{{ asset('public/assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->name }}
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <button type="button" data-toggle="modal" data-target="#ubahpassword" class="btn btn-default btn-flat">Ubah Sandi</button>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">Keluar</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('public/assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVIGASI UTAMA</li>
        @if(Auth::user()->level == 'User')
        <li class="{{ (request()->is('beranda')) ? 'active' : '' }}"><a href="{{ url('beranda') }}"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>
        <li class="{{ (request()->is('barang')) ? 'active' : '' }}"><a href="{{ url('barang') }}"><i class="fa fa-cubes"></i> <span>Barang</span></a></li>
        <li class="{{ (request()->is('pelanggan')) ? 'active' : '' }}"><a href="{{ url('pelanggan') }}"><i class="fa fa-users"></i> <span>Pelanggan</span></a></li>
        <li class="{{ (request()->is('satuan')) ? 'active' : '' }}"><a href="{{ url('satuan') }}"><i class="fa fa-balance-scale"></i> <span>Satuan</span></a></li>

        <li class="{{ (request()->is('barang_keluar','barang_masuk')) ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-exchange"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (request()->is('barang_masuk')) ? 'active' : '' }}"><a href="{{ url('barang_masuk') }}"><i class="fa fa-circle-o"></i> Barang Masuk</a></li>
            <li class="{{ (request()->is('barang_keluar')) ? 'active' : '' }}"><a href="{{ url('barang_keluar') }}"><i class="fa fa-circle-o"></i> Barang Keluar</a></li>
          </ul>
        </li>
        <li class="{{ (request()->is('surat_jalan')) ? 'active' : '' }}"><a href="{{ url('surat_jalan') }}"><i class="fa fa-file-text-o"></i> <span>Surat Jalan</span></a></li>
        @endif
        @if(Auth::user()->level == 'Admin')
          <li class="{{ (request()->is('pengguna')) ? 'active' : '' }}"><a href="{{ url('pengguna') }}"><i class="fa fa-user"></i> <span>Manajemen User</span></a></li>
        @endif
      </ul>
    </section>
  </aside>
  <div class="content-wrapper">
    @yield('content')
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <b>Copyright &copy; 2021</b> Aplikasi Manajemen Inventory <b>PT. Pondan Pangan Makmur Indonesia</b>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>

<!-- ubah password -->
<div class="modal fade" id="ubahpassword">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="{{ url('ubah_sandi/'.Auth::user()->id) }}">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ubah Kata Sandi</h4>
        </div>
        <div class="modal-body">
            @csrf
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <!-- <label>Kata Sandi</label> -->
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi baru..." required autofocus>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="{{ asset('public/assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('public/assets/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ asset('public/assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('public/assets/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('public/assets/bower_components/morris.js/morris.min.js') }}"></script>
<script src="{{ asset('public/assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('public/assets/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<script src="{{ asset('public/assets/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('public/assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('public/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ asset('public/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('public/assets/bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('public/assets/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('public/assets/dist/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('public/assets/dist/js/demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.9/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    @if(Session::get('sukses'))
      Swal.fire({
        icon: 'success',
        title: '{{ Session::get("sukses") }}',
        showConfirmButton: false,
        timer: 1500
      })
    @endif
  });
</script>
<script>
  $(function () {
    $('.datatables').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
    $('.datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    })
  })
</script>
</body>
</html>