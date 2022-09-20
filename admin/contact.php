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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                                        <th>Message</th>
                                        <th>Reply</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sel = $con->query("select * from contact");
                                    $i = 0;
                                    while ($row = $sel->fetch_assoc()) {
                                        $i = $i + 1;
                                        ?>
                                        <tr>

                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['contact_no']; ?></td>
                                            <td><?php echo $row['message']; ?></td>
                                            <td><a href="https://mail.google.com/mail/u/0/#inbox?compose=new"><i class="fa-solid fa-paper-plane ml-3"></i></a></td>
                                            <td><a href="?del=<?php echo $row['id']; ?>"><i class="fa-solid fa-trash ml-3 text-danger"></i></a></td>
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

            $id = $_GET['del'];

            $con->query("DELETE FROM `contact` where id=" . $id . "");
            echo '<script type="text/javascript">';
            echo "setTimeout(function () { swal({title: 'Delete', text: 'Contact Data Delete', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'contact.php';});";
            echo '}, 1000);</script>';
        }
        ?>

        <?php include('include/footer.php') ?>
    </div>
</div>
<?php include('include/jslist.php') ?>
</body>
</html>
