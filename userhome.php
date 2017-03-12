<?php
include "lib/User.php";
include "inc/header.php";

Session::checkSession();
$user = new User();
?>

<?php
/*if (isset($_GET['username'])){
    $usrname = $_GET['username'];
    echo $deleteUser;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
        $deleteUser = $user->delete($usrname, $_POST);

    }
}
*/
?>

<?php
/*$perPage = 3;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$startFrom = ($page-1)*$perPage;*/
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = isset($_GET['per-page']) && $_GET['per-page'] <= 50 ? (int)$_GET['per-page'] : 10;
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
?>

<?php
$loginmsg = Session::get("loginmsg");
if (isset($loginmsg)) {
    echo $loginmsg;
}
Session::set("loginmsg", null);
?>


<div class="panel panel-primary">
    <div class="panel-heading">
        <h2>User List<!--<span class="pull-right">Welcome! <strong>
                    <?php
            /* $name = Session::get("name");
             if (isset($name)) {
                 echo $name;
             }
             */ ?>
                </strong></span></h2>-->
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <tr>
                <th width="20%">Serial</th>
                <th width="20%">Name</th>
                <th width="20%">Email</th>
                <th width="20%">Blood Group</th>
                <th width="20%">Action</th>
            </tr>
            <?php
            $user = new User();
            $userdata = $user->getUserData();
            /* $sesname = Session::get("username");
             $admin = $user->adminCheck($sesname);
             if ($admin) {
                 $adminValue = $admin->pro_value;
                 echo $adminValue;
             }*/

            $total = $user->totalRows();
            // echo $total;
            $pages = ceil($total / $perPage);
            // echo $pages;

            $y = $_GET['page'];
            $z = $y * $perPage - $perPage + 1;
            $userdata = $user->getUserDataForPage($start, $perPage);
            if ($userdata) {
                foreach ($userdata as $sdata) {
                    ?>
                    <tr class="default">
                        <td><?php echo $z++; ?></td>
                        <td><?php echo $sdata['name']; ?></td>
                        <td><?php echo $sdata['email']; ?></td>
                        <td><?php
                            if ($sdata['blood_group'] == 'X')
                                echo "Unknown";
                            else
                                echo $sdata['blood_group']; ?></td>
                        <td><a class="btn btn-info" href="profile.php?id=<?php echo $sdata['id']; ?>">View</a></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5"><h2>No User Data Found!</h2></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <ul class="pagination pull-right">
            <?php

            for ($x = 1; $x <= $pages; $x++) {
                ?>
                <li class=""><a href="?page=<?php echo $x; ?>"><?php echo $x; ?></a></li>
            <?php } ?>
        </ul>
    </div>

</div>

<?php
include "inc/footer.php";
?>


