<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Contact</title>
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
                                <h2 class="m-0 font-weight-bold text-primary">Customer Contacts</h2>
                            </div>

                            <?php
                            if (isset($_GET["id"])) {
                                $id = $_GET["id"];

                                $sql = "UPDATE contact SET Status ='Read' WHERE Contact_Id = '$id'";
                                if (mysqli_query($conn, $sql)) {
                                    echo "<script>window.location.href = 'contact.php'</script>";
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
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Subject</th>
                                                    <th scope="col">Message</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql1 = $conn->prepare("SELECT * FROM contact;");
                                                $sql1->execute();
                                                $result = $sql1->get_result();

                                                $id = 1;
                                                while ($row = $result->fetch_assoc()) {
                                                    $Contact_Id = $row['Contact_Id'];
                                                    $Name = $row['Name'];
                                                    $Email = $row['Email'];
                                                    $sub = $row['Subject'];
                                                    $message = $row['Message'];
                                                    $Status = $row['Status'];
                                                    ?>
                                                    <tr id='tr_<?= $id ?>'>
                                                        <td><?= $Contact_Id ?></td>
                                                        <td><?= $Name ?></td>
                                                        <td><?= $Email ?></td>
                                                        <td><?= $sub ?></td>
                                                        <td><?= $message ?></td>
                                                        <?php if ($Status == 'Read') { ?>
                                                            <td>Read</td>
                                                        <?php } else { ?>
                                                            <td><a href="contact.php?id=<?= $Contact_Id; ?>" onclick="return confirm('Do you really want to read')">UnRead</a>
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
            $(document).ready(function () {
                $('#dataTable').DataTable({
                    "order": [[5, 'desc']]
                });
            });
        </script>
        <?PHP include './footerLinks.php'; ?>
    </body>
</html>