<?php

//
session_start();
include './databaseConnection.php';
$Admin_email_id = $_POST['Email'];
$Admin_password = $_POST['password'];

$sql = $conn->prepare("SELECT * FROM administrator WHERE Email =? && Password = ?");
$sql->bind_param("ss", $Admin_email_id, $Admin_password);
$sql->execute();
$adminResult = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

$sql = $conn->prepare("SELECT * FROM employee WHERE Email =? && Password = ?   ");
$sql->bind_param("ss", $Admin_email_id, $Admin_password);
$sql->execute();
$employeeResult = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

if ($adminResult) {
    foreach ($adminResult as $row) {
        $user_email = $row['Name'];
        $curr_status = $row['Status'];
    }
    if ($curr_status == 'Deactive') {
        echo '<div class="alert border-bottom-danger" role="alert">Sorry, your account is temporarily deactivated by the admin.</div>';
    } else {
        $_SESSION['Admin_name'] = $adminResult[0]['Name'];
        $_SESSION['islogin'] = true;
        $_SESSION['role_id'] = 1;
        echo "<script>window.location.href='./dashboard.php'</script>";
    }
} elseif ($employeeResult) {
    foreach ($employeeResult as $row) {
        $user_email = $row['Name'];
        $curr_status = $row['Status'];
        $role_id = $row['Role_Id'];
        $city_id = $row['City_Id'];
    }
    if ($curr_status == 'Deactive') {
        echo '<div class="alert border-bottom-danger" role="alert">Sorry, your account is temporarily deactivated by the admin.</div>';
    } else {
        $_SESSION['Admin_name'] = $employeeResult[0]['Name'];
        $_SESSION['islogin'] = true;
        $_SESSION['role_id'] = $role_id;
        $_SESSION['city_id'] = $city_id;
        echo "<script>window.location.href='./mDashborad.php'</script>";
    }
} else {
    echo '<div class="alert border-bottom-danger" role="alert">Please enter valid login data!.</div>';
}
?>

