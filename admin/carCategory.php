<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Car Category</title>
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
                        <form method="post" enctype="multipart/form-data">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-lg-11">
                                            <h2 class="m-0 font-weight-bold text-primary">Car Category</h2>
                                        </div>
                                        <div class="col-lg-1">
                                            <a href="addCategory.php" class="btn btn-primary">Add</a>
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
                                        'Category_Id', 'Category_Name', 'Seats', 'Fuel', 'Transmission'
                                    );
                                } else {
                                    $tableHeaders = array(
                                        'Category_Id', 'Category_Name', 'Seats', 'Fuel', 'Transmission'
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM car_category";
                                                $result = $conn->query($query);

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        $Category_id = $row['Category_Id'];
                                                        echo "<tr><td><input type='checkbox' name='delete[]' value='<?= $Category_id ?>'></td>";

                                                        foreach ($tableHeaders as $header) {
                                                            if (in_array($header, $selectedColumns)) {
                                                                echo "<td>{$row[$header]}</td>";
                                                            }
                                                        }
                                                        ?>
                                                        <?php
                                                        echo "</tr>";
                                                    }
                                                }
                                                ?>
                                                <?php
                                                if (isset($_POST['Category'])) {

                                                    if (isset($_POST['delete'])) {
                                                        foreach ($_POST['delete'] as $deleteid) {
                                                            $deleteCategory = $conn->prepare("DELETE from car_category WHERE Category_Id=?");
                                                            $deleteCategory->bind_param("s", $deleteid);
                                                            try {
                                                                $deleteCategory->execute();
                                                            } catch (mysqli_sql_exception $e) {
//                                       $errorMessage = $e->getMessage();
                                                                echo "<script> alert('this $deleteid Car Category not be deleted!');  </script>";
                                                            }
                                                        }
                                                        echo "<script>window.location.href='carCategory.php'</script>";
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
                                $isChecked = in_array($header, $selectedColumns) || $header === 'Category_Id';
                                $disabled = $header === 'Category_Id' ? 'disabled' : '';
                                $checked = $isChecked ? 'checked' : '';
                                ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="selected_columns[]" value="<?php echo $header; ?>" <?php echo $checked; ?> <?php echo $disabled; ?>>
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
        <?PHP include './footerLinks.php'; ?>
    </body>
</html>