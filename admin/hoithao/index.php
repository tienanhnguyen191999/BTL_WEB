<?php 
session_start();
require('../../repository/NhataitroDAO.php');
require('../../repository/ConferenceDAO.php');

use Repository\ConferenceDAO;
use Repository\NhataitroDAO;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="hoithao.css">
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

  $myConferenceDAO = new ConferenceDAO();
  
  $myNhataitroDAO = new NhataitroDAO();
  // die();
  $listHoiThao = $myConferenceDAO->getAll();
  
  $listNhataitro = [];
  $result = $myNhataitroDAO->getAll();
  while( $hoithao = $result->fetch_assoc()) {
    $listNhataitro[] = $hoithao;  
  }
  $_SESSION['listNhataitro'] = $listNhataitro; 
  function getNhataitroById($id)
  {
    if (isset($_SESSION['listNhataitro']))
    foreach ($_SESSION['listNhataitro'] as $key => $value) {
      if ($value['id'] == $id) {
        return $value['name'];
      } 
    }
    return "";
  }
?>
<body>
    <div class="wrapper">   
        <?php include("../component/navbar.php") ?>
        <?php include("../component/sidebar.php") ?>
        <?php include("../component/deleteModal.php") ?>
        <div class="main-content content-wrapper">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Quản lý hội thảo</h3>
                <a href="/admin/hoithao/edit" class="float-right ml-3 btn btn-primary btn-flat">
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
                            <th>Địa điểm</th>
                            <th>Thời gian</th>
                            <th>Nhà tài trợ</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                  <tbody>
                  <?php while( $hoithao = $listHoiThao->fetch_assoc()) { ?>
                      <tr>
                        <td><?= $hoithao['id'] ?></td>
                        <td><?= $hoithao['name'] ?></td>
                        <td><?= $hoithao['diadiem'] ?></td>
                        <td><?= $hoithao['thoigian'] ?></td>
                        <td><?= getNhataitroById($hoithao['nhataitro_id']) ?></td>
                        <td style="width: 70px">
                          <a href="<?= "invite?id=${hoithao['id']}" ?>" class="btn btn-block bg-gradient-primary btn-flat">
                            <i class="fas fa-plus"></i>
                          </a>
                        </td>
                        <td style="width: 70px" >
                          <a href="<?= "edit?id=${hoithao['id']}" ?>" class="btn btn-block bg-gradient-warning btn-flat">
                            <i class="fas fa-edit"></i>
                          </a>
                        </td>
                        <td style="width: 70px">
                          <a data-toggle="modal" data-target="#modal-danger" data-id="<?= $hoithao['id'] ?>" class="btn delete-btn btn-block bg-gradient-danger btn-flat">
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
    <script src="hoithao.js"></script>
</body>
</html>