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
    <title>Setting - Farm Store</title>
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
                <h1 class="mt-4">Setting</h1>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-12 mb-5">
                                        <h4 class="mb-4">
                                            <strong>Edit Setting</strong>
                                        </h4>
                                        <form id="form-validation-simple" name="form-validation-simple" action="" method="POST" enctype="multipart/form-data">

                                            <?php
                                            $getkey = $con->query("select * from setting")->fetch_assoc();
                                            ?>
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="cname">Currency</label>
                                                        <input type="text" id="cname" class="form-control" name="currency" value="<?php echo $getkey['currency']; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                                    <?php
                                                    $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
                                                    $limit =  count($tzlist);
                                                    ?>
                                                    <div class="form-group">
                                                        <label for="cname">Select Timezone</label>
                                                        <select name="stime" class="form-control" required>
                                                            <option value="">Select Timezone</option>
                                                            <?php
                                                            for ($k = 0; $k < $limit; $k++) {
                                                                ?>
                                                                <option <?php echo $tzlist[$k]; ?> <?php if ($tzlist[$k] == $getkey['timezone']) {
                                                                    echo 'selected';
                                                                } ?>><?php echo $tzlist[$k]; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="cname">Order Min Value</label>
                                                        <input type="text" id="cname" class="form-control" name="omin" value="<?php echo $getkey['o_min']; ?>" required>
                                                    </div>
                                                </div>




                                                <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="cname">Delivery Charge</label>
                                                        <input type="text" id="cname" class="form-control" name="delivery_charge" value="<?php echo $getkey['delivery_charge']; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="cname">Tax(%)</label>
                                                        <input type="text" id="cname" class="form-control" name="tax" value="<?php echo $getkey['tax']; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="row">
                                                <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="cname">Website Title</label>
                                                        <input type="text" id="cname" class="form-control" name="title" value="<?php /*echo $getkey['title']; */?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="cname">Website Logo</label>
                                                        <div class="mb-5">
                                                            <input type="file" name="logo" class="dropify" data-height="250" data-validation="[NOTEMPTY]" data-default-file="../<?php /*echo $getkey['logo']; */?>" />
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="cname">Website Favicon</label>
                                                        <div class="mb-5">
                                                            <input type="file" name="favicon" class="dropify" data-height="250" data-validation="[NOTEMPTY]" data-default-file="../<?php /*echo $getkey['favicon']; */?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label for="cname">Privacy Policy</label>
                                                    <textarea class="form-control summernote" rows="5" name="p_data" style="resize: none;"><?php /*echo $getkey['privacy_policy']; */?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label for="cname">About Us</label>
                                                    <textarea class="form-control summernote" rows="5" name="a_data" style="resize: none;"><?php /*echo $getkey['about_us']; */?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                                <div class="form-group">


                                                    <label for="cname">Contact Us</label>
                                                    <textarea class="form-control summernote" rows="5" name="c_data" style="resize: none;"><?php /*echo $getkey['contact_us']; */?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                                <div class="form-group">


                                                    <label for="cname">Terms & Conditions</label>
                                                    <textarea class="form-control summernote" rows="5" name="terms" style="resize: none;"><?php /*echo $getkey['terms']; */?></textarea>
                                                </div>
                                            </div>-->

                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-success mr-2 px-5" name="submit">Update Setting</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($_POST['submit'])) {
                    $omin = $_POST['omin'];
                    $timezone = $_POST['stime'];
                    $currency = mysqli_real_escape_string($con, $_POST['currency']);
                    $delivery_charge = $_POST['delivery_charge'];
                    $tax = $_POST['tax'];


                    $con->query("update setting set delivery_charge=" . $delivery_charge . ", currency='" . $currency . "', tax='" . $tax . "',o_min=" . $omin . ",`timezone`='" . $timezone . "' where id=1");

                    echo '<script type="text/javascript">';
                    echo "setTimeout(function () { swal({title: 'Update Setting', text: 'Update Setting Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'setting.php';});";
                    echo '}, 1000);</script>';
                }
                ?>
            </div>
        </main>
        <?php include('include/footer.php') ?>
    </div>
</div>
<?php include('include/jslist.php') ?>
</body>
</html>
