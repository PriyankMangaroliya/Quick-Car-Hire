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
                                    <h1 class="h3 mb-0 text-gray-800">Total Bookings</h1>
                                    <a href="#" id="generateBtn"
                                       class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                                </div>
                                <script>
                                    $(document).ready(function () {
                                        $("#myReport").submit(function (event) {
                                            // Stop form from submitting normally
                                            event.preventDefault();

                                            // Get form data
                                            var formData = $(this).serialize();

                                            // Submit form data using AJAX
                                            $.ajax({
                                                type: "POST",
                                                url: "./ajax/bookingReport.php",
                                                data: formData,
                                                success: function (response) {
                                                    // Display results
                                                    $("#Reportresult").html(response);
                                                },
                                                error: function () {
                                                    // Display error message
                                                    alert("Error selecting records");
                                                }
                                            });
                                        });
                                    });
                                </script>
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" enctype="multipart/form-data" id="myReport">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label> FromDate :</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>ToDate :</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="ToDate" id="ToDate"
                                                           autocomplete="Off" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="FromDate" id="FromDate"
                                                           autocomplete="Off" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary">Search</button>
                                                </div>
                                            </div>
                                            <div class="row">

                                            </div>
                                            <div id="Reportresult"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- jsPDF library -->
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>


                        <script>
                                    // Function to get the current date and time
                                    function getCurrentDateTime() {
                                        const currentDateTime = new Date();
                                        return currentDateTime.toLocaleString(); // You can customize the date and time format as needed.
                                    }

                                    // Add event listener to the "Generate Report" button
                                    document.getElementById("generateBtn").addEventListener("click", function () {
                                        const element = document.getElementById("Reportresult").innerHTML;
                                        const timestamp = getCurrentDateTime();
                                        const name = "<?php echo $_SESSION['Admin_name'] ?>";
                                        const date = timestamp.split(',')[0];
                                        const time = timestamp.split(',')[1];
                                        const generatedContent = `
                               <div style="text-align: center; margin-top: 20px;">
                    <h3>Quick Car Hire</h3>
                    <p>Your trusted partner for car rental services</p>
                </div><pre><h2 style="margin-top:3%;margin-left: 2%;text-align: center">Total Bookings</h2></pre>
                              <pre style="margin-right:5%;margin-left: 5%;">${element}</pre>
                               <p style="margin-top:3%;text-align: center"><b>Name:</b> ${name} | <b>Date:</b> ${date} | <b>Time:</b> ${time}</p>
                            `;
                                        html2pdf()
                                                .from(generatedContent)
                                                .save("Total Bookings.pdf");
                                    });


                                    $(function () {
                                        $("#ToDate").datepicker({
                                            numberOfMonths: 1,
                                            dateFormat: "yy-mm-dd",
                                            onSelect: function (selected) {
                                                var dt = new Date(selected);
                                                dt.setDate(dt.getDate() + 1);
                                                $("#FromDate").datepicker("option", "minDate", dt);
                                            }
                                        });
                                        $("#FromDate").datepicker({
                                            numberOfMonths: 1,
                                            dateFormat: "yy-mm-dd",
                                            onSelect: function (selected) {
                                                var dt = new Date(selected);
                                                dt.setDate(dt.getDate() - 1);
                                                $("#ToDate").datepicker("option", "maxDate", dt);
                                            }
                                        });
                                    });
                        </script>
                    </main>
                </div>
            </div>
        </div>
        <!-- End of Main Content -->
        <?PHP include './footerLinks.php'; ?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css" rel="Stylesheet" type="text/css"/>
        <script src="html2pdf.bundle.min.js"></script>
    </body>
</html>