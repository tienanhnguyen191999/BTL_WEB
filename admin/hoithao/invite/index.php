<?php
session_start();
require_once('../../../repository/UserDAO.php');
require_once('../../../repository/ConferenceDAO.php');
require_once('../../../repository/HotelDAO.php');

use Repository\ConferenceDAO;
use Repository\UserDAO;
use Repository\HotelDAO;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="invite.css">
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
    if (!isset($_GET['id'])){
        header("Location: http://127.0.0.1/admin/hoithao");
    }

    $myUserDao = new userDAO();
    $users = $myUserDao->getAll();

    $myConferenceDAO = new ConferenceDAO();
    $hoithao = $myConferenceDAO->getSelected($_GET['id']);
    
    $myHotelDAO = new HotelDAO();
    $hotels = $myHotelDAO->getAll();
    $myHotels = [];
    while($hotel = $hotels->fetch_assoc()) {
        $myHotels[] = $hotel;
    }
?>
<body>
    <div class="wrapper">
        <?php include "../../component/navbar.php"?>
        <?php include "../../component/sidebar.php"?>
        <?php include "../../component/loading.php"?>

        <div class="main-content content-wrapper">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Mời khách tham gia hội thảo</h3>
                    <a href="/admin/users/edit" class="float-right btn btn-primary btn-flat">
                    <i class="fa fa-plus" aria-hidden="true"></i> Tạo mới
                    </a>  
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="main-table" data-id="<?= $_GET['id'] ?>" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($user = $users->fetch_assoc()) {
                                if ($user['role'] == 1){ 
                            ?>
                            <tr class="invite-user" data-id="<?= $user['id'] ?>">
                                <td><?php echo $user['id'] ?></td>
                                <td><?php echo $user['email'] ?></td>                     
                                <td>
                                    <select name="hotel" class="form-control hotel">
                                        <?php foreach ($myHotels as $key => $value) { ?>
                                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <?php }}?>
                        </tbody>
                    </table>
                    <button class="send-invite-btn float-right mt-2 btn btn-success btn-flat">Gửi email tham dự</button>
                </div>
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
    <!-- Bootstrap 4 -->
    <script src="../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="invite.js"></script>
</body>
</html>