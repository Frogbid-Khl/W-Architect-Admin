<?php
session_start();
include('../include/dbController.php');
$db_handle = new DBController();
include('include/session.php');

if (isset($_GET['category_id'])) {
    $db_handle->runQuery("delete FROM category where id={$_GET['category_id']}");
    echo 'success';
}

if (isset($_GET['portfolio_id'])) {
    $db_handle->runQuery("delete FROM portfolio where id={$_GET['portfolio_id']}");
    echo 'success';
}

if (isset($_GET['user_id'])) {
    $db_handle->runQuery("delete FROM admin_login where id={$_GET['user_id']}");
    echo 'success';
}

