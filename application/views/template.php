<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?= $title ?> | SiDIA</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/summernote/summernote-bs4.css">
  <!-- Datepicker -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
  <!-- Datetimepicker -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Multi select -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/lou-multi-select/css/multi-select.css" media="screen">
  <!-- dropify -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/dropify/dropify.css">
  <!-- Dropzone -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/dropzone/dist/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href=""/>
  <style>
    .ekko-lightbox .modal-dialog .modal-content .modal-header h4.modal-title {
      font-size: 16px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <img width="25" src="<?= base_url('assets/img/user/'.$admin->foto) ?>" alt="" class="img-circle elevation-2 mr-1"><?= $this->session->userdata("username") ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Welcome!!!</span>
          <div class="dropdown-divider"></div>
          <a href="<?= base_url('user/account/'.$this->session->userdata("id_user")) ?>" class="dropdown-item">
            <i class="fas fa-user-circle mr-2"></i> Account
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?= base_url('goadmin/logout') ?>" class="dropdown-item">
            <i class="fas fa-power-off mr-2"></i> Log out
          </a>
        </div>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>" class="brand-link text-center">
      <h4 class="text-center">SiDIA</h4>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/img/user/'.$admin->foto) ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $this->session->userdata("username") ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?= base_url('dashboard') ?>" class="nav-link <?php if($this->uri->segment(1) == 'dashboard') echo "active"  ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">Master Data</li>
          <li class="nav-item">
            <a href="<?= base_url('produk') ?>" class="nav-link <?php if($this->uri->segment(1) == 'produk') echo "active"  ?>">
              <i class="nav-icon fas fa-box-open"></i>
              <p>
                Produk
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('infopertemuan') ?>" class="nav-link <?php if($this->uri->segment(1) == 'infopertemuan') echo "active" ?>">
                <i class="nav-icon fas fa-info-circle"></i>
              <p>
                Info Pertemuan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('flipchart') ?>" class="nav-link <?php if($this->uri->segment(1) == 'flipchart') echo "active" ?>">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Flip Chart
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('marketingplan') ?>" class="nav-link <?php if($this->uri->segment(1) == 'marketingplan') echo "active" ?>">
              <i class="nav-icon fas fa-mail-bulk"></i>
              <p>
                Marketing Plan
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="<?= base_url('persentasistandar') ?>" class="nav-link <?php if($this->uri->segment(1) == 'persentasistandar') echo "active" ?>">
              <i class="nav-icon fas fa-file-powerpoint"></i>
              <p>
                Persentasi Standar
              </p>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a href="<?= base_url('persentasi') ?>" class="nav-link <?php if($this->uri->segment(1) == 'persentasi') echo "active" ?>">
              <i class="nav-icon fas fa-file-powerpoint"></i>
              <p>
                Persentasi
              </p>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a href="<?= base_url('basicpack') ?>" class="nav-link <?php if($this->uri->segment(1) == 'basicpack') echo "active" ?>">
              <i class="nav-icon fas fa-list-ol"></i>
              <p>
                Basic Pack
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('testimoni') ?>" class="nav-link <?php if($this->uri->segment(1) == 'testimoni') echo "active" ?>">
              <i class="nav-icon fas fa-user-check"></i>
              <p>
                Testimoni
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="<?= base_url('promosi') ?>" class="nav-link <?php if($this->uri->segment(1) == 'promosi') echo "promosi" ?>">
              <i class="nav-icon fas fa-percentage"></i>
              <p>
                Promosi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('sales') ?>" class="nav-link <?php if($this->uri->segment(1) == 'sales') echo "active" ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Sales
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('bank') ?>" class="nav-link <?php if($this->uri->segment(1) == 'bank') echo "active" ?>">
              <i class="nav-icon fas fa-landmark"></i>
              <p>
                Bank
              </p>
            </a>
          </li>

          <li class="nav-header">Transaksi</li>
          <li class="nav-item">
            <a href="<?= base_url('pin') ?>" class="nav-link <?php if($this->uri->segment(1) == 'pin') echo "active" ?>">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Pin
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('order') ?>" class="nav-link <?php if($this->uri->segment(1) == 'order') echo "active" ?>">
              <i class="nav-icon fas fa-shopping-basket"></i>
              <p>
                Order
              </p>
            </a>
          </li>
          <!--<li class="nav-item">-->
          <!--  <a href="<?= base_url('report') ?>" class="nav-link <?php if($this->uri->segment(1) == 'report') echo "active" ?>">-->
          <!--    <i class="nav-icon fas fa-th"></i>-->
          <!--    <p>-->
          <!--      Report-->
          <!--    </p>-->
          <!--  </a>-->
          <!--</li>-->
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $title ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
              <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?= $contents; ?>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="<?= base_url('dashboard') ?>">SiDIA</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->
<div class="baseurl" data-baseurl="<?= base_url() ?>"></div>
<div class="flashdata" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div><!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/js/adminlte.js"></script>
<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- summernote -->
<script src="<?= base_url() ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- Datepicker -->
<script src="<?= base_url() ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!-- Datetimepicker -->
<script src="<?= base_url() ?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- Ekko Lightbox -->
<script src="<?= base_url() ?>assets/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Multi select -->
<script src="<?= base_url() ?>assets/plugins/lou-multi-select/js/jquery.multi-select.js"></script>
<!-- Dropzone -->
<script src="<?= base_url() ?>assets/plugins/dropzone/dist/min/dropzone.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Dropify -->
<script src="<?= base_url() ?>assets/plugins/dropify/dropify.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url() ?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script src="<?= base_url() ?>assets/js/custom/<?= $js ?>.js"></script>
<script src="<?= base_url() ?>assets/js/global.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="<?= base_url() ?>assets/js/demo.js"></script>
<script>
$(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
    });
  });
})
</script>
</body>
</html>
