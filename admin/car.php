<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Car</title>
        <?php
        include './headerLinks.php';
        include './sessionWithoutLogin.php';
        include './databaseConnection.php';
        ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- html2pdf library -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

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

                    $(document).ready(function () {
                        $('#Car').DataTable();
                    });
                </script>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <main>
                        <form method="post" enctype="multipart/form-data">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <h2 class="m-0 font-weight-bold text-primary">Car</h2>
                                            <a href="#" id="generateBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                                <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>

                                        </div>
                                        <div class="col-lg-2">
                                            <a href="addCar.php" class="btn btn-primary">Add</a>
                                            <input type="submit" class="btn btn-primary" name="Car_delete" id="but_delete"
                                                   value="Delete">
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if (isset($_GET["Status"]) && $_GET["Status"] == 'Deactive') {
                                    $id = $_GET["id"];
                                    // Activate car
                                    $sql = "UPDATE car SEt Status= 'active' WHERE Registration_no = '$id'";
                                    if (mysqli_query($conn, $sql)) {
                                        echo "<script>window.location.href='car.php'</script>";
                                    } else {
                                        echo "Error activating user: " . mysqli_error($conn);
                                    }
                                }


                                if (isset($_GET["Status"]) && $_GET["Status"] == 'active') {
                                    $id = $_GET["id"];
                                    // Activate car
                                    $sql = "UPDATE car SEt Status= 'Deactive' WHERE Registration_No = '$id'";
                                    if (mysqli_query($conn, $sql)) {
                                        echo "<script>window.location.href='car.php'</script>";
                                    } else {
                                        echo "Error activating user: " . mysqli_error($conn);
                                    }
                                }


                                $userRole = $_SESSION['role_id'];
                                if ($userRole == '1') {
                                    $tableHeaders = array(
                                        'Registration_No', 'Name', 'Brand', 'Image', 'City_Id', 'Category_Id', 'Status', 'Hire_Cost', 'Charge_Cost'
                                    );
                                } else {
                                    $tableHeaders = array(
                                        'Registration_No', 'Name', 'Brand', 'Image', 'Category_Id', 'Status', 'Hire_Cost', 'Charge_Cost'
                                    );
                                }

                                $customHeaders = array(
                                    'Registration_No' => 'Registration Number',
                                    'Name' => 'Car Name',
                                    'Brand' => 'Car Brand',
                                    'Image' => 'Car Image',
                                    'Category_Id' => 'Category ID',
                                    'Status' => 'Car Status',
                                    'Hire_Cost' => 'Hire Cost',
                                    'Charge_Cost' => 'Charge Cost'
                                );

                                $selectedColumns = isset($_POST['selected_columns']) ? $_POST['selected_columns'] : $tableHeaders;
                                ?>
                                <div id="Reportresult"></div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable">
                                            <thead>
                                                <tr style="position: sticky;">
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
                                                    // Sanitize the city_id input
                                                    $city_id = $_SESSION['city_id'];
                                                    // Modify the query to include the WHERE clause
                                                    $query = "SELECT * FROM car WHERE City_Id = '$city_id'";
                                                } else {
                                                    $query = "SELECT * FROM car";
                                                }
                                                $result = $conn->query($query);

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        $R_no = $row['Registration_No'];
                                                        echo "<tr><td><input type='checkbox' name='delete[]' value='<?= $R_no ?>'></td>";
                                                        foreach ($tableHeaders as $header) {
                                                            if (in_array($header, $selectedColumns)) {
                                                                if ($header === 'Status') {
                                                                    $Status = $row['Status'];
                                                                    if ($Status == 'Deactive') {
                                                                        echo "<td><a href='car.php?id=$R_no&Status=Deactive'><span class='badge badge-danger'>$Status</span></a></td>";
                                                                    } else {
                                                                        echo "<td><a href='car.php?id=$R_no&Status=active'><span class='badge badge-success'>$Status</span></a></td>";
                                                                    }
                                                                } else {
                                                                    if ($header === 'Image') {
                                                                        $Image = $row['Image'];
                                                                        ?>
                                                                    <td>
                                                                        <img src="../images/carimg/<?php echo $Image; ?>" width="100px"
                                                                             height="100px"></td><?php
                                                                    } else {
                                                                        echo "<td>{$row[$header]}</td>";
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    <td><a href="editCar.php?Rid=<?= base64_encode($R_no); ?>">
                                                            <i class="fa fa-edit"></i></a>
                                                        <?php
                                                        echo "</tr>";
                                                    }
                                                }
                                                ?>
                                                </tbody>
                                        </table>
                                    </div>
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
                        <?php
                        if (isset($_POST['Car_delete'])) {
                            if (isset($_POST['delete'])) {
                                foreach ($_POST['delete'] as $deleteid) {
//                                    $query = "SELECT * FROM car";
//                                    $result = $conn->query($query);
//                                    foreach ($result as $row) {
//                                        $Image = $row['Image'];
//                                    }
                                    $deleteCar = $conn->prepare("DELETE from car WHERE Registration_No=?");
                                    $deleteCar->bind_param("s", $deleteid);
                                    try {
                                        $deleteCar->execute();
                                    } catch (mysqli_sql_exception $e) {
                                        $errorMessage = $e->getMessage();
                                        echo "<script>alert('$errorMessage');</script>";
                                    }
                                }
//                                unlink("CarImg/$Image");
                                echo "<script>window.location.href='car.php'</script>";
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
                                    $isChecked = in_array($header, $selectedColumns) || $header === 'Name' || $header === 'Email';
                                    $disabled = $header === 'Registration_No' ? 'disabled' : '';
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
        <script>
            // Function to get the current date and time
            function getCurrentDateTime() {
                const currentDateTime = new Date();
                return currentDateTime.toLocaleString();
            }

            // Add event listener to the "Generate Report" button
            document.getElementById("generateBtn").addEventListener("click", function () {
                const element = document.getElementById("dataTable");
                const generateBtn = document.getElementById("generateBtn");

                if (element.innerText.includes("No records found!")) {
                    generateBtn.style.display = "none";
                } else {
                    generateBtn.style.display = "inline-block";
                }

                const timestamp = getCurrentDateTime();
                const name = "<?php echo $_SESSION['Admin_name'] ?>";
                const date = timestamp.split(',')[0];
                const time = timestamp.split(',')[1];
                const generatedContent = `
                                    <div style="text-align: center; margin-top: 20px;">
                                        <h3>Quick Car Hire</h3>
                                        <p>Your trusted partner for car rental services</p>
                                    </div>
                                    <pre><h2 style="margin-top:3%;margin-left: 2%;text-align: center">Car Data</h2></pre>
                                    ${element.outerHTML}
                                    <p style="margin-top:3%;text-align: center"><b>Date:</b> ${date} | <b>Time:</b> ${time} | <b>Name:</b> ${name}</p>
                                `;

                html2pdf()
                    .from(generatedContent)
                    .save("car.pdf");
            });
        </script>
        <?PHP include './footerLinks.php'; ?>
    </body>
</html>