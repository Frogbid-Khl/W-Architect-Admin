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
    <title>Portfolio - Nirman</title>
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
                <h1 class="mt-4">Portfolio</h1>
                <?php if (isset($_GET['edit'])) {

                    $data = $db_handle->runQuery("SELECT * FROM portfolio where id={$_GET['edit']}");

                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-lg-12 mb-5">
                                            <h4 class="mb-4">
                                                <strong>Edit Portfolio</strong>
                                            </h4>
                                            <form id="form-validation-simple" name="form-validation-simple"
                                                  method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label class="form-label">Select A Category</label>
                                                    <select name="scat" class="form-control select2"
                                                            data-validation="[NOTEMPTY]" required>
                                                        <option value="0">Select A Category</option>
                                                        <?php
                                                        $cat = $db_handle->runQuery("SELECT * FROM category order by id desc");
                                                        $row_count = $db_handle->numRows("SELECT * FROM category order by id desc");
                                                        for ($i = 0; $i < $row_count; $i++) {
                                                            ?>
                                                            <option value="<?php echo $cat[$i]["id"]; ?>" <?php if ($cat[$i]["id"] == $data[0]["category_id"]) {
                                                                echo 'selected';
                                                            } ?>><?php echo $cat[$i]["c_name"]; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Caption</label>
                                                    <input name="caption" value="<?php echo $data[0]["caption"]; ?>"
                                                           type="text"
                                                           class="form-control" data-validation="[NOTEMPTY]" required/>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Subcategory Image</label>
                                                    <div class="mb-5">
                                                        <input type="file" name="f_up" class="dropify" data-height="300"
                                                               data-validation="[NOTEMPTY]"
                                                               data-default-file="../<?php echo $data[0]["image"]; ?>"/>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-success mr-2 px-5"
                                                            name="up_cat">Update Subcategory
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
                        $caption = $db_handle->checkValue($_POST['caption']);

                        $cid = $_POST['scat'];

                        if (!empty($_FILES["f_up"]["name"])) {
                            $fileName = $_FILES['f_up']['tmp_name'];
                            $sourceProperties = getimagesize($fileName);
                            $resizeFileName = time();
                            $uploadPath = "portfolio/";
                            $fileExt = pathinfo($_FILES['f_up']['name'], PATHINFO_EXTENSION);

                            $url = '../' . $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                            move_uploaded_file($fileName, $url);

                            $url = $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;


                            $update = $db_handle->insertQuery("update portfolio set caption='$caption',image='$url',category_id='$cid' where id=" . $_GET['edit'] . "");

                        } else {
                            $update = $db_handle->insertQuery("update portfolio set caption='$caption',category_id='$cid' where id=" . $_GET['edit'] . "");
                        }
                        echo '<script type="text/javascript">';
                        echo "setTimeout(function () { swal({title: 'Portfolio Edit', text: 'Portfolio Edited Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'portfolio.php';});";
                        echo '}, 1000);</script>';
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
                                                <strong>Add Portfolio</strong>
                                            </h4>
                                            <form id="form-validation-simple" name="form-validation-simple"
                                                  method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label class="form-label">Select A Category</label>
                                                    <select name="scat" class="form-control select2"
                                                            data-validation="[NOTEMPTY]" required>
                                                        <option value="0">Select A Category</option>
                                                        <?php
                                                        $cat = $db_handle->runQuery("SELECT * FROM category order by id desc");
                                                        $row_count = $db_handle->numRows("SELECT * FROM category order by id desc");
                                                        for ($i = 0; $i < $row_count; $i++) {
                                                            ?>
                                                            <option value="<?php echo $cat[$i]["id"]; ?>"><?php echo $cat[$i]["c_name"]; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Caption</label>
                                                    <input name="caption" type="text" class="form-control"
                                                           data-validation="[NOTEMPTY]" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Subcategory Image</label>
                                                    <div class="mb-5">
                                                        <input type="file" name="f_up" class="dropify" data-height="300"
                                                               data-validation="[NOTEMPTY]" required/>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-success mr-2 px-5"
                                                            name="sub_cat">Save Portfolio
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
                    if (isset($_POST['sub_cat'])) {
                        $caption = $db_handle->checkValue($_POST['caption']);
                        $cid = $_POST['scat'];


                        $fileName = $_FILES['f_up']['tmp_name'];
                        $sourceProperties = getimagesize($fileName);
                        $resizeFileName = time();
                        $uploadPath = "portfolio/";
                        $fileExt = pathinfo($_FILES['f_up']['name'], PATHINFO_EXTENSION);

                        $url = '../' . $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                        move_uploaded_file($fileName, $url);

                        $url = $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;

                        $insert = $db_handle->insertQuery("INSERT INTO `portfolio`(`category_id`, `image`, `caption`) VALUES ('$cid','$url','$caption')");

                        echo '<script type="text/javascript">';
                        echo "setTimeout(function () { swal({title: 'Portfolio Add', text: 'Portfolio Added Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'portfolio.php';});";
                        echo '}, 1000);</script>';
                    }
                    ?>

                <?php } ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Portfolio List
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Category Name</th>
                                        <th>Caption</th>
                                        <th class="text-center">Portfolio Image</th>
                                        <th>Time</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $data = $db_handle->runQuery("SELECT * FROM portfolio order by id desc");
                                    $row_count = $db_handle->numRows("SELECT * FROM portfolio order by id desc");
                                    for ($i = 0; $i < $row_count; $i++) {
                                        ?>
                                        <tr>

                                            <td><?php echo $i; ?></td>
                                            <td>
                                                <?php
                                                $category = $db_handle->runQuery("SELECT * FROM category where id=" . $data[$i]['category_id'] . "");
                                                echo $category[0]['c_name'];
                                                ?>
                                            </td>
                                            <td><?php echo $data[$i]["caption"]; ?></td>
                                            <td class="text-center"><img class="media-object round-media"
                                                                         src="../<?php echo $data[$i]["image"]; ?>"
                                                                         alt="Generic placeholder image"
                                                                         style="height: 75px;"></td>
                                            <td>
                                                <?php

                                                $datetime = new DateTime($data[$i]["inserted_at"]);
                                                $la_time = new DateTimeZone('Asia/Dhaka');
                                                $datetime->setTimezone($la_time);

                                                echo $datetime->format('d/m/Y h:i A'); ?>
                                            </td>
                                            <td class="text-center">
                                                <a class="primary"
                                                   href="portfolio.php?edit=<?php echo $data[$i]['id']; ?>"
                                                   data-original-title="" title="" style="text-decoration: none">
                                                    <i class="fas fa-edit text-info"></i>
                                                </a>
                                                <a class="danger" href="?dele=<?php echo $data[$i]['id']; ?>"
                                                   data-original-title="" title="" style="text-decoration: none">
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
                        if (isset($_GET['dele'])) {
                            ?>
                            <script type="text/javascript">
                                setTimeout(function () {
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
                                        function (isConfirm) {
                                            if (isConfirm) {
                                                let currentUrl = window.location.href;
                                                let params = (new URL(currentUrl)).searchParams;
                                                let portfolio_id = params.get('dele');
                                                $.ajax({
                                                    type: 'get',
                                                    url: 'delete_data.php',
                                                    data: {
                                                        portfolio_id: portfolio_id
                                                    },
                                                    success: function (data) {
                                                        swal({
                                                            title: 'Portfolio Delete',
                                                            text: 'Portfolio Deleted Successfully',
                                                            type: 'error',
                                                            confirmButtonClass: 'btn-danger',
                                                            confirmButtonText: 'OK',
                                                        }, function () {
                                                            window.location = 'portfolio.php';
                                                        });
                                                    }
                                                });
                                            } else {
                                                swal({
                                                    title: 'Cancelled',
                                                    text: 'Your Portfolio is safe :)',
                                                    type: 'error',
                                                    confirmButtonClass: 'btn-success',
                                                    confirmButtonText: 'OK',
                                                }, function () {
                                                    window.location = 'portfolio.php';
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
