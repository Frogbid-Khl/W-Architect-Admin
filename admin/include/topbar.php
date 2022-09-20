<?php
if (!empty($_SESSION['name'])) {
    $id = $_SESSION['user_id'];
}
?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="dashboard.php">Nirman</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
        </div>
    </form>
    <!-- Navbar-->
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user fa-fw"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <?php if ($_SESSION['role'] == 'admin') { ?>
                <li><a class="dropdown-item" href="setting.php">Setting</a></li>
            <?php } ?>
            <li>
                <hr class="dropdown-divider"/>
            </li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </div>
    </div>
</nav>
