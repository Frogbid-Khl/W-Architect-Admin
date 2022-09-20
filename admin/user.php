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
    <title>Customer - Farm Store</title>
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
                <h1 class="mt-4">Customer</h1>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Customer List
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Country Code</th>
                                        <th>Mobile</th>
                                        <th>password</th>
                                        <th>Total Sell Amount</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sel = $con->query("select * from user");
                                    $i = 0;
                                    while ($row = $sel->fetch_assoc()) {
                                        $i = $i + 1;
                                        ?>
                                        <tr>

                                            <td><?php echo $i;
                                                $id = $row['id'];
                                                ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['ccode']; ?></td>
                                            <td><?php echo $row['mobile']; ?></td>
                                            <td><?php echo $row['password']; ?></td>
                                            <td><?php
                                                $result = $con->query("SELECT SUM(total) as total FROM `orders` where uid = '$id'")->fetch_assoc();
                                                echo $result['total'];
                                                ?> BDT</td>
                                            <td><?php if ($row['status'] == 1) { ?>
                                                    <a href="?status=0&sid=<?php echo $row['id']; ?>"><button class="btn btn-primary"> Make Premium</button></a>
                                                <?php } else { ?>
                                                    <a href="?status=1&sid=<?php echo $row['id']; ?>"><button class="btn btn-danger"> Make Normal</button></a>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <a class="danger" href="?dele=<?php echo $row['id']; ?>"
                                                   data-original-title="" title="">
                                                    <i class="far fa-trash-alt text-danger"></i>
                                                </a>
                                            </td>

                                        </tr>
                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <?php
                        if (isset($_GET['status'])) {
                            $status = $_GET['status'];
                            $id = $_GET['sid'];

                            $con->query("update user set status=" . $status . " where id=" . $id . "");
                            echo '<script type="text/javascript">';
                            echo "setTimeout(function () { swal({title: 'User Status', text: 'User Status Update Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'user.php';});";
                            echo '}, 1000);</script>';
                        }
                        ?>

                        <?php
                        if (isset($_GET['dele'])) {
                            ?>
                            <script type="text/javascript">
                                setTimeout(function() {
                                    swal({
                                            title: "Are you sure?",
                                            text: "You will not be able to recover this subcategory!",
                                            type: "warning",
                                            showCancelButton: true,
                                            confirmButtonClass: "btn-danger",
                                            confirmButtonText: "Yes, delete it!",
                                            cancelButtonText: "No, cancel!",
                                            closeOnConfirm: false,
                                            closeOnCancel: false
                                        },
                                        function(isConfirm) {
                                            if (isConfirm) {

                                                let currentUrl = window.location.href;
                                                let params = (new URL(currentUrl)).searchParams;
                                                let user_id=params.get('dele');
                                                $.ajax({
                                                    type: 'get',
                                                    url: 'delete_data.php',
                                                    data: {
                                                        user_id: user_id
                                                    },
                                                    success: function(data) {
                                                        swal({
                                                            title: 'Customer Delete',
                                                            text: 'Customer Deleted Successfully',
                                                            type: 'error',
                                                            confirmButtonClass: 'btn-danger',
                                                            confirmButtonText: 'OK',
                                                        }, function() {
                                                            window.location = 'user.php';
                                                        });
                                                    }
                                                });

                                            } else {
                                                swal({
                                                    title: 'Cancelled',
                                                    text: 'Your customer is safe :)',
                                                    type: 'error',
                                                    confirmButtonClass: 'btn-success',
                                                    confirmButtonText: 'OK',
                                                }, function() {
                                                    window.location = 'user.php';
                                                });
                                            }
                                        });
                                }, 1000);
                            </script>
                            <?php
                        }
                        ?>

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
