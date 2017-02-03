<?php
include "lib/User.php";
include "inc/header.php";

Session::checkSession();
$user = new User();
?>

<?php
$user = new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
$searchBlood = $_POST['search'];
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h2><?php echo strtoupper($searchBlood); ?> Doner List<span class="pull-right">Welcome! <strong>
                    <?php
                    $name = Session::get("name");
                    if (isset($name)) {
                        echo $name;
                    }
                    ?>

                </strong></span></h2>
    </div>


    <div class="panel-body">
        <?php
        $msg = "<div class='alert alert-success'><strong>Available Doner List</strong></div>";
        echo $msg;
        $msg = "<div class='alert alert-danger'><strong>Non available Doner List</strong></div>";
        echo $msg;
        ?>

        <table class="table table-bordered">

            <tr>
                <th width="20%">Serial</th>
                <th width="20%">Name</th>
                <th width="20%">Last Donation(Days ago)</th>
                <th width="20%">Email</th>
                <th width="20%">Action</th>
            </tr>

            <?php
            $usrSearch = $user->userSearch($searchBlood);
            if ($usrSearch) {
                $i = 1;
                foreach ($usrSearch as $sdata) {
                    $date1 = new DateTime("$sdata[last_donated]");
                    $date2 = new DateTime();
                    $diff = $date1->diff($date2)->days;
                    if ($diff > 119) {
                        ?>
                        <tr class="alert alert-success">
                        <td><?php echo $i++; ?> </td>
                        <td><?php echo $sdata['name']; ?></td>
                        <td><?php echo $diff; ?></td>
                        <td><?php echo $sdata['email']; ?></td>
                        <td><a class="btn btn-info"
                               href="profile.php?id=<?php echo $sdata['id']; ?>">View</a>
                        </td>
                    <?php } else { ?>
                        </tr>
                        <tr class="alert alert-danger">
                        <td><?php echo $i++; ?> </td>
                        <td><?php echo $sdata['name']; ?></td>
                        <td><?php echo $diff; ?></td>
                        <td><?php echo $sdata['email']; ?></td>
                        <td><a class="btn btn-info"
                               href="profile.php?id=<?php echo $sdata['id']; ?>">View</a>
                        </td>
                    <?php } ?>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5">
                        <div class="alert alert-warning"><h2>No User Data Found!</h2></div>
                    </td>
                </tr>
                <?php
            }
            }
            ?>
        </table>
    </div>

</div>


<?php
include "inc/footer.php";
?>
