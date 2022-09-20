<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">

            <?php if ($username == 0 || $username == 1 || $username == 2) { ?>
                <div class="sb-sidenav-menu-heading">Dashboards</div>
                <a class="nav-link" href="dashboard.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboards
                </a>
                <?php
            }
            if ($username == 0 || $username == 1) {
                ?>
                <div class="sb-sidenav-menu-heading">Product Info</div>
                <a class="nav-link" href="category.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Category
                </a>
                <a class="nav-link" href="subcategory.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Subcategory
                </a>
                <a class="nav-link" href="product.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Product

                </a>
                <?php
            }
            if ($username == 0 || $username == 2) {
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
    <?php
    $getkey = $con->query("select * from admin")->fetch_assoc();
    ?>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        <?php echo $getkey['username']; ?>
    </div>

</nav>