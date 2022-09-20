<?php
require '../include/dbconfig.php';
$pid = $_GET['pid'];
$c = $con->query("select * from orders where id=" . $pid . "")->fetch_assoc();
$uinfo = $con->query("select * from address where id=" . $c['address_id'] . "")->fetch_assoc();
$user = $con->query("select * from user where id=" . $c['uid'] . "")->fetch_assoc();
?>
<div class="card mt-3">
    <div class="card-header">
        <h5><b> Order Id - # <?php echo $pid; ?></b></h5>
        <h5><b>Customer Name :- <?php echo $uinfo['name']; ?></b></h5>
        <h5><b>Customer Mobile :- <?php echo $user['mobile']; ?></b></h5>
        <h5><b>Address
                :- <?php echo $uinfo['hno'] . ',' . $uinfo['society'] . ',' . $uinfo['area'] . '-' . $uinfo['pincode']; ?></b>
        </h5>

        <?php $user_status=$user['status']; ?>
        <h5><b>Landmark:- <?php echo $uinfo['landmark']; ?></b></h5>

        <h5><b>Payment Method :- <?php echo $c['p_method']; ?></b></h5>
        <?php
        if ($c['p_method'] == 'Cash on delivery' or $c['p_method'] == 'Cash On Delivery' or $c['p_method'] == 'Pickup myself' or $c['p_method'] == 'Pickup Myself') {
        } else {
            ?>
            <h5><b>Transaction Id :- <?php echo $c['tid']; ?></b></h5>
            <?php
        }
        ?>
    </div>
    <div class="card-body">
        <div class="row mb-5">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Sr No.</th>
                        <th>Prodct Name</th>
                        <th>Prodct Image</th>
<!--                        <th>Discount</th>-->
                        <th>Prodct Type</th>
                        <th>Prodct Price</th>
                        <th>Product Qty</th>
                    </tr>
                    <?php
                    $prid = explode('$;', $c['pid']);
                    $qty = explode('$;', $c['qty']);
                    $ptype = explode('$;', $c['ptype']);
                    $pprice = explode('$;', $c['pprice']);
                    $pcount = count($qty);

                    $op = 0;
                    for ($i = 0; $i < $pcount; $i++) {
                        $op = $op + 1;
                        $pinfo = $con->query("select * from product where id=" . $prid[$i] . "")->fetch_assoc();
                        ?>
                        <tr>
                            <td><?php echo $op; ?></td>
                            <td><?php echo $pinfo['pname']; ?></td>
                            <td><!--<img src="../<?php echo $pinfo['pimg']; ?>" width="100px" />--></td>
<!--                            <td><?php /*echo $pinfo['discount']; */?></td>-->
                            <td><?php echo $ptype[$i]; ?></td>
                            <td><?php echo $pprice[$i]; ?></td>
                            <td><?php echo $qty[$i]; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <?php
            $discount=0;


            $query = "SELECT * FROM `setting`";
            $data = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($data);
            $tx = $row['tax'];

            if($user_status==0){
                $discount=$c['total']*.10;
            }

            $tax = $c['total'] * $tx / 100;
            $stotal = $c['total'] - $tax- $discount;

            ?>
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="badge bg-primary float-right text-white even-larger-badge"><?php echo $c['p_method']; ?></span>
                    Payment Method
                </li>
                <li class="list-group-item">
                    <span class="badge bg-info float-right budge-own text-white even-larger-badge"><?php echo $discount; ?></span>
                    Discount
                </li>
                <li class="list-group-item">
                    <span class="badge bg-info float-right budge-own text-white even-larger-badge"><?php echo $stotal; ?></span>
                    Total Price + Delivery Charges
                </li>
                <li class="list-group-item">
                    <span class="badge bg-info float-right budge-own text-white even-larger-badge"><?php echo $tax; ?></span>
                    Tax
                </li>
                <li class="list-group-item">
                    <span class="badge bg-info float-right budge-own text-white even-larger-badge"><?php echo $c['total']-$discount+$tax; ?></span>
                    Final Price
                </li>
                <li class="list-group-item">
                    <span class="badge bg-warning float-right budge-own text-white even-larger-badge"><?php echo $c['status']; ?></span>
                    Order Status
                </li>

            </ul>
        </div>
    </div>
</div>
