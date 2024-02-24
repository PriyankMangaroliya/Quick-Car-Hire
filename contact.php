<!DOCTYPE html>
<html lang="en">
    <head>
        <title>QuickCarHire | Contact us</title>
        <?php
        include "./headLink.php";
        include "./databaseConnection.php";
        include "./header.php";
        ?>
    </head>
    <body>
        <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bgimg/car-3.jpg');background-position: center;">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                    <div class="col-md-9 ftco-animate pb-5">
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span>
                            <span>Contact <i class="ion-ios-arrow-forward"></i></span></p>
                        <h1 class="mb-3 bread">Contact Us</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-section contact-section">
            <div class="container">
                <div class="row d-flex mb-1 contact-info">
                    <div class="col-md-12 block-9">
                        <?php
                        if (isset($_POST['submit'])) {
                            $cname = $_POST['cname'];
                            $email = $_POST['email'];
                            $sub = $_POST['sub'];
                            $message = $_POST['message'];

                            $contact = $conn->prepare("INSERT INTO contact (Name, Email,Subject,Message)VALUES (?,?,?,?)");
                            $contact->bind_param("ssss", $cname, $email, $sub, $message);
                            $contactshow = $contact->execute();
                            if ($contactshow > 0) {
                                include 'ajax/contactMail.php';
                                ContactMail($email, $sub, $message);
                                echo '<div class="alert alert-success" role="alert">Sent Message.</div>';
                            } else {
                                echo '<div class="alert alert-danger" role="alert">Not Sent Message.</div>';
                            }
                        }
                        ?>
                        <form action="#" class="bg-light p-4 contact-form" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Name" id="cname" name="cname"
                                       required="">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Email" name="email" required="">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Subject" name="sub" required="">
                            </div>
                            <div class="form-group">
                                <textarea rows="4" class="form-control" name="message" required=""
                                          placeholder="Message"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5" name="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <?php
        include "./footerLink.php";
        ?>
    </body>
</html>