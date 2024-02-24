<?php
include '../databaseConnection.php';

$City = $_POST['City'];
$brand = $_POST['Car_brand'];

$sql = "SELECT * FROM car WHERE City_Id = '$City' AND Brand ='$brand' ;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display records
    ?>
    <table class="table table-bordered" border="6" style="color: #1a1e21">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Registration No</th>
                <th scope="col">Car Name</th>
                <th scope="col">Status</th>
                <th scope="col">Category Id</th>
                <th scope="col">Car hire cost</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $i++;
                ?>
                <tr>
                    <th scope="row"><?= $i ?></th>
                    <td><?= $row['Registration_No']; ?></td>
                    <td><?= $row["Name"]; ?></td>
                    <td><?= $row["Status"]; ?></td>
                    <td><?= $row['Category_Id']; ?></td>
                    <td><?= $row['Hire_Cost']; ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody></table>
    <?php
} else {
    echo '<div class="alert alert-success" role="alert" style="margin-top:1rem; ">No records found!</div>';
}
// Close database connection
$conn->close();
?>