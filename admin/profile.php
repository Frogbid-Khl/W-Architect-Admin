<?php include('../include/dbconfig.php') ?>
<?php include('include/session.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Profile - Farm Store</title>
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
                                            <strong>Update Profile</strong>
                                        </h4>
                                        <form id="form-validation-simple" name="form-validation-simple" method="POST" enctype="multipart/form-data">

                                            <?php
                                            $getkey = $con->query("select * from admin")->fetch_assoc();
                                            ?>

                                            <div class="form-group">
                                                <label for="cname">Username</label>
                                                <input type="text" id="cname" class="form-control" name="username" value="<?php echo $getkey['username']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="cname">Password</label>
                                                <input type="password" id="password" class="form-control" name="password" value="<?php echo $getkey['password']; ?>" required>
                                            </div>

                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-success mr-2 px-5" name="sub_cat">Update Profile</button>
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
                    $username = $_POST['username'];
                    $password = $_POST['password'];


                    $con->query("update admin set username='" . $username . "',password='" . $password . "' where id=1");
                    echo '<script type="text/javascript">';
                    echo "setTimeout(function () { swal({title: 'Update Profile', text: 'Update Profile Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'profile.php';});";
                    echo '}, 1000);</script>';
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
