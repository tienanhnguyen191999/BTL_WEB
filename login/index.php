<?php 
session_start();
require('../repository/UserDAO.php');
require_once('../model/User.php');
use Repository\UserDAO;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
</head>

<?php
    if (isset($_SESSION['user'])){
      header("Location: http://127.0.0.1/admin/users");
    }

    // logic for login
    if (isset($_POST['email'])){
        $myUserDAO = new UserDAO();
        $user = $myUserDAO->login($_POST['email'], $_POST['password']);
        if (isset($user->id)) {
            // Not ADMIN [1 => User, 2 => Admin]
            if ($user->role == 1) {
                header("Location: http://127.0.0.1/login?error=403");    
                die();
            } 

            $_SESSION['user'] = $user;
            header("Location: http://127.0.0.1/admin/users");
            die();
        } else {
            header("Location: http://127.0.0.1/login?error=not-login");    
        }
    }
?>



<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <h3 class="login-box-msg">Đăng nhập</h3>

      <form action="#" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email..." required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Mật khẩu..." required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            
          </div>
          <!-- /.col -->
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">Quên mật khẩu ?</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Toast -->
<script src="../../plugins/toastr/toastr.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<script>
    $(document).ready(function () {
        <?php 
            if (isset($_GET['error'])){
                if ($_GET['error'] == 'not-login'){ ?> 
                    toastr.error("Email hoặc mật khẩu sai");
                <?php } else if ($_GET['error'] == '403'){ ?>
                    toastr.error("User không có quyền truy cập tài nguyên");
                <?php } else if ($_GET['error'] == 'logout') {  ?>
                    toastr.warning("Đăng xuất thành công !!!");
                <?php }
            }    
            ?>
    })
</script>
</body>
</html>
