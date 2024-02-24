<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Feedback</title>
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
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h2 class="m-0 font-weight-bold text-primary">Customer Feedback</h2>
<!--                                <a href="#" id="generateBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">-->
<!--                                    <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
                            </div>

                            <?php
                            if (isset($_GET["id"])) {
                                $id = $_GET["id"];

                                $sql = "UPDATE feedback SET Status ='Read' WHERE Feedback_Id = '$id'";
                                if (mysqli_query($conn, $sql)) {
                                    echo "<script>window.location.href = 'feedback.php'</script>";
                                } else {
                                    echo "Error activating user: " . mysqli_error($conn);
                                }
                            }
                            ?>

                            <form method="post">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable">
                                            <thead>
                                                <tr style=" position: sticky;">
                                                    <th scope="col">Id</th>
                                                    <th scope="col">Booking Id</th>
                                                    <th scope="col">Feedback</th>
                                                    <th scope="col">Ratting</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
//                                    $sql1 = $conn->prepare("SELECT * FROM feedback ORDER BY Status ASC");
                                                $sql1 = $conn->prepare("SELECT * FROM feedback;");
                                                $sql1->execute();
                                                $result = $sql1->get_result();

                                                $id = 1;
                                                while ($row = $result->fetch_assoc()) {
                                                    $Feedback_Id = $row['Feedback_Id'];
                                                    $Booking_Id = $row['Booking_Id'];
                                                    $Feedback = $row['Feedback'];
                                                    $Ratting = $row['Ratting'];
                                                    $Status = $row['Status'];
                                                    ?>
                                                    <tr id='tr_<?= $id ?>'>
                                                        <td><?= $Feedback_Id ?></td>
                                                        <td><?= $Booking_Id ?></td>
                                                        <td><?= $Feedback ?></td>
                                                        <td><?= $Ratting ?></td>
                                                        <?php if ($Status == 'Read') { ?>
                                                            <td>Read</td>
                                                        <?php } else { ?>
                                                            <td><a href="feedback.php?id=<?= $Feedback_Id; ?>"
                                                                   onclick="return confirm('Do you really want to read')">UnRead</a>
                                                            </td>
                                                        <?php } ?>
                                                    </tr>
                                                    <?php
                                                    $id++;
                                                }
                                                ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </main>
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
                                    <pre><h2 style="margin-top:3%;margin-left: 2%;text-align: center">Feedback <Data></Data></h2></pre>
                                    ${element.outerHTML}
                                    <p style="margin-top:3%;text-align: center"><b>Date:</b> ${date} | <b>Time:</b> ${time} | <b>Name:</b> ${name}</p>
                                `;

                html2pdf()
                    .from(generatedContent)
                    .save("FeedBack.pdf");
            });
        </script>
        <script>
            $(document).ready(function () {
                $('#dataTable').DataTable({
                    "order": [[4, 'desc']]
                });
            });
        </script>
        <?PHP include './footerLinks.php'; ?>
    </body>
</html>