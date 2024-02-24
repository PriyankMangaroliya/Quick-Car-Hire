<!DOCTYPE html>
<html>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container">
                <img src="images/iconbg.png" width="70px" height="70px" alt="Quick Car Hire">
                <a class="navbar-brand" href="index.php">Quick<span>Car</span>Hire</a>
                <!--                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="oi oi-menu"></span> Menu
                                </button>-->

                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a href="index.php" class="nav-link"><b>Home</b></a></li>
                        <li class="nav-item"><a href="offer.php" class="nav-link" target="_blank"><b>Offers</b></a></li>
                        <li class="nav-item"><a href="about.php" class="nav-link"><b>About</b></a></li>
                        <li class="nav-item"><a href="contact.php" class="nav-link"><b>Contact</b></a></li>
                        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <b>Profile</b>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="data.php"><b>My Account</b></a>
                                    <a class="dropdown-item" href="history.php"><b>My Booking</b></a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php"><b>Log Out</b></a>
                                </div>
                            </li>
                            <?php
                        } else {
                            echo '<li class="nav-item"><a href="login.php" class="nav-link"><b>Login/Registration</b></a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </body>
</html>