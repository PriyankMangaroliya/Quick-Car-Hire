<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Reports</title>
        <?php
        include './headerLinks.php';
        include './sessionWithoutLogin.php';
        include './databaseConnection.php';
        ?>
        <style>
            #box {
                background-color: whitesmoke;
                text-align: center;
                width: 350px;
                border: 1px solid;
                padding: 20px;
                /*margin: 20px;*/
            }

            #box:hover {
                box-shadow: 0 0 11px red;
            }
        </style>
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

                    </main>
                </div>
                <!-- End admin -->
            </div>
        </div>
        <!-- End of Main Content -->
        <?PHP include './footerLinks.php'; ?>
    </body>
</html>