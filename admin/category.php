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
    <title>Category - Nirman</title>
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
                <h1 class="mt-4">Category</h1>
                <?php if (isset($_GET['edit'])) {

                    $data = $db_handle->runQuery("SELECT * FROM category where id={$_GET['edit']}");

                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-lg-12 mb-5">
                                            <h4 class="mb-4">
                                                <strong>Edit Catagory</strong>
                                            </h4>
                                            <form id="form-validation-simple" name="form-validation-simple"
                                                  method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label class="form-label">Category Name</label>
                                                    <input name="Category_Name" type="text"
                                                           value="<?php echo $data[0]["c_name"];; ?>"
                                                           class="form-control"
                                                           data-validation="[NOTEMPTY]" required/>
                                                </div>
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-success mr-2 px-5"
                                                            name="up_cat">Update Category
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
                    if (isset($_POST['up_cat'])) {
                        $cname = $db_handle->checkValue($_POST['Category_Name']);

                        $rows = $db_handle->numRows("SELECT * FROM category where c_name='$cname'");

                        if ($rows == 0) {
                            $update = $db_handle->insertQuery("update category set c_name='$cname' where id=" . $_GET['edit'] . "");

                            echo '<script type="text/javascript">';
                            echo "setTimeout(function () { swal({title: 'Catagory Edit', text: 'Catagory Edited Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'category.php';});";
                            echo '}, 1000);</script>';
                        } else {
                            echo '<script type="text/javascript">';
                            echo "setTimeout(function () { swal({title: 'Catagory Edit', text: 'Duplicate Category', type: 'error', confirmButtonClass: 'btn-danger', confirmButtonText: 'OK', });";
                            echo '}, 1000);</script>';
                        }
                    }
                    ?>

                <?php } else { ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-lg-12 mb-5">
                                            <h4 class="mb-4">
                                                <strong>Add Category</strong>
                                            </h4>
                                            <form id="form-validation-simple" name="form-validation-simple"
                                                  method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label class="form-label">Category Name</label>
                                                    <input name="Category_Name" type="text" class="form-control"
                                                           data-validation="[NOTEMPTY]" required/>
                                                </div>
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-success mr-2 px-5"
                                                            name="sub_cat">Save Category
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php
                if (isset($_POST['sub_cat'])) {
                    $cname = $db_handle->checkValue($_POST['Category_Name']);

                    $rows = $db_handle->numRows("SELECT * FROM category where c_name='$cname'");

                    if ($rows == 0) {

                        $insert = $db_handle->insertQuery("INSERT INTO `category`(`c_name`) VALUES ('$cname')");

                        echo '<script type="text/javascript">';
                        echo "setTimeout(function () { swal({title: 'Catagory Add', text: 'Catagory Added Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', });";
                        echo '}, 1000);</script>';
                    } else {
                        echo '<script type="text/javascript">';
                        echo "setTimeout(function () { swal({title: 'Catagory Add', text: 'Duplicate Category', type: 'error', confirmButtonClass: 'btn-danger', confirmButtonText: 'OK', });";
                        echo '}, 1000);</script>';
                    }

                }

                ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Category List
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Category Name</th>
                                        <th>Total Portfolio</th>
                                        <th>Time</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $data = $db_handle->runQuery("SELECT * FROM category order by id desc");
                                    $row_count = $db_handle->numRows("SELECT * FROM category order by id desc");
                                    for ($i = 0; $i < $row_count; $i++) {
                                        ?>
                                        <tr>

                                            <td><?php echo $i + 1; ?></td>
                                            <td><?php echo $data[$i]["c_name"]; ?></td>
                                            <td>
                                                <?php
                                                $num_of_images = $db_handle->numRows("SELECT * FROM portfolio where category_id=" . $data[$i]['id'] . "");
                                                echo $num_of_images;
                                                ?>
                                            </td>
                                            <td>
                                                <?php

                                                $datetime = new DateTime($data[$i]["inserted_at"]);
                                                $la_time = new DateTimeZone('Asia/Dhaka');
                                                $datetime->setTimezone($la_time);

                                                echo $datetime->format('d/m/Y h:i A'); ?>
                                            </td>
                                            <td class="text-center">
                                                <a class="primary"
                                                   href="category.php?edit=<?php echo $data[$i]['id']; ?>"
                                                   data-original-title="" title="" style="text-decoration: none">
                                                    <i class="fas fa-edit text-info"></i>
                                                </a>
                                                <?php
                                                if ($num_of_images == 0) {
                                                    ?>
                                                    <a class="danger" href="?dele=<?php echo $data[$i]['id']; ?>"
                                                       data-original-title="" title="" style="text-decoration: none">
                                                        <i class="far fa-trash-alt text-danger"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <?php
                        if (isset($_GET['dele'])) {
                            ?>
                            <script type="text/javascript">
                                setTimeout(function () {
                                    swal({
                                            title: "Are you sure?",
                                            text: "You will not be able to recover this category!",
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
                                                let category_id = params.get('dele');
                                                $.ajax({
                                                    type: 'get',
                                                    url: 'delete_data.php',
                                                    data: {
                                                        category_id: category_id
                                                    },
                                                    success: function (data) {
                                                        swal({
                                                            title: 'Category Delete',
                                                            text: 'Category Deleted Successfully',
                                                            type: 'error',
                                                            confirmButtonClass: 'btn-danger',
                                                            confirmButtonText: 'OK',
                                                        }, function () {
                                                            window.location = 'category.php';
                                                        });
                                                    }
                                                });

                                            } else {
                                                swal({
                                                    title: 'Cancelled',
                                                    text: 'Your category is safe :)',
                                                    type: 'error',
                                                    confirmButtonClass: 'btn-success',
                                                    confirmButtonText: 'OK',
                                                }, function () {
                                                    window.location = 'category.php';
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
