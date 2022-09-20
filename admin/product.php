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
    <title>Product - Farm Store</title>
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
                <h1 class="mt-4">Product</h1>
                <?php
                if (isset($_GET['edit'])) {
                    $selk = $con->query("select * from product where id=" . $_GET['edit'] . "")->fetch_assoc();
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-lg-12 mb-5">
                                            <h4 class="mb-4">
                                                <strong>Edit Product</strong>
                                            </h4>
                                            <form id="form-validation-simple" name="form-validation-simple" method="POST" enctype="multipart/form-data">

                                                <div class="form-group">
                                                    <label for="cname">Product Name</label>
                                                    <input type="text" id="vname" class="form-control" value="<?php echo $selk['pname']; ?>" name="pname" required>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Product Image</label>
                                                    <div class="mb-5">
                                                        <input type="file" name="pimg" class="dropify" data-height="300" data-validation="[NOTEMPTY]" data-default-file="../<?php echo $selk['pimg']; ?>" />
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label for="cname">Product Related Image</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="myInput" name="prel[]" aria-describedby="myInput" multiple>
                                                        <label class="custom-file-label" for="myInput">Choose file</label>
                                                    </div>
                                                    <p>Only Upload 3 Images</p>
                                                    <?php $sb = explode(',', $selk['prel']);


                                                    foreach ($sb as $bb) {
                                                        if ($bb == '') {
                                                        } else {
                                                            ?>
                                                            <img src="../<?php echo $bb; ?>" width="100" height="100" />
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>

                                                <div class="form-group">
                                                    <label for="gurl">Seller Name / Shop Name</label>
                                                    <input type="text" id="gurl" class="form-control" placeholder="Enter Seller Name" value="<?php echo $selk['sname']; ?>" name="sname" required>

                                                </div>

                                                <div class="form-group">
                                                    <label for="projectinput6">Select Category</label>
                                                    <select id="cat_change" name="catname" class="form-control select2" required>

                                                        <?php
                                                        $j = mysqli_fetch_assoc(mysqli_query($con, "select * from category where id=" . $selk['cid'] . ""));
                                                        ?>
                                                        <option value="<?php echo $j['id']; ?>"><?php echo $j['catname']; ?></option>
                                                        <?php
                                                        $sk = mysqli_query($con, "select * from category where id !=" . $selk['cid'] . "");
                                                        while ($h = mysqli_fetch_assoc($sk)) {
                                                            ?>
                                                            <option value="<?php echo $h['id']; ?>"><?php echo $h['catname']; ?></option>
                                                        <?php } ?>

                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="projectinput6">Select SubCategory</label>
                                                    <select id="sub_list" name="subcatname" class="form-control select2" required>

                                                        <?php
                                                        $j = mysqli_fetch_assoc(mysqli_query($con, "select * from subcategory where id=" . $selk['sid'] . " and cat_id=" . $selk['cid'] . ""));
                                                        ?>
                                                        <option value="<?php echo $j['id']; ?>"><?php echo $j['name']; ?></option>
                                                        <?php
                                                        $sk = mysqli_query($con, "select * from subcategory where id !=" . $selk['sid'] . " and cat_id=" . $selk['cid'] . "");
                                                        while ($h = mysqli_fetch_assoc($sk)) {
                                                            ?>
                                                            <option value="<?php echo $h['id']; ?>"><?php echo $h['name']; ?></option>
                                                        <?php } ?>

                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="projectinput6">Out OF Stock?</label>
                                                    <select id="projectinput68" name="ostock" class="form-control select2" required>

                                                        <option <?php if ($selk['stock'] == 0) {
                                                            echo 'selected';
                                                        } ?> value="0">Yes</option>
                                                        <option <?php if ($selk['stock'] == 1) {
                                                            echo 'selected';
                                                        } ?> value="1">No</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="projectinput6">Product Publish Or Unpublish?</label>
                                                    <select id="projectinput67" name="ppuborun" class="form-control select2">

                                                        <option value="0" <?php if ($selk['status'] == 0) {
                                                            echo 'selected';
                                                        } ?>>Unpublish</option>
                                                        <option <?php if ($selk['status'] == 1) {
                                                            echo 'selected';
                                                        } ?> value="1">Publish</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="projectinput6">Make Product Popular?</label>
                                                    <select id="projectinput6" name="popular" class="form-control select2">

                                                        <option value="0" <?php if ($selk['popular'] == 0) {
                                                            echo 'selected';
                                                        } ?>>No</option>
                                                        <option <?php if ($selk['popular'] == 1) {
                                                            echo 'selected';
                                                        } ?> value="1">Yes</option>
                                                    </select>
                                                </div>


                                                <div class="form-group">
                                                    <label for="gurl">Product Small Description</label>
                                                    <textarea class="form-control" name="psdesc" placeholder="Enter Product Small Description" required><?php echo $selk['psdesc']; ?></textarea>

                                                </div>


                                                <div class="form-group">
                                                    <label for="gurl">Product (Gms,kg,ltr,ml,pcs)</label>
                                                    <input type="text" id="ptype" class="form-control" name="pgms" value="<?php echo str_replace('$;', ',', $selk['pgms']); ?>" data-role="tagsinput" required>
                                                    <p>After write Product Type Press Enter</p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="gurl">Product Price</label>
                                                    <input type="text" id="pprice" class="form-control" name="pprice" value="<?php echo str_replace('$;', ',', $selk['pprice']); ?>" required>
                                                    <p>After write Product Price Press Enter</p>
                                                </div>

                                           <!-- <div class="form-group">
                                                    <label for="gurl">Product discount(Only Digit)</label>
                                                    <input type="hidden" id="gurl" value="0" class="form-control" name="discount_percentage" placeholder="Enter discount in percentage" value="<?php echo $selk['discount']; ?>" required>

                                                </div> --> 


                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-success mr-2 px-5" name="edit_product">Update Product</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['edit_product'])) {
                        $data = $con->query("select * from product where id=" . $_GET['edit'] . "")->fetch_assoc();
                        $pname = mysqli_real_escape_string($con, $_POST['pname']);
                        $sname = $_POST['sname'];
                        $popular = $_POST['popular'];
                        $discount = 0;
                        $catname = $_POST['catname'];
                        $subcatname = $_POST['subcatname'];
                        $ostock = $_POST['ostock'];
                        $snoti = $_POST['snoti'];
                        $psdesc = mysqli_real_escape_string($con, $_POST['psdesc']);
                        $pgms = str_replace(',', '$;', $_POST['pgms']);
                        $pprice = str_replace(',', '$;', $_POST['pprice']);

                        $timestamp = date("Y-m-d H:i:s");
                        $status = $_POST['ppuborun'];

                        if ($_FILES["pimg"]["name"] == '') {
                            $pimg = $data['pimg'];
                        } else {
                            $fileName = $_FILES['pimg']['tmp_name'];
                            echo $_FILES['pimg']['name'];
                            $sourceProperties = getimagesize($fileName);
                            $resizeFileName = uniqid() . time();
                            $uploadPath = "cat/";
                            $fileExt = pathinfo($_FILES['pimg']['name'], PATHINFO_EXTENSION);
                            $url = '../'.$uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                            move_uploaded_file($fileName,  $url);

                            $pimg = $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                        }


                        if (empty($_FILES['prel']['name'][0])) {
                            $related = $data['prel'];
                        } else {
                            $arr = array();
                            foreach ($_FILES['prel']['tmp_name'] as $key => $tmp_name) {
                                $file_name = $key . $_FILES['prel']['name'][$key];
                                $file_size = $_FILES['prel']['size'][$key];
                                $file_tmp = $_FILES['prel']['tmp_name'][$key];

                                $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                                if (
                                    $file_type != "jpg" && $file_type != "png" && $file_type != "jpeg"
                                    && $file_type != "gif"
                                ) {
                                    $related = '';
                                } else {

                                    move_uploaded_file($file_tmp, '../' . "cat/" . $file_name);
                                    $arr[] = "cat/" . $file_name;
                                }
                            }
                            $related = implode(',', $arr);
                        }

                        if ($related == '') {
                            $related = $data['prel'];
                        }


                        $con->query("update product set pname='" . $pname . "',sname='" . $sname . "',pimg='" . $pimg . "',prel='" . $related . "',popular=" . $popular . ",discount=" . $discount . ",cid=" . $catname . ",sid=" . $subcatname . ",psdesc='" . $psdesc . "',pgms='" . $pgms . "',pprice='" . $pprice . "',status=" . $status . ",stock=" . $ostock . " where id=" . $_GET['edit'] . "");


                        echo '<script type="text/javascript">';
                        echo "setTimeout(function () { swal({title: 'Product Edit', text: 'Product Edited Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'product.php';});";
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
                                                <strong>Add Product</strong>
                                            </h4>
                                            <form id="form-validation-simple" name="form-validation-simple" method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="cname">Product Name</label>
                                                    <input type="text" id="vname" class="form-control" placeholder="Enter Product Name" name="pname" required>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Product Image</label>
                                                    <div class="mb-5">
                                                        <input type="file" name="pimg" class="dropify" data-height="300" data-validation="[NOTEMPTY]" required />
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="cname">Product Related Image</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="myInput" name="prel[]" aria-describedby="myInput" multiple>
                                                        <label class="custom-file-label" for="myInput">Choose file</label>
                                                    </div>
                                                    <p>Only Upload 3 Images</p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="gurl">Seller Name / Shop Name</label>
                                                    <input type="text" id="gurl" class="form-control" placeholder="Enter Seller Name" name="sname" required>

                                                </div>



                                                <div class="form-group">
                                                    <label for="projectinput6">Select Category</label>
                                                    <select id="cat_change" name="catname" class="form-control select2" required>
                                                        <option value="" selected="" disabled="">Select Category</option>
                                                        <?php
                                                        $sk = mysqli_query($con, "select * from category");
                                                        while ($h = mysqli_fetch_assoc($sk)) {
                                                            ?>
                                                            <option value="<?php echo $h['id']; ?>"><?php echo $h['catname']; ?></option>
                                                        <?php } ?>

                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="projectinput6">Select SubCategory</label>
                                                    <select id="sub_list" name="subcatname" class="form-control select2" required>
                                                        <option value="" selected="" disabled="">Select SubCategory</option>


                                                    </select>
                                                </div>


                                                <div class="form-group">
                                                    <label for="projectinput67">Out OF Stock?</label>
                                                    <select id="projectinput67" name="ostock" class="form-control select2">

                                                        <option value="0">Yes</option>
                                                        <option selected="" value="1">No</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="projectinput68">Product Publish Or Unpublish?</label>
                                                    <select id="projectinput68" name="ppuborun" class="form-control select2">

                                                        <option value="0">Unpublish</option>
                                                        <option selected="" value="1">Publish</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="projectinput69">Make Product Popular?</label>
                                                    <select id="projectinput69" name="popular" class="form-control select2">

                                                        <option value="1">Yes</option>
                                                        <option selected="" value="0">No</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="gurl">Product Small Description</label>
                                                    <textarea class="form-control" name="psdesc" placeholder="Enter Product Small Description" required></textarea>

                                                </div>



                                                <div class="form-group">
                                                    <label for="gurl">Product (Gms,kg,ltr,ml,pcs)</label>
                                                    <input type="text" id="ptype" class="form-control" name="pgms" value="1 gms,250 gms" data-role="tagsinput" required>
                                                    <p>After write Product Type Press Enter</p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="gurl">Product Price</label>
                                                    <input type="text" id="pprice" class="form-control" value="1,10" name="pprice" data-role="tagsinput" required>
                                                    <p>After write Product Price Press Enter</p>
                                                </div>

                                                <!--<div class="form-group">
                                                    <label for="gurl">Product discount (Only Digit)</label>
                                                    <input type="text" id="gurl" class="form-control" name="discount_percentage" placeholder="Enter discount in percentage ex. 5" required>

                                                </div> -->

                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-success mr-2 px-5" name="save_product">Save Product</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php
                    if (isset($_POST['save_product'])) {
                        if (count($_FILES['prel']['name']) > 3) {
                            echo '<script type="text/javascript">';
                            echo "setTimeout(function () { swal({title: 'Product Add', text: 'Sorry Only Allow 3 Images', type: 'error', confirmButtonClass: 'btn-danger', confirmButtonText: 'OK', },function() {window.location = 'product.php';});";
                            echo '}, 1000);</script>';
                        } else {
                            $pname = mysqli_real_escape_string($con, $_POST['pname']);
                            $sname = $_POST['sname'];
                            $catname = $_POST['catname'];
                            $subcatname = $_POST['subcatname'];
                            $ostock = $_POST['ostock'];
                            $snoti = $_POST['snoti'];
                            $psdesc = mysqli_real_escape_string($con, $_POST['psdesc']);
                            $pgms = str_replace(',', '$;', $_POST['pgms']);
                            $popular = $_POST['popular'];
                            $pprice = str_replace(',', '$;', $_POST['pprice']);

                            $timestamp = date("Y-m-d H:i:s");
                            $status = $_POST['ppuborun'];
                            $discount = 0;

                            $fileName = $_FILES['pimg']['tmp_name'];
                            $sourceProperties = getimagesize($fileName);
                            $resizeFileName = time();
                            $uploadPath = "cat/";
                            $fileExt = pathinfo($_FILES['pimg']['name'], PATHINFO_EXTENSION);
                            $url = '../'.$uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                            move_uploaded_file($fileName,  $url);

                            $url = $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                            if (!empty($_FILES['prel']['name'][0])) {
                                $arr = array();
                                foreach ($_FILES['prel']['tmp_name'] as $key => $tmp_name) {
                                    $file_name = $key . $_FILES['prel']['name'][$key];
                                    $file_size = $_FILES['prel']['size'][$key];
                                    $file_tmp = $_FILES['prel']['tmp_name'][$key];

                                    $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                                    if (
                                        $file_type != "jpg" && $file_type != "png" && $file_type != "jpeg"
                                        && $file_type != "gif"
                                    ) {
                                        $related = '';
                                    } else {

                                        move_uploaded_file($file_tmp, '../' . "cat/" . $file_name);
                                        $arr[] = "cat/" . $file_name;
                                    }
                                }
                                $related = implode(',', $arr);
                            } else {
                                $related = '';
                            }
                            $con->query("insert into product(`pname`,`pimg`,`prel`,`sname`,`cid`,`sid`,`psdesc`,`pgms`,`pprice`,`date`,`status`,`stock`,`discount`,`popular`) values('" . $pname . "','" . $url . "','" . $related . "','" . $sname . "'," . $catname . "," . $subcatname . ",'" . $psdesc . "','" . $pgms . "','" . $pprice . "','" . $timestamp . "'," . $status . "," . $ostock . "," . $discount . "," . $popular . ")");

                            echo '<script type="text/javascript">';
                            echo
                            "setTimeout(function () { swal({title: 'Product Add', text: 'Product Added Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'product.php';});";
                            echo '}, 1000);</script>';
                        }
                    }
                    ?>

                <?php } ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Product List
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Product Name</th>
                                        <th class="text-center">Product Image</th>
                                        <th class="text-center">Product Related Image</th>
                                        <th>Seller Name</th>
                                        <th>Category Name</th>
                                        <th>SubCategory Name</th>
                                        <th>Small Description</th>
                                        <th>Product Range</th>
                                        <th>Product Price</th>
                                        <th>In Stock ?</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $jj = $con->query("select * from product order by id desc");
                                    $i = 0;
                                    while ($rkl = $jj->fetch_assoc()) {
                                        $i = $i + 1;
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $rkl['pname']; ?></td>
                                            <td class="text-center"><img src="../<?php echo $rkl['pimg']; ?>" width="100" height="100" /></td>
                                            <td class="text-center"><?php $sb = explode(',', $rkl['prel']);


                                                foreach ($sb as $bb) {
                                                    if ($bb == '') {
                                                    } else {
                                                        ?>
                                                        <img src="../<?php echo $bb; ?>" width="100" height="100" />
                                                        <?php
                                                    }
                                                }
                                                ?></td>
                                            <td><?php echo $rkl['sname']; ?></td>

                                            <td><?php $cat = $con->query("select * from category where id=" . $rkl['cid'] . "")->fetch_assoc();
                                                echo $cat['catname']; ?></td>
                                            <td><?php $cat = $con->query("select * from subcategory where id=" . $rkl['sid'] . "")->fetch_assoc();
                                                echo $cat['name']; ?></td>
                                            <td><?php echo substr($rkl['psdesc'], 0, 100) . '....'; ?></td>
                                            <td><?php echo str_replace('$;', ', ', $rkl['pgms']); ?></td>
                                            <td><?php echo str_replace('$;', ', ', $rkl['pprice']); ?></td>
                                            <td><?php if ($rkl['stock'] == 1) {
                                                    echo 'Yes';
                                                } else {
                                                    echo 'No';
                                                } ?></td>
                                            <td><?php if ($rkl['status'] == 1) {
                                                    echo 'Publish';
                                                } else {
                                                    echo 'Unpublish';
                                                } ?></td>
                                            <td class="text-center">
                                                <a class="primary" href="product.php?edit=<?php echo $rkl['id']; ?>" data-original-title="" title="">
                                                    <i class="fas fa-edit text-info"></i>
                                                </a>

                                                <a class="danger" data-original-title="" href="?dele=<?php echo $rkl['id']; ?>" title="">
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
                                setTimeout(function() {
                                    swal({
                                            title: "Are you sure?",
                                            text: "You will not be able to recover this product!",
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
                                                let product_id=params.get('dele');
                                                $.ajax({
                                                    type: 'get',
                                                    url: 'delete_data.php',
                                                    data: {
                                                        product_id: product_id
                                                    },
                                                    success: function(data) {
                                                        swal({
                                                            title: 'Product Delete',
                                                            text: 'Product Deleted Successfully',
                                                            type: 'error',
                                                            confirmButtonClass: 'btn-danger',
                                                            confirmButtonText: 'OK',
                                                        }, function() {
                                                            window.location = 'product.php';
                                                        });
                                                    }
                                                });

                                            } else {
                                                swal({
                                                    title: 'Cancelled',
                                                    text: 'Your product is safe :)',
                                                    type: 'error',
                                                    confirmButtonClass: 'btn-success',
                                                    confirmButtonText: 'OK',
                                                }, function() {
                                                    window.location = 'product.php';
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
<script>
    $(document).on('change', '#cat_change', function() {
        var value = $(this).val();

        $.ajax({
            type: 'post',
            url: 'getsub.php',
            data: {
                catid: value
            },
            success: function(data) {
                $('#sub_list').html(data);
            }
        });
    });
</script>
</body>
</html>
