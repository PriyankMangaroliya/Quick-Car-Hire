<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Feedback</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/login/form.css">
        <?php
        include "./databaseConnection.php";
        include "./sessionwithoutlogin.php";
        ?>
    </head>
    <body>
        <div class="registration-form">
            <form method="post" enctype="multipart/form-data" style="width: 130%">
                <h5 class="title">Feedback</h5>

                <div class="form-group">
                    <select name="rating" class="form-control">
                        <option value="5" class=" ">&#9733; &#9733; &#9733; &#9733; &#9733;</option>
                        <option value="4" class=" ">&#9733; &#9733; &#9733; &#9733;</option>
                        <option value="3" class=" ">&#9733; &#9733; &#9733;</option>
                        <option value="2" class=" ">&#9733; &#9733;</option>
                        <option value="1" class=" ">&#9733;</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea class="form-control item" id="msg" name="msg" placeholder="Feedback" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-block create-account">Send Feedback</button>
                </div>
                <?php
                if (isset($_POST['submit'])) {
                    $rating = $_POST['rating'];
                    $msg = $_POST['msg'];
                    $status = "Unread";

                    $booking_id = base64_decode($_GET['id']);

                    $feedback1 = $conn->prepare("INSERT INTO feedback(Booking_Id,Feedback,Ratting,Status)VALUES(?,?,?,?);");
                    $feedback1->bind_param("ssis", $booking_id, $msg, $rating, $status);
                    $feedback11 = $feedback1->execute();
                    if ($feedback11 > 0) {
                        echo "<script>window.location.href='./history.php'</script>";
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>Not Give Feedback.</div>";
                    }
                }
                ?>
            </form>
        </div>
    </body>
</html>
