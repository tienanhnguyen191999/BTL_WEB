<?php 
require('../../repository/NhataitroDAO.php');
use Repository\NhataitroDAO;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="nhataitro.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../../../plugins/toastr/toastr.min.css">
</head>
<?php 
 
  $myNhataitroDao = new NhataitroDAO();
  $nhataitros = $myNhataitroDao->getAll();
?>
<body>
    <div class="wrapper">   
        <?php include("../component/navbar.php") ?>
        <?php include("../component/sidebar.php") ?>
        <?php include("../component/deleteModal.php") ?>
        <div class="main-content content-wrapper">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Quản lý users</h3>
                <a href="/admin/nhataitro/edit" class="float-right btn btn-primary btn-flat">
                  <i class="fa fa-plus" aria-hidden="true"></i> Tạo mới
                </a>  
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="main-table" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Mô tả</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                  <tbody>
                  <?php while( $nhataitro = $nhataitros->fetch_assoc()) { ?>
                      <tr>
                        <td><?php echo $nhataitro['id'] ?></td>
                        <td><?php echo $nhataitro['name'] ?></td>
                        <td ><?php echo $nhataitro['des'] ?></td>
                        <td style="width: 70px">
                          <a href="<?php echo "edit?id=${nhataitro['id']}" ?>" class="btn btn-block bg-gradient-warning btn-flat">
                            <i class="fas fa-edit"></i>
                          </a>
                        </td>
                        <td style="width: 70px">
                          <a data-toggle="modal" data-target="#modal-danger" data-id="<?= $nhataitro['id'] ?>" class="btn delete-btn btn-block bg-gradient-danger btn-flat">
                            <i class="fas fa-times"></i>
                          </a>
                        </td>
                        </p>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <!-- Toast -->
    <script src="../../plugins/toastr/toastr.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="nhataitro.js"></script>
</body>
</html>