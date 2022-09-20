<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">

            <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'sell') { ?>
                <div class="sb-sidenav-menu-heading">Dashboards</div>
                <a class="nav-link" href="dashboard.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboards
                </a>
                <?php
            }
            if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'sell') {
                ?>
                <div class="sb-sidenav-menu-heading">Nirman Info</div>
                <a class="nav-link" href="category.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Category
                </a>
                <a class="nav-link" href="product.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Portfolio Add
                </a>
                <?php
            }
            if ($_SESSION['role'] == 'admin' ) {
                ?>
                <div class="sb-sidenav-menu-heading">Order</div>
                <a class="nav-link" href="order.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Pending Order

                </a>
                <a class="nav-link" href="orders.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Complete Order

                </a>
                <div class="sb-sidenav-menu-heading">Customer</div>
                <a class="nav-link" href="user.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Customer
                </a>
                <?php
            }
            ?>
            <a class="nav-link" href="contact.php">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Customer Contact Info
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        <?php echo $_SESSION['name']; ?>
    </div>

</nav>
