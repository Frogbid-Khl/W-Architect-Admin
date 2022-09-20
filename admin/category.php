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
    <title>Category - Farm Store</title>
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
                    $sels = $con->query("select * from category where id=" . $_GET['edit'] . "");
                    $sels = $sels->fetch_assoc();
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
                                                           value="<?php echo $sels['catname']; ?>" class="form-control"
                                                           data-validation="[NOTEMPTY]" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Category Image</label>
                                                    <div class="mb-5">
                                                        <input type="file" name="Category_Image" class="dropify"
                                                               data-height="300" data-validation="[NOTEMPTY]"
                                                               data-default-file="../<?php echo $sels['catimg']; ?>"/>
                                                    </div>
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
                        $cname = mysqli_real_escape_string($con, $_POST['Category_Name']);

                        $result = $con->query("select * from category where catname='$cname';");

                        if ($result->num_rows == 0) {
                            if (!empty($_FILES["Category_Image"]["name"])) {


                                $fileName = $_FILES['Category_Image']['tmp_name'];
                                $sourceProperties = getimagesize($fileName);
                                $resizeFileName = time();
                                $uploadPath = "cat/";
                                $fileExt = pathinfo($_FILES['Category_Image']['name'], PATHINFO_EXTENSION);

                                $url = $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                                if (move_uploaded_file($fileName, '../' . $url)) {
                                    $con->query("update category set catname='" . $cname . "',catimg='" . $url . "' where id=" . $_GET['edit'] . "");
                                }
                            } else {
                                $con->query("update category set catname='" . $cname . "' where id=" . $_GET['edit'] . "");
                            }
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
                                                <div class="form-group">
                                                    <label class="form-label">Category Image</label>
                                                    <div class="mb-5">
                                                        <input type="file" name="Category_Image" class="dropify"
                                                               data-height="300" data-validation="[NOTEMPTY]" required/>
                                                    </div>
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
                    $cname = mysqli_real_escape_string($con, $_POST['Category_Name']);

                    $fileName = $_FILES['Category_Image']['tmp_name'];
                    $resizeFileName = time();
                    $uploadPath = "cat/";
                    $fileExt = pathinfo($_FILES['Category_Image']['name'], PATHINFO_EXTENSION);

                    $url = $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;

                    $result = $con->query("select * from category where catname='$cname';");

                    if ($result->num_rows == 0) {
                        if (move_uploaded_file($fileName, '../' . $url)) {
                            $con->query("insert into category(`catname`,`catimg`)values('" . $cname . "','" . $url . "')");
                            echo '<script type="text/javascript">';
                            echo "setTimeout(function () { swal({title: 'Catagory Add', text: 'Catagory Added Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', });";
                            echo '}, 1000);</script>';
                        } else {
                            echo '<script type="text/javascript">';
                            echo "setTimeout(function () { swal({title: 'Catagory Add', text: 'Something went wrong', type: 'error', confirmButtonClass: 'btn-danger', confirmButtonText: 'OK', });";
                            echo '}, 1000);</script>';
                        }
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
                                        <th>Catgory Name.</th>
                                        <th class="text-center">Catagory Image.</th>
                                        <th>Total Subcatagory</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sel = $con->query("select * from category");
                                    $i = 0;
                                    while ($row = $sel->fetch_assoc()) {
                                        $i = $i + 1;
                                        ?>
                                        <tr>

                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row['catname']; ?></td>
                                            <td class="text-center"><img class="media-object round-media"
                                                                         src="../<?php echo $row['catimg']; ?>"
                                                                         alt="Generic placeholder image"
                                                                         style="height: 75px;"></td>
                                            <td>
                                                <?php
                                                $num_of_subcategory = $con->query("select * from subcategory where cat_id=" . $row['id'] . "")->num_rows;
                                                echo $num_of_subcategory;
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a class="primary"
                                                   href="category.php?edit=<?php echo $row['id']; ?>"
                                                   data-original-title="" title="">
                                                    <i class="fas fa-edit text-info"></i>
                                                </a>
                                                <?php
                                                if ($num_of_subcategory == 0) {
                                                    ?>
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
                                                let category_id=params.get('dele');
                                                $.ajax({
                                                    type: 'get',
                                                    url: 'delete_data.php',
                                                    data: {
                                                        category_id: category_id
                                                    },
                                                    success: function(data) {
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
