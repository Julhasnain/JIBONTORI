<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/../lib/Session.php';
Session::init();
date_default_timezone_set('Asia/Dhaka');

?>


<!DOCTYPE html>
<html>
<head class="no-js" lang="">
		<meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>জীবনতরী</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">-->
		
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/normalize.css">
		<link rel="stylesheet" href="assets/css/main.css">
	
		<script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
		<script src="inc/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
</head>
<body>
	 <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		
		

<?php
if (isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy();
}
?>


<div class="container">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">জীবনতরী</a>
            </div>
            <ul class="nav navbar-nav navbar-right">

                <?php
                $id = Session::get("id");
                $userlogin = Session::get("login");
                if ($userlogin == true) {
                    ?>

                    <form class="navbar-form navbar-left" action="search.php" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search Blood" name="search" required>
                            <div class="input-group-btn">
                                <button class="btn btn-info" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <li><a href="userhome.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                    <li><a href="profile.php?id=<?php echo $id; ?>"><span class="glyphicon glyphicon-user"></span>
                            Profile</a></li>


                    <li><a href="?action=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    <?php
                } else {
                    ?>
                    <li><a href="index.php?id=<<?php echo $id; ?>>"><span class="glyphicon glyphicon-log-in"></span><!-- change login.php to index.php-->
                            Login</a></li>
                    <li><a href="register.php"><span class="glyphicon glyphicon-list-alt"></span> Register</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </nav>