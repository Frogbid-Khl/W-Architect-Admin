<?php
session_start();
include('../include/dbController.php');
$db_handle = new DBController();
?>
<?php include('include/session.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Setting - Nirman</title>
    <?php include('include/csslist.php') ?>
</head>
<body class="sb-nav-fixed">
<?php include('include/topbar.php') ?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php include('include/sidebar.php') ?>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Profile</h1>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-12 mb-5">
                                        <h4 class="mb-4">
                                            <strong>Update Password</strong>
                                        </h4>
                                        <form id="form-validation-simple" name="form-validation-simple" method="POST" enctype="multipart/form-data">

                                            <div class="form-group">
                                                <label for="cname">Old Password</label>
                                                <input type="password" id="password" class="form-control" name="old_password" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="cname">New Password</label>
                                                <input type="password" id="password" class="form-control" name="new_password" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="cname">Password</label>
                                                <input type="password" id="password" class="form-control" name="confirm_password" required>
                                            </div>

                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-success mr-2 px-5" name="sub_cat">Update Password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($_POST['sub_cat'])) {
                    $old_password =  $db_handle->checkValue($_POST['old_password']);
                    $new_password =  $db_handle->checkValue($_POST['new_password']);
                    $confirm_password =  $db_handle->checkValue($_POST['confirm_password']);

                    if($old_password==$new_password&&$new_password==$confirm_password){
                        $update = $db_handle->insertQuery("update admin_login set password='$new_password' where id=" . $_SESSION['user_id'] . "");

                        echo '<script type="text/javascript">';
                        echo "setTimeout(function () { swal({title: 'Update Password', text: 'Update Password Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'setting.php';});";
                        echo '}, 1000);</script>';
                    }else{
                        echo '<script type="text/javascript">';
                        echo "setTimeout(function () { swal({title: 'Password Mismatch', text: 'Password Update not Successfully', type: 'error', confirmButtonClass: 'btn-danger', confirmButtonText: 'OK', },function() {window.location = 'setting.php';});";
                        echo '}, 1000);</script>';
                    }
                }
                ?>
            </div>
        </main>
        <?php include('include/footer.php') ?>
    </div>
</div>
<?php include('include/jslist.php') ?>
</body>
</html>
