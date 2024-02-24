<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Reports</title>
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
                        <div class="row">
                            <div class="col">
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h1 class="h3 mb-0 text-gray-800">Booking Status Report</h1>
                                    <a href="#" id="generateBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div id="CarAvailability">
                                            <!-- Car availability report will be loaded here -->
                                        </div>
                                    </div>
                                </div>
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <!-- jsPDF library -->
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>

                                <!-- html2pdf library -->
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

                                <script>
                                    // Function to get the current date and time
                                    function getCurrentDateTime() {
                                        const currentDateTime = new Date();
                                        return currentDateTime.toLocaleString(); // You can customize the date and time format as needed.
                                    }

                                    // Add event listener to the "Generate Report" button
                                    document.getElementById("generateBtn").addEventListener("click", function () {
                                        // Generate the PDF from the main content (Carresult)
                                        const element = document.getElementById("CarAvailability").innerHTML;
                                        const timestamp = getCurrentDateTime();
                                        const name = "<?php echo $_SESSION['Admin_name'] ?>";
                                        const date = timestamp.split(',')[0];
                                        const time = timestamp.split(',')[1];
                                        const generatedContent = `
<div style="text-align: center; margin-top: 20px;">
                    <h3>Quick Car Hire</h3>
                    <p>Your trusted partner for car rental services</p>
                </div>
                               <pre><h2 style="margin-top:3%;margin-left: 2%;text-align: center">Booking Status Report</h2></pre>
                              <pre style="margin-right:5%;margin-left: 5%;">${element}</pre>
                               <p style="margin-top:3%;text-align: center"><b>Name:</b> ${name} | <b>Date:</b> ${date} | <b>Time:</b> ${time}</p>
                            `;
                                        html2pdf()
                                                .from(generatedContent)
                                                .save("Booking Status Report.pdf");
                                    });
                                </script>
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(document).ready(function () {
                                        loadCarAvailabilityReport(); // Load the report on page load

                                        // Function to load the report using Ajax
                                        function loadCarAvailabilityReport() {
                                            $.ajax({
                                                url: "./ajax/bookingStatus.php", // PHP script to fetch data from the database
                                                type: "POST",
                                                dataType: "html",
                                                success: function (data) {
                                                    $("#CarAvailability").html(data); // Display the report on the page
                                                },
                                                error: function () {
                                                    alert("Error occurred while fetching the report.");
                                                }
                                            });
                                        }

                                        // Set up a timer to refresh the report every 30 seconds (optional)
                                        setInterval(loadCarAvailabilityReport, 30000);
                                    });
                                </script>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
        <!-- End of Main Content -->
        <?PHP include './footerLinks.php'; ?>
    </body>
</html>