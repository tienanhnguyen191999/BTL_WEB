<?php 
require('../../../repository/UserDAO.php');
require('../../../model/User.php');
require('../../component/mailer.php');
use Repository\UserDAO;
use Model\User;

if ( isset($_GET['id']) ) {
  $mode = 'edit';   
} else {  
  $mode = 'create';
}

// Fix bellow line
// sendInviteMail();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="user.css">
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
  $myUserDao = new userDAO();
  if ($mode == "edit") {
    // Handle edit 
    $user = $myUserDao->getSelected($_GET['id']);
    if ($user->num_rows <= 0) {
      // If user not exists
      header("Location: http://127.0.0.1/admin/users?error=not-found");
    }
    $user = $user->fetch_assoc();

    if (isset($_POST['password'])) {
      if ($_POST['password'] != "") {
        $updatedUser = new User();
        $updatedUser->id = $user['id'];
        $updatedUser->password = $_POST['password'];
        // update password
        $myUserDao->update($updatedUser);
      }
      // redirect
      header("Location: http://127.0.0.1/admin/users?success=update");
    }
  } else {
    // Handle Create 
    if (isset($_POST['password'])) { 
      $newUser = new User();
      $newUser->email = $_POST['email'];
      $newUser->password = $_POST['password'];
      $newUser->role = $_POST['role'];
      $myUserDao->store($newUser);
      // redirect
      header("Location: http://127.0.0.1/admin/users?success=create");
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
                <a href="/admin/users" class="float-left btn btn-secondary btn-flat">
                  <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>  
                <h3 class="card-title mt-2">&nbsp; Quản lý users</h3>
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
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Mật khẩu</label>
                        <input type="password" class="form-control" name="password" placeholder="********">
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                  <?php }else { ?>
                    <!-- Create -->
                    <div class="card-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" name="email" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Mật khẩu</label>
                        <input type="password" class="form-control" name="password" placeholder="********" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" name="re_password" placeholder="********" required>
                      </div>
                      <div class="form-group">
                        <label>Vị trí</label>
                        <select class="form-control" name="role">
                          <option value="1">Khách mời</option>
                          <option value="9">Nhân viên</option>
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
    <script src="users.js"></script>
    <?php if($mode != "edit") {  ?>
      <script src="validate.js"></script>
    <?php } ?>
</body>
</html>