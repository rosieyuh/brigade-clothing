<header class="main_menu home_menu">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-11">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="index.php"> <img src="img/logo.png" alt="logo" height="42"> </a>
                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="../admin_panel/home.php">HOME</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link " href="../admin_panel/shop.php">  SHOP</a>  
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.php">CONTACT</a>
                                </li>
                                    <?php if (isset($_SESSION["user_id"])): ?>
                                        <li class="nav-item">
                                        <a class="nav-link"><?=htmlspecialchars($user_id["fname"])?></a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" href="logout.php">LOG-OUT</a>
                                        </li>
                                        <?php else: ?>
                                            <li class="nav-item">
                                        <a class="nav-link" href="login.php">LOG-IN</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" href="signup.php">SIGN-UP</a>
                                        </li>
                                    <?php endif; ?>
                                
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>