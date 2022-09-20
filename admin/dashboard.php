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
    <title>Dashboard - Farm Store</title>
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
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Total Category</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <p class="small text-white stretched-link">
                                    <?php
                                    $row_count = $db_handle->numRows("SELECT * FROM category order by id desc");
                                    echo $row_count;
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body">Total Contact</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <p class="small text-white stretched-link">
                                    <?php
                                    $row_count = $db_handle->numRows("SELECT * FROM contact order by id desc");
                                    echo $row_count;
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">Total Portfolio Images</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <p class="small text-white stretched-link">
                                    <?php
                                    $row_count = $db_handle->numRows("SELECT * FROM portfolio order by id desc");
                                    echo $row_count;
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body">Total Review</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <p class="small text-white stretched-link">
                                    <?php
                                    $row_count = $db_handle->numRows("SELECT * FROM review order by id desc");
                                    echo $row_count;
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include('include/footer.php') ?>
    </div>
</div>
<?php include('include/jslist.php') ?>
</body>
</html>
