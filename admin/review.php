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
    <title>Review - Nirman</title>

    <?php include('include/csslist.php') ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

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
                <h1 class="mt-4">Review</h1>
                <?php if (isset($_GET['edit'])) {

                    $data = $db_handle->runQuery("SELECT * FROM review where id={$_GET['edit']}");

                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-lg-12 mb-5">
                                            <h4 class="mb-4">
                                                <strong>Edit Status</strong>
                                            </h4>
                                            <form id="form-validation-simple" name="form-validation-simple"
                                                  method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label class="form-label">Status</label>
                                                    <select name="scat" class="form-control select2"
                                                            data-validation="[NOTEMPTY]" required>
                                                        <option value="1" <?php if ($data[0]["status"] == 1) {
                                                            echo 'selected';
                                                        } ?>>Publish</option>
                                                        <option value="0" <?php if ($data[0]["status"] == 0) {
                                                            echo 'selected';
                                                        } ?>>Unpublished</option>
                                                    </select>
                                                </div>
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-success mr-2 px-5"
                                                            name="up_rev">Update Review Status
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['up_rev'])) {
                        $status = $_POST['status'];

                        $update = $db_handle->insertQuery("update review set stats='$status' where id=" . $_GET['edit'] . "");

                        echo '<script type="text/javascript">';
                        echo "setTimeout(function () { swal({title: 'Review Edit', text: 'Review Edited Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'review.php';});";
                        echo '}, 1000);</script>';
                    }
                    ?>

                <?php } ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Review List
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Message</th>
                                        <th>Star</th>
                                        <th>Status</th>
                                        <th>Time</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $data = $db_handle->runQuery("SELECT * FROM review order by id desc");
                                    $row_count = $db_handle->numRows("SELECT * FROM review order by id desc");
                                    for ($i = 0; $i < $row_count; $i++) {
                                        ?>
                                        <tr>

                                            <td><?php echo $i + 1; ?></td>
                                            <td><?php echo $data[$i]["name"]; ?></td>
                                            <td><?php echo $data[$i]["email"]; ?></td>
                                            <td><?php echo $data[$i]["phone"]; ?></td>
                                            <td><?php echo $data[$i]["message"]; ?></td>
                                            <td><?php echo $data[$i]["star"]; ?></td>
                                            <td><?php echo $data[$i]["status"]; ?></td>
                                            <td>
                                                <?php

                                                $datetime = new DateTime($data[$i]["inserted_at"]);
                                                $la_time = new DateTimeZone('Asia/Dhaka');
                                                $datetime->setTimezone($la_time);

                                                echo $datetime->format('d/m/Y h:i A'); ?>
                                            </td>
                                            <td>
                                                <a class="primary"
                                                   href="category.php?edit=<?php echo $data[$i]['id']; ?>"
                                                   data-original-title="" title="" style="text-decoration: none">
                                                    <i class="fas fa-edit text-info"></i>
                                                </a>
                                                <a href="?del=<?php echo $data[$i]["id"]; ?>"
                                                   style="text-decoration: none"><i
                                                            class="fa-solid fa-trash ml-3 text-danger"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
        <?php
        if (isset($_GET['del'])) {
            ?>
            <script type="text/javascript">
                setTimeout(function () {
                    swal({
                            title: "Are you sure?",
                            text: "You will not be able to recover this review!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "No, cancel!",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        },
                        function (isConfirm) {
                            if (isConfirm) {

                                let currentUrl = window.location.href;
                                let params = (new URL(currentUrl)).searchParams;
                                let review_id = params.get('dele');
                                $.ajax({
                                    type: 'get',
                                    url: 'delete_data.php',
                                    data: {
                                        review_id: review_id
                                    },
                                    success: function (data) {
                                        swal({
                                            title: 'Review Delete',
                                            text: 'Review Deleted Successfully',
                                            type: 'error',
                                            confirmButtonClass: 'btn-danger',
                                            confirmButtonText: 'OK',
                                        }, function () {
                                            window.location = 'review.php';
                                        });
                                    }
                                });

                            } else {
                                swal({
                                    title: 'Cancelled',
                                    text: 'Your review is safe :)',
                                    type: 'error',
                                    confirmButtonClass: 'btn-success',
                                    confirmButtonText: 'OK',
                                }, function () {
                                    window.location = 'review.php';
                                });
                            }
                        });
                }, 1000);
            </script>
            <?php
        }
        ?>

        <?php include('include/footer.php') ?>
    </div>
</div>
<?php include('include/jslist.php') ?>
</body>
</html>
