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
    <title>Pending Order - Farm Store</title>
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
                <h1 class="mt-4">Pending Order</h1>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Pending Order List
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Date</th>
                                        <th>Order ID</th>
                                        <th>Status</th>
                                        <th>Preview</th>
                                        <th>Action</th>
                                        <th>Cancel</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sel = $con->query("select * from orders where status !='completed' order by id desc");
                                    $i = 0;
                                    while ($row = $sel->fetch_assoc()) {

                                        $i = $i + 1;
                                        ?>
                                        <tr>

                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row['order_date']; ?></td>

                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo ucfirst($row['status']); ?></td>
                                            <td>
                                                <button class="btn btn-secondary shadow btn-xs sharp mr-1"
                                                        data-toggle="modal" data-target=".bd-example-modal-xl" onclick="showInvoice(<?php echo $row['id']; ?>);">
                                                    Preview
                                                </button>
                                            </td>

                                            <td>
                                                <?php if ($row['status'] != 'completed' and $row['status'] != 'cancelled') { ?>
                                                    <a href="?status=completed&id=<?php echo $row['id']; ?>">
                                                        <button class="btn shadow-z-2 btn-success">Make Completed
                                                        </button>
                                                    </a>
                                                <?php } ?>
                                            </td>

                                            <td>
                                                <?php if ($row['status'] != 'cancelled' or $row['status'] != 'completed') { ?>
                                                    <a href="?status=cancelled&id=<?php echo $row['id']; ?>">
                                                        <button class="btn shadow-z-2 btn-danger">Make Cancel
                                                        </button>
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
                        if (isset($_GET['status'])) {
                            $status = $_GET['status'];
                            $id = $_GET['id'];

                            $con->query("update orders set status='" . $status . "' where id=" . $id . "");
                            echo '<script type="text/javascript">';
                            echo "setTimeout(function () { swal({title: 'Delivery Status', text: 'Delivery Status Update Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'order.php';});";
                            echo '}, 1000);</script>';
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
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Invoice Details</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12" id="showInvoice">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success light" data-dismiss="modal" onclick="printDiv()">
                    Print
                </button>
                <button type="button" class="btn btn-danger light" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function showInvoice(pid) {
        $.ajax({
            type: 'get',
            url: 'pdata.php',
            data: {
                pid: pid
            },
            success: function(data) {
                $('#showInvoice').html(data);
            }
        });
    }
</script>
<script>
    function printDiv() {

        var divToPrint = document.getElementById('showInvoice');

        var newWin = window.open('', 'Print-Window');
        var htmlToPrint = '' +
            '<style type="text/css">' +
            'table th, table td {' +
            'border:1px solid #000;' +
            'padding:0.5em;' +
            '}' +
            '.list-group { ' +
            ' display: flex; ' +
            ' flex-direction: column; ' +
            ' padding-left: 0; ' +
            ' margin-bottom: 0; ' +
            '}' +
            '.list-group-item {' +
            ' position: relative;' +
            'display: block;' +
            'padding: 0.75rem 1.25rem;' +
            'margin-bottom: -1px;' +
            'background-color: #fff;' +
            'border: 1px solid rgba(0, 0, 0, 0.125);' +
            '}' +

            '.float-right {' +
            'float: right !important;' +
            '}' +

            '</style>';

        newWin.document.open();
        htmlToPrint += divToPrint.innerHTML;
        newWin.document.write('<html><body onload="window.print()">' + htmlToPrint + '</body></html>');

        newWin.document.close();

        setTimeout(function () {
            newWin.close();
        }, 1);

    }
</script>
</body>
</html>
