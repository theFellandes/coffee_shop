<div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Apollo Coffee ™</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li>
                <a href="shop.php">Shop</a>
            </li>
            <li>
                <a href="login.php">Login</a>
            </li>
            <li>
                <a href="signIn.php">Sign In</a>
            </li>
            <li>
                <a href="admin">Admin</a>
            </li>
            <li>
                <a href="checkout.php">Checkout</a>
            </li>
            <li>
                <a href="contact.php">Contact</a>
            </li>

            <li class="dropdown -align-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ""?> <b class="caret"></b></a>
                <ul class="dropdown-menu">

                    <li class="divider"></li>
                    <li>
                        <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
    <!-- /.navbar-collapse -->
</div>