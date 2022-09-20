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
                    <?php
                    if ($username == 0) {
                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Total Category</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <p class="small text-white stretched-link">
                                        <?php echo $con->query("select * from category")->num_rows; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Total Subcategory</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <p class="small text-white stretched-link">
                                        <?php echo $con->query("select * from subcategory")->num_rows; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">Total Product</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <p class="small text-white stretched-link">
                                        <?php echo $con->query("select * from product")->num_rows; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">Total Customer</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <p class="small text-white stretched-link">
                                        <?php echo $con->query("select * from user")->num_rows; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-info text-white mb-4">
                                <div class="card-body">Pending Order</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <p class="small text-white stretched-link">
                                        <?php echo $con->query("select * from orders where status='pending'")->num_rows; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Complete Order</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <p class="small text-white stretched-link">
                                        <?php echo $con->query("select * from orders where status='completed'")->num_rows; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Canceled Order</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <p class="small text-white stretched-link">
                                        <?php echo $con->query("select * from orders where status='cancelled'")->num_rows; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">Total Sales</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <p class="small text-white stretched-link">
                                        <?php $sales = $con->query("select sum(total) as full_total from orders where status='completed'")->fetch_assoc();

                                        if ($sales['full_total'] == '') {
                                            echo 0;
                                        } else {
                                            echo $sales['full_total'];
                                        } ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php
                    } else if ($username == 1) {
                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Total Category</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <p class="small text-white stretched-link">
                                        <?php echo $con->query("select * from category")->num_rows; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Total Subcategory</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <p class="small text-white stretched-link">
                                        <?php echo $con->query("select * from subcategory")->num_rows; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">Total Product</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <p class="small text-white stretched-link">
                                        <?php echo $con->query("select * from product")->num_rows; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">Pending Order</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <p class="small text-white stretched-link">
                                        <?php echo $con->query("select * from orders where status='pending'")->num_rows; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Complete Order</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <p class="small text-white stretched-link">
                                        <?php echo $con->query("select * from orders where status='completed'")->num_rows; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Canceled Order</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <p class="small text-white stretched-link">
                                        <?php echo $con->query("select * from orders where status='cancelled'")->num_rows; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </main>
        <?php include('include/footer.php') ?>
    </div>
</div>
<?php include('include/jslist.php') ?>
</body>
</html>
