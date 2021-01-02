<?php 
session_start();
require('../../../repository/ConferenceDAO.php');
require('../../../model/Hoithao.php');

use Repository\ConferenceDAO;
use Model\Hoithao;

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
  $myConferenceDAO = new ConferenceDAO();
  if ($mode == "edit") {
    // Handle edit 
    $ht = $myConferenceDAO->getSelected($_GET['id']);
    if ($ht->num_rows <= 0) {
      // If user not exists
      header("Location: http://127.0.0.1/admin/hoithao?error=not-found");
    }
    $ht = $ht->fetch_assoc();

    if (isset($_POST['name'])) {
        $updatedHt = new Hoithao();
        $updatedHt->id = $ht['id'];
        $updatedHt->name = $_POST['name'];
        $updatedHt->diadiem = $_POST['diadiem'];
        $updatedHt->thoigian = $_POST['thoigian'];
        $updatedHt->nhataitro_id = $_POST['nhataitro_id'];
        // update password
        $myConferenceDAO->update($updatedHt);
      // redirect
      header("Location: http://127.0.0.1/admin/hoithao?success=update");
    }
  } else {
    // Handle Create 
    if (isset($_POST['name'])) { 
      $newHt = new Hoithao();
      $newHt->name = $_POST['name'];
      $newHt->diadiem = $_POST['diadiem'];
      $newHt->thoigian = $_POST['thoigian'];
      $newHt->nhataitro_id = $_POST['nhataitro_id'];
      $myConferenceDAO->store($newHt);
      // redirect
      header("Location: http://127.0.0.1/admin/hoithao?success=create");
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
                <a href="/admin/hoithao" class="float-left btn btn-secondary btn-flat">
                  <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>  
                <h3 class="card-title mt-2">&nbsp; Quản lý Nhà tài trợ</h3>
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
                        <label for="exampleInputEmail1">Tên hội thảo</label>
                        <input type="text" class="form-control" name="name" value="<?= $ht['name'] ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Địa điểm</label>
                        <input type="text" class="form-control" name="diadiem" value="<?= $ht['diadiem'] ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Thời gian</label>
                        <input type="text" class="form-control" name="thoigian" id="thoigian" value="<?= $ht['thoigian'] ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Nhà tài trợ</label>
                        <select type="text" class="form-control" name="nhataitro_id" id="nhataitro_id">
                          <?php 
                          foreach ($_SESSION['listNhataitro'] as $key => $value) { ?>  
                            <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $ht['nhataitro_id']) echo "selected='selected'"?> ><?= $value['name'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                  <?php }else { ?>
                    <!-- Create -->
                    <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên hội thảo</label>
                        <input type="text" class="form-control" name="name" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Địa điểm</label>
                        <input type="text" class="form-control" name="diadiem" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Thời gian</label>
                        <input type="text" class="form-control" name="thoigian" id="thoigian" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Nhà tài trợ</label>
                        <select type="text" class="form-control" name="nhataitro_id" id="nhataitro_id">
                          <?php 
                          foreach ($_SESSION['listNhataitro'] as $key => $value) { ?>  
                            <option value="<?= $value['id']?>" ><?= $value['name'] ?></option>
                          <?php } ?>
                        </select>
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
    <!-- Jquery -->
    <script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
    <!-- Moment.js -->
    <script src="../../../plugins/moment/moment.min.js"></script>
    <!-- Toast -->
    <script src="../../../plugins/toastr/toastr.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <!-- date-range-picker -->
    <script src="../../../plugins/daterangepicker/daterangepicker.js"></script>
    <script src="edit.js"></script>
</body>
</html>