<!-- Main Content -->
<div id="content">
    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->
        <form
            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
<!--                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."-->
                <!--                       aria-label="Search" aria-describedby="basic-addon2">-->
                <!--                <div class="input-group-append">-->
                <!--                    <button class="btn btn-primary" type="button">-->
                <!--                        <i class="fas fa-search fa-sm"></i>-->
                <!--                    </button>-->
                <!--                </div>-->
                <h1>Quick Car Hire</h1>
            </div>
        </form>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                     aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                   placeholder="Search for..." aria-label="Search"
                                   aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <!-- Nav Item - Alerts -->
            <!--            <li class="nav-item dropdown no-arrow mx-1">-->
            <!--                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"-->
            <!--                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
            <!--                    <i class="fas fa-bell fa-fw"></i>-->
            <!-- Counter - Alerts -->
<!--                    <span class="badge badge-danger badge-counter">3+</span>-->
            <!--                </a>-->
            <!-- Dropdown - Alerts -->
            <!--                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"-->
            <!--                     aria-labelledby="alertsDropdown">-->
            <!--                    <h6 class="dropdown-header">-->
            <!--                        Alerts Center-->
            <!--                    </h6>-->
            <!--                    <a class="dropdown-item d-flex align-items-center" href="#">-->
            <!--                        <div class="mr-3">-->
            <!--                            <div class="icon-circle bg-primary">-->
            <!--                                <i class="fas fa-file-alt text-white"></i>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div>-->
            <!--                            <div class="small text-gray-500">December 12, 2019</div>-->
            <!--                            <span class="font-weight-bold">A new monthly report is ready to download!</span>-->
            <!--                        </div>-->
            <!--                    </a>-->
            <!--                    <a class="dropdown-item d-flex align-items-center" href="#">-->
            <!--                        <div class="mr-3">-->
            <!--                            <div class="icon-circle bg-success">-->
            <!--                                <i class="fas fa-donate text-white"></i>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div>-->
            <!--                            <div class="small text-gray-500">December 7, 2019</div>-->
            <!--                            $290.29 has been deposited into your account!-->
            <!--                        </div>-->
            <!--                    </a>-->
            <!--                    <a class="dropdown-item d-flex align-items-center" href="#">-->
            <!--                        <div class="mr-3">-->
            <!--                            <div class="icon-circle bg-warning">-->
            <!--                                <i class="fas fa-exclamation-triangle text-white"></i>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div>-->
            <!--                            <div class="small text-gray-500">December 2, 2019</div>-->
            <!--                            Spending Alert: We've noticed unusually high spending for your account.-->
            <!--                        </div>-->
            <!--                    </a>-->
            <!--                    <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>-->
            <!--                </div>-->
            <!--            </li>-->

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-envelope fa-fw"></i>
                    <!-- Counter - Messages -->
                    <?php
                    $query = "SELECT COUNT(*) as count FROM contact WHERE Status = 'Unread'";
                    // Execute the query and fetch the result
                    $result = $conn->query($query);
                    $count = $result->fetch_assoc()['count'];
                    ?>
                    <span class="badge badge-danger badge-counter"><?= $count; ?></span>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                     aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">
                        Message Center
                    </h6>
                    <?php
                    $sql = "SELECT * FROM contact WHERE Status = 'Unread'";
                    $result = $conn->query($sql);

                    $id = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        $Contact_Id = $row['Contact_Id'];
                        $name = $row['Name'];
                        $sub = $row['Email'];
                        $message = $row['Subject'];
                        $Status = $row['Status'];
                        if ($Status == 'Unread') {
                            ?>
                            <a class="dropdown-item d-flex align-items-center" href="contact.php?id=<?= $Contact_Id; ?>" onclick="return confirm('Do you really want to read')">

                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                         alt="...">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate"><?= $message; ?></div>
                                    <div class="small text-gray-500"><?= $name; ?>
                                        <!--                                        · 58m-->
                                    </div>
                                </div>
                            </a>
                            <?php
                        }
                    }
                    ?>
                    <a class="dropdown-item text-center small text-gray-500" href="contact.php">Read More Messages</a>
                </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['Admin_name'] ?></span>
                    <img class="img-profile rounded-circle"
                         src="img/undraw_profile.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                     aria-labelledby="userDropdown">
                    <!--                    <a class="dropdown-item" href="#">-->
                    <!--                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>-->
                    <!--                        Profile-->
                    <!--                    </a>-->
                    <?php
                    $role = $_SESSION['role_id'];
                    if ($role == '1') {
                        ?>
                        <a class="dropdown-item" href="settings.php">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                    <?php }
                    ?>
                    <!--                    <a class="dropdown-item" href="#">-->
                    <!--                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>-->
                    <!--                        Activity Log-->
                    <!--                    </a>-->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- End of Topbar -->
</div>


<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>