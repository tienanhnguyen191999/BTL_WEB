<?php 
require('../../../repository/HotelDAO.php');
require('../../../model/Khachsan.php');
use Repository\HotelDAO;
use Model\Khachsan;

if ( isset($_GET['id']) ) {
  $mode = 'edit';   
} else {  
  $mode = 'create';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="edit.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../../../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../../../plugins/summernote/summernote-bs4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../../../plugins/toastr/toastr.min.css">
</head>
<?php 
  $myHotelDAO = new HotelDAO();
  if ($mode == "edit") {
    // Handle edit 
    $ks = $myHotelDAO->getSelected($_GET['id']);
    if ($ks->num_rows <= 0) {
      // If user not exists
      header("Location: http://127.0.0.1/admin/khachsan?error=not-found");
    }
    $ks = $ks->fetch_assoc();

    if (isset($_POST['name'])) {
        $updatedKs = new Khachsan();
        $updatedKs->id = $ks['id'];
        $updatedKs->name = $_POST['name'];
        $updatedKs->des = $_POST['des'];
        // update password
        $myHotelDAO->update($updatedKs);
      // redirect
      header("Location: http://127.0.0.1/admin/khachsan?success=update");
    }
  } else {
    // Handle Create 
    if (isset($_POST['name'])) { 
      $newKs = new Khachsan();
      $newKs->name = $_POST['name'];
      $newKs->des = $_POST['des'];
      $myHotelDAO->store($newKs);
      // redirect
      header("Location: http://127.0.0.1/admin/khachsan?success=create");
    }
  }
?>
<body>
    <div class="wrapper">   
        <?php include("../../component/navbar.php") ?>
        <?php include("../../component/sidebar.php") ?>
        <div class="main-content content-wrapper">
          <div class="card">
              <div class="card-header">
                <a href="/admin/khachsan" class="float-left btn btn-secondary btn-flat">
                  <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>  
                <h3 class="card-title mt-2">&nbsp; Quản lý khách sạn</h3>
              </div>
              <!-- Create or Edit  -->
              <div class="card-body w-75 m-auto">
                <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Thay đổi thông tin</h3>
                </div>
                <form action="#" method="POST" id="main-form">
                  
                  <?php if ($mode == 'edit') {?>
                    <!-- Edit -->
                    <div class="card-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tên Khách sạn</label>
                        <input type="text" class="form-control" name="name" value="<?= $ks['name'] ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả</label>
                        <input type="text" class="form-control" name="des" value="<?= $ks['des'] ?>">
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                  <?php }else { ?>
                    <!-- Create -->
                    <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên Khách sạn</label>
                        <input type="text" class="form-control" name="name" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả</label>
                        <input type="text" class="form-control" name="des">
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Tạo mới</button>
                    </div>
                  <?php } ?>
                </form>
              </div>
              </div>
              <!-- Create or Edit  -->
            </div>
        </div>
    </div>
    <script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
    <!-- Toast -->
    <script src="../../../plugins/toastr/toastr.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="edit.js"></script>
</body>
</html>