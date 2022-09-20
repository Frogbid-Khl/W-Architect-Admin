<?php
include('../include/dbconfig.php');
include('include/session.php');

if (isset($_GET['subcategory_id'])) {
    $con->query("delete from subcategory where id=" . $_GET['subcategory_id'] . "");
    echo 'success';
}

if (isset($_GET['category_id'])) {
    $con->query("delete from category where id=" . $_GET['category_id'] . "");
    echo 'success';
}

if (isset($_GET['product_id'])) {
    $con->query("delete from product  where id=" . $_GET['product_id'] . "");
    echo 'success';
}

if (isset($_GET['user_id'])) {
    $con->query("delete from user where id=" . $_GET['user_id'] . "");
    echo 'success';
}

