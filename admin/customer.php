<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customers</title>
    <?php
    include './headerLinks.php';
    include './sessionWithoutLogin.php';
    include './databaseConnection.php';
    ?>
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
            <main>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h2 class="m-0 font-weight-bold text-primary">Customer</h2>
                    </div>

                    <?php
                    if (isset($_GET["Status"]) && $_GET["Status"] == 'Deactive') {
                        $id = $_GET["id"];
                        // Activate user
                        $sql = "UPDATE customer Set Customer_Status= 'active' WHERE Email = '$id'";
                        if (mysqli_query($conn, $sql)) {
                            echo "<script>window.location.href='customer.php'</script>";
                        } else {
                            echo "Error activating user: " . mysqli_error($conn);
                        }
                    }

                    if (isset($_GET["Status"]) && $_GET["Status"] == 'active') {
                        $id = $_GET["id"];
                        $sql = "UPDATE customer Set Customer_Status= 'Deactive' WHERE Email = '$id'";
                        if (mysqli_query($conn, $sql)) {
                            echo "<script>window.location.href='customer.php'</script>";
                        } else {
                            echo "Error activating user: " . mysqli_error($conn);
                        }
                    }


                    if (isset($_GET["cid"])) {
                        $cid = $_GET["cid"];

                        $sql1 = "UPDATE customer SET Doc_Status ='Verify' WHERE Email = '$cid'";
                        if (mysqli_query($conn, $sql1)) {
                            echo "<script>window.location.href = 'customer.php'</script>";
                        } else {
                            echo "Error activating user: " . mysqli_error($conn);
                        }
                    }


                    $userRole = $_SESSION['role_id'];
                    if ($userRole == '1') {
                        $tableHeaders = array(
                            'Customer_Id', 'Name', 'Email', 'Mobile', 'Date_Of_Birth', 'Driving_Licence', 'AadharCard', 'Doc_Status','Customer_Status'
                        );
                    } else {
                        $tableHeaders = array(
                            'Customer_Id', 'Name', 'Email', 'Mobile', 'Date_Of_Birth', 'Driving_Licence', 'AadharCard', 'Doc_Status','Customer_Status'
                        );
                    }

                    $selectedColumns = isset($_POST['selected_columns']) ? $_POST['selected_columns'] : $tableHeaders;
                    ?>
                    <form method="post">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <?php
                                        foreach ($tableHeaders as $header) {
                                            echo "<th scope=\"col\">$header</th>";
                                        }
                                        ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query = "SELECT * FROM customer";
                                    $result = $conn->query($query);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            foreach ($tableHeaders as $header) {
                                                if (in_array($header, $selectedColumns)) {
//                                                                echo "<td>{$row[$header]}</td>";
                                                    if ($header === 'Customer_Status') {
                                                        $Status = $row['Customer_Status'];
                                                        $Email = $row['Email'];
                                                        if ($Status == 'Deactive') {
                                                            echo "<td><a href='customer.php?id=$Email&Status=Deactive'><span class='badge badge-danger'>$Status</span></a></td>";
                                                        } else {
                                                            echo "<td><a href='customer.php?id=$Email&Status=active'><span class='badge badge-success'>$Status</span></a></td>";
                                                        }
                                                    }else if ($header === 'Doc_Status') {
                                                        $Doc_Status = $row['Doc_Status'];
                                                        $Email1 = $row['Email'];
                                                        if ($Doc_Status == 'Verify') {
                                                            echo "<td>Verified</td>";
                                                        } else {
                                                            ?>
                                                            <td><a href="customer.php?cid=<?= $Email1; ?>" onclick = "return confirm('Do you really want to verify.')">Verify</a></td>
                                                            <?php
                                                        }
                                                    }else {
                                                        echo "<td>{$row[$header]}</td>";
                                                    }
                                                }
                                            }
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                    <?php
                                    if (isset($_POST['customer_delete'])) {

                                        if (isset($_POST['delete'])) {
                                            foreach ($_POST['delete'] as $deleteid) {
                                                $deleteCustomer = $conn->prepare("DELETE from customer WHERE Email=?");
                                                $deleteCustomer->bind_param("s", $deleteid);
                                                $deleteCustomer->execute();
                                            }
                                            echo "<script>window.location.href='customer.php'</script>";
                                        } else {
                                            echo '<script>Checkboxseleted();</script>';
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                    <script>
                        function toggleForm() {
                            var formContainer = document.getElementById('formContainer');
                            if (formContainer.style.display === 'none' || formContainer.style.display === '') {
                                formContainer.style.display = 'block';
                            } else {
                                formContainer.style.display = 'none';
                            }
                        }

                        function updateDisplayedColumns() {
                            var checkboxes = document.querySelectorAll('input[name="selected_columns[]"]');
                            var tableHeaders = document.querySelectorAll('th');
                            var tableRows = document.querySelectorAll('tbody tr');

                            checkboxes.forEach(function (checkbox, index) {
                                var isChecked = checkbox.checked;
                                var columnHeader = tableHeaders[index];
                                columnHeader.style.display = isChecked ? 'table-cell' : 'none';

                                tableRows.forEach(function (row) {
                                    var cells = row.querySelectorAll('td');
                                    var cell = cells[index];
                                    cell.style.display = isChecked ? 'table-cell' : 'none';
                                });
                            });
                        }
                    </script>
                </div>
            </main>
            <div class="container">
                <button id="moreButton" class="btn btn-primary" onclick="toggleForm()">More Option</button>
                <div id="formContainer" style="display: none;">
                    <form method="post" onchange="updateDisplayedColumns()" id="option">
                        <?php
                        foreach ($tableHeaders as $header) {
                            $isChecked = in_array($header, $selectedColumns) || $header === 'Name' || $header === 'Email';
                            $disabled = $header === 'Name' || $header === 'Email' ? 'disabled' : '';
                            $checked = $isChecked ? 'checked' : '';
                            ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="selected_columns[]"
                                       value="<?php echo $header; ?>" <?php echo $checked; ?> <?php echo $disabled; ?>>
                                <label class="form-check-label"><?php echo $header; ?></label>
                            </div>
                            <?php
                        }
                        ?>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<?PHP include './footerLinks.php'; ?>
</body>
</html>