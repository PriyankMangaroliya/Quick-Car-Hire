<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cancel Booking</title>
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
                        <h2 class="m-0 font-weight-bold text-primary">Cancel Booking</h2>
                    </div>

                    <?php
                    if (isset($_GET["id"])) {
                        $id = $_GET["id"];
                        $sql = "UPDATE cancel_booking SET Cancellation_Status ='Approve' WHERE Cancel_Id = '$id'";
                        if (mysqli_query($conn, $sql)) {
                            echo "<script>window.location.href = 'cancelBooking.php'</script>";
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
                                        <th scope="col">Cancel Id</th>
                                        <th scope="col">Booking Id</th>
                                        <th scope="col">Cancellation Date</th>
                                        <th scope="col">Charge Amount</th>
                                        <th scope="col">Refund Amount</th>
                                        <th scope="col">Cancellation Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql1 = $conn->prepare("SELECT * FROM cancel_booking;");
                                    $sql1->execute();
                                    $result = $sql1->get_result();

                                    $id = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $Cancel_Id = $row['Cancel_Id'];
                                        $Booking_Id = $row['Booking_Id'];
                                        $Cancellation_Date = $row['Cancellation_Date'];
                                        $Charge_Amount = $row['Charge_Amount'];
                                        $Refund_Amount = $row['Refund_Amount'];
                                        $Status = $row['Cancellation_Status'];
                                        ?>
                                        <tr id='tr_<?= $id ?>'>
                                            <td><?= $Cancel_Id ?></td>
                                            <td><?= $Booking_Id ?></td>
                                            <td><?= $Cancellation_Date ?></td>
                                            <td><?= $Charge_Amount ?></td>
                                            <td><?= $Refund_Amount ?></td>
                                            <?php if ($Status == 'Approve') { ?>
                                                <td>Booking Cancel : Approve</td>
                                            <?php } else { ?>
                                                <td><a href="cancelBooking.php?id=<?= $Cancel_Id; ?>" onclick="return confirm('Do you really want to cancel booking.')">Cancel Booking</a></td>
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
    $(document).ready(function () {
        $('#dataTable').DataTable({
            "order": [[2, 'desc']]
        });
    });
</script>
<?PHP include './footerLinks.php'; ?>
</body>
</html>