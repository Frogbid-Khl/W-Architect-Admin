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
    <title>Subcategory - Farm Store</title>
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
                <h1 class="mt-4">Subcategory</h1>
                <?php if (isset($_GET['edit'])) {
                    $sels = $con->query("select * from subcategory where id=" . $_GET['edit'] . "");
                    $sels = $sels->fetch_assoc();
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-lg-12 mb-5">
                                            <h4 class="mb-4">
                                                <strong>Edit Subcategory</strong>
                                            </h4>
                                            <form id="form-validation-simple" name="form-validation-simple"
                                                  method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label class="form-label">Select A Category</label>
                                                    <select name="scat" class="form-control select2"
                                                            data-validation="[NOTEMPTY]" required>
                                                        <option value="0">Select A Category</option>
                                                        <?php
                                                        $sel = $con->query("select * from category");
                                                        while ($rs = $sel->fetch_assoc()) {
                                                            ?>
                                                            <option value="<?php echo $rs['id']; ?>" <?php if ($rs['id'] == $sels['cat_id']) {
                                                                echo 'selected';
                                                            } ?>><?php echo $rs['catname']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Subcategory Name</label>
                                                    <input name="cname" value="<?php echo $sels['name']; ?>" type="text"
                                                           class="form-control" data-validation="[NOTEMPTY]" required/>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Subcategory Image</label>
                                                    <div class="mb-5">
                                                        <input type="file" name="f_up" class="dropify" data-height="300"
                                                               data-validation="[NOTEMPTY]"
                                                               data-default-file="../<?php echo $sels['img']; ?>"/>
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
                        $cname = mysqli_real_escape_string($con, $_POST['cname']);
                        $cid = $_POST['scat'];

                        if (!empty($_FILES["f_up"]["name"])) {
                            $fileName = $_FILES['f_up']['tmp_name'];
                            $sourceProperties = getimagesize($fileName);
                            $resizeFileName = time();
                            $uploadPath = "subcategory/";
                            $fileExt = pathinfo($_FILES['f_up']['name'], PATHINFO_EXTENSION);

                            $url = '../' . $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                            move_uploaded_file($fileName, $url);

                            $url = $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                            $con->query("update subcategory set name='" . $cname . "',img='" . $url . "',cat_id=" . $cid . " where id=" . $_GET['edit'] . "");
                        } else {
                            $con->query("update subcategory set name='" . $cname . "',cat_id=" . $cid . " where id=" . $_GET['edit'] . "");
                        }
                        echo '<script type="text/javascript">';
                        echo "setTimeout(function () { swal({title: 'Subcategory Edit', text: 'Subcategory Edited Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'subcategory.php';});";
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
                                                <strong>Add Subcatagory</strong>
                                            </h4>
                                            <form id="form-validation-simple" name="form-validation-simple"
                                                  method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label class="form-label">Select A Category</label>
                                                    <select name="scat" class="form-control select2"
                                                            data-validation="[NOTEMPTY]" required>
                                                        <option value="0">Select A Category</option>
                                                        <?php
                                                        $sp = $con->query("select * from category");
                                                        while ($roc = $sp->fetch_assoc()) {
                                                            ?>
                                                            <option value="<?php echo $roc['id']; ?>"><?php echo $roc['catname']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Subcategory Name</label>
                                                    <input name="cname" type="text" class="form-control"
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
                                                            name="sub_cat">Save Subcategory
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
                        $cname = mysqli_real_escape_string($con, $_POST['cname']);
                        $cid = $_POST['scat'];

                       // $result = $con->query("select * from subcategory where name='$cname';");

                        
                            $fileName = $_FILES['f_up']['tmp_name'];
                            $sourceProperties = getimagesize($fileName);
                            $resizeFileName = time();
                            $uploadPath = "subcategory/";
                            $fileExt = pathinfo($_FILES['f_up']['name'], PATHINFO_EXTENSION);

                            $url = '../' . $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                            move_uploaded_file($fileName, $url);

                            $url = $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                            $con->query("insert into subcategory(`cat_id`,`name`,`img`)values(" . $cid . ",'" . $cname . "','" . $url . "')");
                            echo '<script type="text/javascript">';
                            echo
                            "setTimeout(function () { swal({title: 'Subcategory Add', text: 'Subcategory Added Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'subcategory.php';});";
                            echo '}, 1000);</script>';
                         
                    }
                    ?>

                <?php } ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Subcategory List
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Category Name</th>
                                        <th>SubCategory Name</th>
                                        <th class="text-center">SubCategory Image</th>
                                        <th>Total Product</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sel = $con->query("select * from subcategory");
                                    $i = 0;
                                    while ($row = $sel->fetch_assoc()) {
                                        $i = $i + 1;
                                        ?>
                                        <tr>

                                            <td><?php echo $i; ?></td>
                                            <td><?php $cname = $con->query("select * from category where id=" . $row['cat_id'] . "")->fetch_assoc();
                                                echo $cname['catname']; ?>
                                            <td><?php echo $row['name']; ?></td>
                                            <td class="text-center"><img class="media-object round-media"
                                                                         src="../<?php echo $row['img']; ?>"
                                                                         alt="Generic placeholder image"
                                                                         style="height: 75px;"></td>
                                            <td><?php
                                                $total_product = $con->query("select * from product where sid=" . $row['id'] . "")->num_rows;
                                                echo $total_product;
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a class="primary" href="subcategory.php?edit=<?php echo $row['id']; ?>"
                                                   data-original-title="" title="">
                                                    <i class="fas fa-edit text-info"></i>
                                                </a>
                                                <?php if ($total_product == 0) { ?>
                                                    <a class="danger" href="?dele=<?php echo $row['id']; ?>"
                                                       data-original-title="" title="">
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
                                                let subcategory_id=params.get('dele');
                                                $.ajax({
                                                    type: 'get',
                                                    url: 'delete_data.php',
                                                    data: {
                                                        subcategory_id: subcategory_id
                                                    },
                                                    success: function(data) {
                                                        swal({
                                                            title: 'Subcategory Delete',
                                                            text: 'Subcategory Deleted Successfully',
                                                            type: 'error',
                                                            confirmButtonClass: 'btn-danger',
                                                            confirmButtonText: 'OK',
                                                        }, function () {
                                                            window.location = 'subcategory.php';
                                                        });
                                                    }
                                                });
                                            } else {
                                                swal({
                                                    title: 'Cancelled',
                                                    text: 'Your subcategory is safe :)',
                                                    type: 'error',
                                                    confirmButtonClass: 'btn-success',
                                                    confirmButtonText: 'OK',
                                                }, function () {
                                                    window.location = 'subcategory.php';
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
