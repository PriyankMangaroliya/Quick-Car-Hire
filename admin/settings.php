<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Role Menu Settings</title>
        <?php
        include './headerLinks.php';
        include './sessionWithoutLogin.php';
        include './databaseConnection.php';
        ?>
        <style>
            input[type="checkbox"] {
                visibility: hidden;
                &:checked + label {
                    transform: rotate(360deg);
                    background-color: #000;
                    &:before {
                        transform: translateX(40px);
                        background-color: #FFF;
                    }
                }
            }

            label {
                display: flex;
                width: 75px;
                height: 35px;
                border: 5px solid;
                border-radius: 95em;
                position: relative;
                transition: transform .75s ease-in-out;
                transform-origin: 40% 40%;
                cursor: pointer;

                &:before {
                    transition: transform .75s ease;
                    transition-delay: .5s;
                    content: "";
                    display: block;
                    position: absolute;
                    width:20px;
                    height:20px;
                    background-color: #000;
                    border-radius: 50%;
                    top: 3px;
                    left: 3px;
                }
            }
        </style>
    </head>
    <body id="page-top">
        <div id="wrapper">
            <?php
            include './sidebar.php';
            ?>
            <div id="content-wrapper" class="d-flex flex-column">
                <?php
                include './header.php';
                ?>
                <!-- Begin Page Content -->

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Settings</h1>
                    </div>

                    <?php
                    $query = "SELECT * FROM role_menu";
                    $result = $conn->query($query);

                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <form method="post" enctype="multipart/form-data" id="<?= $row['Name'] ?>" name="<?= $row['Name'] ?>">
                            <!-- Collapsable Card Example -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample<?= $row['Role_Id'] ?>" class="d-block card-header " data-toggle="collapse"
                                   role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $row['Name'] ?> Menu</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse" id="collapseCardExample<?= $row['Role_Id'] ?>">
                                    <div class="card-body">
                                        <?php
                                        $checkboxes = [
                                            'Admin Dashboard' => 'A_Dashboard',
                                            'Manager Dashboard' => 'M_Dashboard',
                                            'Admin' => 'Admin',
                                            'Employee' => 'Employee',
                                            'Customer' => 'Customer',
                                            'Booking' => 'Booking',
                                            'Payment' => 'Payment',
                                            'Cancel' => 'Cancel',
                                            'City' => 'City',
                                            'Car' => 'Car',
                                            'Category' => 'Category',
                                            'Offer' => 'Offer',
                                            'Contact' => 'Contact',
                                            'Feedback' => 'Feedback',
                                            'Report' => 'Report'
                                        ];

                                        foreach ($checkboxes as $label => $name) {
                                            $isChecked = $row[$name] == 1 ? 'checked' : '';
                                            $id = $name . $row['Role_Id'];
                                            ?>
                                            <div class="row align-self-center align-items-center align-content-center">
                                                <div class="col-3">
                                                    <h5><?= $label ?></h5>
                                                </div>
                                                <div class="col-3">
                                                    <div class="">
                                                        <input type="checkbox" id="<?= $id ?>" name="<?= $name ?>" <?= $isChecked ?>>
                                                        <label for="<?= $id ?>"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="submit" class="btn btn-primary" name="<?= $row['Name'] ?>" id="<?= $row['Name'] ?>" value="Save">
                                            </div>
                                            <?php
                                            $name = $row['Name'];
                                            if (isset($_POST["$name"])) {

                                                $switches = array(
                                                    'A_Dashboard' => isset($_POST['A_Dashboard']) ? 1 : 0,
                                                    'M_Dashboard' => isset($_POST['M_Dashboard']) ? 1 : 0,
                                                    'Admin' => isset($_POST['Admin']) ? 1 : 0,
                                                    'employee' => isset($_POST['employee']) ? 1 : 0,
                                                    'Customer' => isset($_POST['Customer']) ? 1 : 0,
                                                    'Booking' => isset($_POST['Booking']) ? 1 : 0,
                                                    'Payment' => isset($_POST['Payment']) ? 1 : 0,
                                                    'Cancel' => isset($_POST['Cancel']) ? 1 : 0,
                                                    'City' => isset($_POST['City']) ? 1 : 0,
                                                    'Car' => isset($_POST['Car']) ? 1 : 0,
                                                    'Category' => isset($_POST['Category']) ? 1 : 0,
                                                    'Offer' => isset($_POST['Offer']) ? 1 : 0,
                                                    'Contact' => isset($_POST['Contact']) ? 1 : 0,
                                                    'Feedback' => isset($_POST['Feedback']) ? 1 : 0,
                                                    'Report' => isset($_POST['Report']) ? 1 : 0
                                                );

                                                $stmt = $conn->prepare("UPDATE role_menu SET A_Dashboard=?,M_Dashboard=?,Admin=?,Customer=?,Booking=?,Payment=?,Cancel=?,City=?,Car=?,Category=?,Offer=?,Contact=?,Feedback=?,Report=? WHERE Role_Id = ? ");
                                                $stmt->bind_param("iiiiiiiiiiiiiii", $switches['A_Dashboard'], $switches['M_Dashboard'], $switches['Admin'], $switches['Customer'], $switches['Booking'],$switches['Payment'],$switches['Cancel'], $switches['City'], $switches['Car'], $switches['Category'], $switches['Offer'], $switches['Contact'], $switches['Feedback'], $switches['Report'], $row['Role_Id']);
                                                $result = $stmt->execute();
                                                if ($result > 0) {
                                                    echo "<script>window.location.href='settings.php'</script>";
                                                } else {
                                                    echo "<script> alert('$conn->error');</script>";
                                                }
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                                <!-- End of Main Content -->
                            </div>
                        </form>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
        <?PHP include './footerLinks.php'; ?>
    </body>
</html>