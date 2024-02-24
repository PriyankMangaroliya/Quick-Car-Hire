<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment</title>
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
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h2 class="m-0 font-weight-bold text-primary">Payment</h2>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                    <tr style=" position: sticky;">
                                        <th scope="col">Payment Id</th>
                                        <th scope="col">Booking Id</th>
                                        <th scope="col">Transaction Id</th>
                                        <th scope="col">Payment Amount</th>
                                        <th scope="col">Payment Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query = "SELECT * FROM payment";
                                    $result = $conn->query($query);
                                    while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?= $row['Payment_Id']; ?></td>
                                            <td><?= $row['Booking_Id']; ?></td>
                                            <td><?= $row['Transaction_Id']; ?></td>
                                            <td><?= $row['Payment_Amount']; ?></td>
                                            <td><?= $row['Payment_Date']; ?></td>
                                        </tr>
                                        <?php
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
            "order": [[4, 'desc']]
        });
    });
</script>
<!-- End of Main Content -->
<?PHP include './footerLinks.php'; ?>
</body>
</html>