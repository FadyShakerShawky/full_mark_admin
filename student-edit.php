<?php require "./crud/user.php";
if(!isset( $_GET["id"])){
    echo "Sorry you can't browse this page directly";
    die;
};
$user = new User();
$userData = $user->getUser($_GET["id"]);
if ($userData === null){
    echo "sorry this id doesn't exist in user table";
    die;
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user = new User();
    $result = $user->updateUser($_POST ,$_GET["id"] );
    header('Location: /full_mark_admin/student-detailed.php?id='.$_GET["id"].'');
}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>
    <!-- start Left Panel -->
    <?php
        require "menu_left.php";
    ?>
    <!-- end left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Start Header-->
        <?php
                require "header.php";
            ?>

        <!--End Header-->


        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Detailed student info</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="view-edit-students.php">Students data</a></li>
                            <li><a href='student-detailed.php?id=<?php echo $_GET["id"]?>'>More actions</a></li>
                            <li class=" active">Edit student data</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Detailed info</strong>
                            </div>
                            <div class="card-body">
                                <form method="post" class="row">
                                    <div class="col-md-6 row align-items-center">
                                        <span class="col-6">Student ID</span>
                                        <span class="col-6"><?php echo $userData["u_id"];
                                        ?></span>
                                        <label class="col-6" for="u_fname">First name</label>
                                        <input type="text" name="u_fname" id="u_fname" value="<?php echo $userData["u_fname"];
                                        ?>">
                                        <label class="col-6" for="u_lname">Last name</label>
                                        <input type="text" name="u_lname" id="u_lname" value="<?php echo $userData["u_lname"];
                                        ?>">
                                        <label class="col-6" for="u_email">Email</label>
                                        <input type="email" name="u_email" id="u_email" value="<?php echo $userData["u_email"];
                                        ?>">
                                    </div>
                                    <div class="col-md-6 row align-items-center">
                                        <label class="col-6" for="u_verified">Verrfied</label>
                                        <input type="checkbox" name="u_verified" id="u_verified" value="true">
                                        <span class="col-6">Mobile</span>
                                        <span class="col-6"><?php echo $userData["u_mobile"];
                                        ?></span>
                                        <span class="col-6">Creation date</span>
                                        <span class="col-6"><?php echo $userData["u_creation_date"];
                                        ?></span>
                                        <span class="col-6">Last modification date</span>
                                        <span class="col-6"><?php echo $userData["modification-date"];
                                        ?></span>
                                    </div>
                                    <span class="col-12 text-right">
                                        <input type="submit" value="submit" class="btn btn-primary" />
                                    </span>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>
</body>

</html>