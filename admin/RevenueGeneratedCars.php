<!DOCTYPE html>
<html lang="en">
<head>
    <title>Car Revenue Report</title>
    <?php
    // Include necessary PHP files and establish a database connection
    include './headerLinks.php';
    include './sessionWithoutLogin.php';
    include './databaseConnection.php';
    ?>
    <!-- Include jQuery and html2pdf libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>
<body id="page-top">
<div id="wrapper">
    <?php
    // Include sidebar, header, and other necessary PHP files
    include './sidebar.php';
    ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <?php
        include './header.php';
        ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <main>
                <div class="row">
                    <div class="col">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Car Revenue Report</h1>
                            <a href="#" id="generateBtn"
                               class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                               onclick="generatePDF()">
                                <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered" id="revenueTable">
                                    <tr>
                                        <th>Registration No</th>
                                        <th>Car Name</th>
                                        <th>Brand</th>
                                        <th>Total Revenue</th>
                                    </tr>

                                    <?php
                                    // Fetch data from the database
                                    $sql = "
                                            SELECT
                                                c.Registration_No,
                                                c.Name AS Car_Name,
                                                c.Brand,
                                                SUM(b.Total_Amount) AS Total_Revenue
                                            FROM
                                                booking b
                                            JOIN
                                                car c ON b.Registration_No = c.Registration_No
                                            WHERE
                                                b.Status = 'Completed'
                                            GROUP BY
                                                c.Registration_No, c.Name, c.Brand
                                            ORDER BY
                                                Total_Revenue DESC;
                                        ";

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // Display the result set in HTML table
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>{$row['Registration_No']}</td>";
                                            echo "<td>{$row['Car_Name']}</td>";
                                            echo "<td>{$row['Brand']}</td>";
                                            echo "<td>{$row['Total_Revenue']}</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No records found!</td></tr>";
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
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
            const element = document.getElementById("revenueTable");
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
<h2 style="margin-top:3%;text-align: center">Car Revenue Report</h2>
                ${element.outerHTML}
                <p style="margin-top:3%;text-align: center"><b>Name:</b> ${name} | <b>Date:</b> ${date} | <b>Time:</b> ${time}</p>

            `;

            html2pdf()
                .from(generatedContent)
                .save("Car_Revenue_Report.pdf");
        });
    </script>

    <?php
    // Include footer and other necessary PHP files
    include './footerLinks.php';
    ?>
</body>
</html>
