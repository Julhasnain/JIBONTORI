<?php
include "inc/header.php";
include "lib/User.php";
Session::checkRegister();
?>

<?php
$user = new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $usrRegi = $user->userRegistration($_POST);
}
?>

<div class="panel panel-info">
    <div class="panel-heading">
        <h2>User Registration</h2>
    </div>
    <div class="panel-body">
        <div style="max-width: 600px; margin: 0 auto">

            <?php
            if (isset($usrRegi))
                echo $usrRegi;
            ?>

            <form action="" method="POST">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="name" type="text" class="form-control" name="name" placeholder="Name">
                </div>

                <br>

                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="username" type="text" class="form-control" name="username"
                           placeholder="Username(Can contain alphanumeric,dash,underscore.Can not be changed later)">
                </div>

                <br>

                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email">
                </div>

                <br>

                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="password" type="password" class="form-control" name="password"
                           placeholder="Password(must be greater than 3 characters)">
                </div>

                <br>

                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-tint"></i></span>
                    <!--<input id="blood" type="text" class="form-control" name="blood_group" placeholder="Blood Group">-->
					<select id="blood" type="text" class="form-control" name="blood_group" placeholder="Blood Group">
						<option value="" selected="selected">Select Blood Group</option>
						<option value="A+">A+</option>
						<option value="A-">A-</option>
						<option value="B+">B+</option>
						<option value="B-">B-</option>
						<option value="AB+">AB+</option>
						<option value="AB-">AB-</option>
						<option value="O+">O+</option>
						<option value="O-">O-</option>
					</select>
                </div>

                <br>

                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    <input id="date" type="text" class="form-control" name="date"
                           placeholder="Last Donated(dd-mm-yyyy) If never donated, type birth date">
                </div>

                <br>

                <button type="submit" name="register" class="btn btn-success">Register</button>
            </form>
        </div>
    </div>

</div>

<?php
include "inc/footer.php";
?>


