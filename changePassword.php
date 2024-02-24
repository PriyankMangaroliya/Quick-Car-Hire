<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Change Password</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/login/form.css">
    </head>
    <body>
        <div class="registration-form">
            <form method="post" enctype="multipart/form-data" style="width: 110%">
                <h5 class="title">Change Password</h5>

                <div class="form-group">
                    <input type="text" class="form-control item" id="email" placeholder="Email">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control item" id="opassword" name="opassword" placeholder="Old Password">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control item" id="npassword" name="npassword" placeholder="New Password">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control item" id="cpassword" name="cpassword" placeholder="Confirm Password">
                </div>

                <div class="form-group">
                    <button type="button" class="btn btn-block create-account">Save</button>
                </div>

            </form>
        </div>
    </body>
</html>
