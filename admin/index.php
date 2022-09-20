<?php
session_start();
require_once("../include/dbcontroller.php");
$db_handle = new DBController();
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
}?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - Farm Store</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="inputEmail" id="inputEmail" type="text" placeholder="username" />
                                                <label for="inputEmail">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="inputPass" id="inputPassword" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" type="submit" name="sub_log">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <?php include('include/footer.php') ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
<?php
if (isset($_POST['sub_log'])) {
    $email = $db_handle->checkValue($_POST['inputEmail']);
    $password = $db_handle->checkValue($_POST['inputPass']);

    $login = $db_handle->numRows("SELECT * FROM admin_login WHERE email='$email' and password='$password'");

    $login_data = $db_handle->runQuery("SELECT * FROM admin_login WHERE email='$email' and password='$password'");

    if($login==1){
        $_SESSION['user_id']=$login_data[0]["id"];
        $_SESSION['name']=$login_data[0]["name"];
        $_SESSION['role']=$login_data[0]["role"];
        $_SESSION['image']=$login_data[0]["image"];

        ?>
        <script>
            window.location.href = "dashboard.php";
        </script>
        <?php
    }else{
        ?>
        <script>
            alert('email address and password wrong!');
        </script>
        <?php
    }
}
?>
