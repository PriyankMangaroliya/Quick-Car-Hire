<!DOCTYPE html>
<html lang="en">
    <head>
        <title>City</title>
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
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <main>
                        <form method="post" enctype="multipart/form-data">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <h2 class="m-0 font-weight-bold text-primary">City</h2>
                                            <a href="#" id="generateBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                                <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                                        </div>
                                        <div class="col-lg-2">
                                            <a href="addCity.php" class="btn btn-primary">Add</a>
                                            <input type="submit" class="btn btn-primary" name="City" id="but_delete"
                                                   value="Delete">
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    function Checkboxseleted() {
                                        alert('Please Select any one check box!');
                                    }
                                </script>
                                <?php
                                $userRole = $_SESSION['role_id'];
                                if ($userRole == '1') {
                                    $tableHeaders = array(
                                        'City_Id', 'City', 'Mobile', 'Email', 'Address'
                                    );
                                } else {
                                    $tableHeaders = array(
                                        'City_Id', 'City', 'Mobile', 'Email', 'Address'
                                    );
                                }

                                $selectedColumns = isset($_POST['selected_columns']) ? $_POST['selected_columns'] : $tableHeaders;
                                ?>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <?php
                                                    foreach ($tableHeaders as $header) {
                                                        echo "<th scope=\"col\">$header</th>";
                                                    }
                                                    ?>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM city";
                                                $result = $conn->query($query);

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        $city = $row['City_Id'];
                                                        echo "<tr><td><input type='checkbox' name='delete[]' value='<?= $city ?>'></td>";
                                                        foreach ($tableHeaders as $header) {
                                                            if (in_array($header, $selectedColumns)) {
                                                                echo "<td>{$row[$header]}</td>";
                                                            }
                                                        }
                                                        ?>
                                                    <td><a href="editCity.php?cityid=<?= $city ?>"><i
                                                                class="fa fa-edit"></i></a></td>
                                                        <?php
                                                        echo "</tr>";
                                                    }
                                                }
                                                ?>
                                                <?php
                                                if (isset($_POST['City'])) {
                                                    if (isset($_POST['delete'])) {
                                                        foreach ($_POST['delete'] as $deleteid) {
                                                            $deleteCar = $conn->prepare("DELETE from city WHERE City_Id=?");
                                                            $deleteCar->bind_param("s", $deleteid);
                                                            try {
                                                                $deleteCar->execute();
                                                            } catch (mysqli_sql_exception $e) {
                                                                $errorMessage = $e->getMessage();
                                                                echo "<script>alert('$errorMessage');</script>";
                                                            }
                                                        }
                                                        echo "<script>window.location.href='city.php'</script>";
                                                    } else {
                                                        echo '<script>Checkboxseleted();</script>';
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

                // Create a div to hold only the relevant content for the PDF
                const pdfContent = document.createElement("div");
                pdfContent.innerHTML = `
            <div style="text-align: center; margin-top: 20px;">
                <h3>Quick Car Hire</h3>
                <p>Your trusted partner for car rental services</p>
            </div>
            <pre><h2 style="margin-top:3%;margin-left: 2%;text-align: center">City Data</h2></pre>
            ${element.outerHTML}
            <p style="margin-top:3%;text-align: center"><b>Date:</b> ${date} | <b>Time:</b> ${time} | <b>Name:</b> ${name}</p>
        `;

                // Remove checkboxes and other form elements from the PDF content
                pdfContent.querySelectorAll('input[type="checkbox"]').forEach(function (checkbox) {
                    checkbox.parentNode.removeChild(checkbox);
                });

                // Generate PDF with the modified content
                html2pdf()
                    .from(pdfContent.innerHTML)
                    .save("City.pdf");
            });
        </script>

        <!-- End of Main Content -->
        <?PHP include './footerLinks.php'; ?>
    </body>
</html>