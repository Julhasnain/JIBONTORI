<?php
include "lib/User.php";
include "inc/header.php";

Session::checkSession();
?>



<?php
if (isset($_GET['id'])) {
    $userid = (int)$_GET['id'];
}

$user = new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $updateusr = $user->updateUserData($userid, $_POST);
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $deleteUser = $user->delete($userid, $_POST);
    //echo $deleteUser;
    // echo $userid;
    //Session::destroy();
    header("Location: userhome.php?page=1");
}

?>

<?php

?>

<div class="panel panel-success">
    <div class="panel-heading">
        <h2>User Profile<span class="pull-right"><a class="btn btn-primary"
                                                    href="javascript:window.history.back()">Back</a></span></h2>
    </div>

    <div class="panel-body">
        <div style="max-width: 600px; margin: 0 auto">

            <?php
            if (isset($updateusr))
                echo $updateusr;
            ?>

            <?php
            $sesname = Session::get("username");
            $admin = $user->adminCheck($sesname);
            //if ($admin) {
            $adminValue = $admin->pro_value;
            // echo $adminValue;
            // }
            $userdata = $user->getUserById($userid);
            {
                ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <?php
                        $sesId = Session::get("id");
                        if ($sesId == $userid || $adminValue == 9) {
                            ?>
                            <input type="text" id="name" name="name" class="form-control"
                                   value="<?php echo $userdata->name; ?>">
                        <?php } else { ?>
                            <input type="text" id="name" name="name" class="form-control"
                                   value="<?php echo $userdata->name; ?>" readonly>
                        <?php } ?>
                    </div>


                    <div class="form-group">
                        <label for="username">Username</label>
                        <?php
                        $sesId = Session::get("id");
                        if ($sesId == $userid || $adminValue == 9) {
                            ?>
                            <input type="text" id="username" name="username" class="form-control"
                                   value="<?php echo $userdata->username; ?>" readonly>
                        <?php } else { ?>
                            <input type="text" id="username" name="username" class="form-control"
                                   value="<?php echo $userdata->username; ?>" readonly>
                        <?php } ?>
                    </div>


                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <?php
                        $sesId = Session::get("id");
                        if ($sesId == $userid || $adminValue == 9) {
                            ?>
                            <input type="text" id="email" name="email" class="form-control"
                                   value="<?php echo $userdata->email; ?>">
                        <?php } else { ?>
                            <input type="text" id="email" name="email" class="form-control"
                                   value="<?php echo $userdata->email; ?>" readonly>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="Blood_Group">Blood Group</label>
                        <?php
                        $sesId = Session::get("id");
                        if ($userdata->blood_group == "X") {
                            //if($userdata->blood_group == 'X')
                            //echo "yoo";
                            ?>
                            <select type="text" class="form-control" name="blood_group">
                                <!--<option value="" selected="selected"><?php echo "X" ?></option>-->
                                <option value="X">Unknown</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                            <!-- value="<?php echo strtoupper($userdata->blood_group); ?>"> -->
                        <?php } else { ?>
                            <input type="text" id="blood_group" name="blood_group" class="form-control"
                                   value="<?php echo strtoupper($userdata->blood_group); ?>" readonly>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="Last Donation1">Last Donation(Date)</label>
                        <?php
                        $sesId = Session::get("id");
                        if ($sesId == $userid || $adminValue == 9) {
                            ?>
                            <input type="text" id="lastDonation1" name="lastDonation1" class="form-control"
                                   value="<?php echo $userdata->last_donated; ?>" placeholder="dd-mm-yyyy">
                        <?php } else { ?>
                            <input type="text" id="lastDonation1" name="lastDonation1" class="form-control"
                                   value="<?php echo $userdata->last_donated; ?>" readonly>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="Last Donation2">Last Donation(Days ago)</label>
                        <?php
                        $date1 = new DateTime("$userdata->last_donated");
                        //echo $date1->format("d-m-Y")."<br>";
                        $date2 = new DateTime();
                        //echo $date2->format("d-m-Y")."<br>";
                        $diff = $date1->diff($date2)->format('%r%a');


                        if ($date1->format("y") > $date2->format("y")) {
                            $msg = "<div class='alert alert-danger'><strong>Error! </strong>Date format not valid</div>";
                            return $msg;
                        }

                        if ($sesId == $userid) {
                            $sesId = Session::get("id");
                            ?>
                            <input type="text" id="lastDonation2" name="lastDonation2" class="form-control"
                                   value="<?php

                                   echo $diff; ?>" readonly>
                        <?php } else { ?>
                            <input type="text" id="lastDonation2" name="lastDonation2" class="form-control"
                                   value="<?php

                                   echo $diff; ?>" readonly>
                        <?php }
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="Age">Age</label>
                        <?php
                        $sesId = Session::get("id");
                        if ($sesId == $userid || $adminValue == 9) {
                            ?>
                            <input type="text" id="age" name="age" class="form-control"
                                   value="<?php echo $userdata->age; ?>">
                        <?php } else { ?>
                            <input type="text" id="age" name="age" class="form-control"
                                   value="<?php echo $userdata->age; ?>" readonly>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="Contact">Contact</label>
                        <?php
                        $sesId = Session::get("id");
                        if ($sesId == $userid || $adminValue == 9) {
                            ?>
                            <input type="text" id="contact" name="contact" class="form-control"
                                   value="<?php echo $userdata->contact; ?>">
                        <?php } else { ?>
                            <input type="text" id="contact" name="contact" class="form-control"
                                   value="<?php echo $userdata->contact; ?>" readonly>
                        <?php } ?>
                    </div>


                    <?php
                    $sesId = Session::get("id");
                    /*$sesname =  Session::get("username");
                    if($sesname == $usrname)
                        echo "pkpk";
                    else
                        echo "ckck";*/

                    if ($sesId == $userid || $adminValue == 9) {
                        ?>
                        <button type="submit" name="update" class="btn btn-info">Update</button>
                        <a class="btn btn-success" href="changepass.php?id=<?php echo $userid; ?>">Change Password</a>
                    <?php } ?>
                    <?php
                    if ($adminValue == 9) { ?>
                        <form action="" method="post">
                            <button type="submit" name="delete" class="btn btn-danger">Delete Account</button>
                        </form>

                        <?php
                    }

                    ?>

                </form>
            <?php } ?>
        </div>
    </div>

</div>

<?php
include "inc/footer.php";
?>


