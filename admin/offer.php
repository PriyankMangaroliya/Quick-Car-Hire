<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Offer</title>
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
                <script>
                    function Checkboxseleted() {
                        alert('Please Select any one check box!');
                    }
                </script>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <main>
                        <form method="post" ENCTYPE="multipart/form-data">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <h2 class="m-0 font-weight-bold text-primary">Offer</h2>
                                        </div>
                                        <div class="col-lg-2">
                                            <a href="addOffer.php" class="btn btn-primary">Add</a>
                                            <input type="submit" class="btn btn-primary" name="Offers_delete" id="but_delete"
                                                   value="Delete">
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if (isset($_GET["Status"]) && $_GET["Status"] == 'Deactive') {
                                    $id = $_GET["id"];
                                    // Activate user
                                    $sql = "UPDATE offer SET Status='active' WHERE Code = '$id'";
                                    if (mysqli_query($conn, $sql)) {
                                        echo "<script>window.location.href='offer.php'</script>";
                                    } else {
                                        echo "Error activating user: " . mysqli_error($conn);
                                    }
                                }

                                if (isset($_GET["Status"]) && $_GET["Status"] == 'active') {
                                    $id = $_GET["id"];
                                    // Activate user
                                    $sql = "UPDATE offer SET Status='Deactive' WHERE Code = '$id'";
                                    if (mysqli_query($conn, $sql)) {
                                        echo "<script>window.location.href='offer.php'</script>";
                                    } else {
                                        echo "Error activating user: " . mysqli_error($conn);
                                    }
                                }

                                $userRole = $_SESSION['role_id'];
                                if ($userRole == '1') {
                                    $tableHeaders = array(
                                        'Code', 'Name', 'Image', 'Percentage', 'Start_Date', 'End_Date', 'Status'
                                    );
                                } else {
                                    $tableHeaders = array(
                                        'Code', 'Name', 'Image', 'Percentage', 'Start_Date', 'End_Date', 'Status'
                                    );
                                }


                                $customHeaders = array(
                                    'Code' => 'Offer Code',
                                    'Name' => 'Offer Name',
                                    'Image' => 'Image',
                                    'Percentage' => 'Discount(%)',
//                                'Registration_No' => 'R. No',
                                    'Start_Date' => 'Start Date',
                                    'End_Date' => 'End Date',
//                            'City_Id' => 'City ID',
                                    'Status' => 'Status'
                                );

                                $selectedColumns = isset($_POST['selected_columns']) ? $_POST['selected_columns'] : $tableHeaders;
                                ?>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <?php
                                                    foreach ($tableHeaders as $header) {
                                                        $displayName = isset($customHeaders[$header]) ? $customHeaders[$header] : $header;
                                                        echo "<th scope=\"col\">$displayName</th>";
                                                    }
                                                    ?>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($_SESSION['city_id'])) {
                                                    $city_id = $_SESSION['city_id'];
                                                    $query = "SELECT * FROM offer";
                                                } else {
                                                    $query = "SELECT * FROM offer";
                                                }

                                                $result = $conn->query($query);

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        $Offer_Code = $row['Code'];
                                                        echo "<tr><td><input type='checkbox' name='delete[]' value='<?= $Offer_Code ?>'></td>";
                                                        foreach ($tableHeaders as $header) {
                                                            if (in_array($header, $selectedColumns)) {
                                                                if ($header === 'Status') {
                                                                    $Status = $row['Status'];

                                                                    $Offer_Start_Date = $row['Start_Date'];
                                                                    $Offer_End_Date = $row['End_Date'];
                                                                    $currentDate = date('Y-m-d');

                                                                    if ($currentDate < $Offer_Start_Date) {
                                                                        $Status = 'Pending';
                                                                        $EndOffer = $conn->prepare(" UPDATE offer SET Status=? WHERE Code =?");
                                                                        $EndOffer->bind_param("ss", $Status, $Offer_Code);
                                                                        $EndOffer->execute();
                                                                    } elseif ($currentDate >= $Offer_Start_Date && $currentDate <= $Offer_End_Date) {
                                                                        $Status = 'Current';
                                                                        $StartOffer = $conn->prepare(" UPDATE offer SET Status=? WHERE Code =?");
                                                                        $StartOffer->bind_param("ss", $Status, $Offer_Code);
                                                                        $StartOffer->execute();
                                                                    } elseif ($currentDate > $Offer_End_Date) {
                                                                        $Status = 'Completed';
                                                                        $EndOffer = $conn->prepare(" UPDATE offer SET Status=? WHERE Code =?");
                                                                        $EndOffer->bind_param("ss", $Status, $Offer_Code);
                                                                        $EndOffer->execute();
                                                                    }

                                                                    if ($Status == 'Completed') {
                                                                        echo "<td><span class='badge badge-secondary'>$Status</span></td>";
                                                                    } else if ($Status == 'Pending') {
                                                                        echo "<td><span class='badge badge-info'>$Status</span></td>";
                                                                    } else {
                                                                        echo "<td><span class='badge badge-success'>$Status</span></td>";
                                                                    }
                                                                } else {
                                                                    if ($header === 'Image') {
                                                                        $Image = $row['Image'];
                                                                        ?>
                                                                    <td>
                                                                        <img src="../images/offerimg/<?php echo $Image; ?>"
                                                                             width="100px" height="100px"></td><?php
                                                                    } else {
                                                                        echo "<td>{$row[$header]}</td>";
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    <td><a href="editOffer.php?id=<?= base64_encode($Offer_Code); ?>"><i
                                                                class="fa fa-edit"></i></a></td>
                                                        <?php
                                                        echo "</tr>";
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
                <?php
                if (isset($_POST['Offers_delete'])) {
                    if (isset($_POST['delete'])) {
                        foreach ($_POST['delete'] as $deleteid) {
                            $deleteOffer = $conn->prepare("DELETE from offer WHERE Code=?");
                            $deleteOffer->bind_param("s", $deleteid);
                            try {
                                $deleteOffer->execute();
                            } catch (mysqli_sql_exception $e) {
                                $errorMessage = $e->getMessage();
                                echo "<script>alert('$errorMessage');</script>";
                            }
                        }
                        echo "<script>window.location.href='offer.php'</script>";
                        $msg = "Offer record deleted successfully";
                    } else {
                        echo '<script>Checkboxseleted();</script>';
                    }
                }
                ?>
                </main>
                <div class="container">
                    <button id="moreButton" class="btn btn-primary" onclick="toggleForm()">More Option</button>
                    <div id="formContainer" style="display: none;">
                        <form method="post" onchange="updateDisplayedColumns()" id="option">
                            <?php
                            foreach ($tableHeaders as $header) {
                                $isChecked = in_array($header, $selectedColumns) || $header === 'Name' || $header === 'Code';
                                $disabled = $header === 'Name' || $header === 'Code' ? 'disabled' : '';
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
        <script>
            $(document).ready(function () {
                $('#dataTable').DataTable({
                    "order": [[5, 'asc']]
                });
            });
        </script>
        <?PHP include './footerLinks.php'; ?>
    </body>
</html>