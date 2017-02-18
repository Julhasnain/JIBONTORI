<?php
/**
 * Created by PhpStorm.
 * User: Rakib
 * Date: 12-Jan-17
 * Time: 5:52 PM
 */

include_once "Session.php";
include "Database.php";

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function userRegistration($data)
    {
        $name = $data['name'];
        $username = $data["username"];
        $email = $data['email'];
        $password = ($data['password']);
        $blood_group = ($data['blood_group']);
        $donated = $data['date'];
        //$date1 = new DateTime("$donated");
        //echo $date1->format("d-m-Y");
        //echo $donated;
        //$date2 = new DateTime();
        //$diff = $date1->diff($date2)->days;

        /*else
           $password = md5($password);*/
        $chk_email = $this->emailCheck($email);

        $chk_username = $this->usernameCheck($username);

        if ($name == "" || $username == "" || $email == "" || $password == "" || $blood_group == "" || $donated == "") {
            $msg = "<div class='alert alert-danger'><strong>Error! </strong>Field must not be empty</div>";
            return $msg;
        }
        if (strlen($username) < 3) {
            $msg = "<div class='alert alert-danger'><strong>Error! </strong>Username too short</div>";
            return $msg;
        } elseif (preg_match('/[^a-z0-9_-]+/i', $username)) {
            $msg = "<div class='alert alert-danger'><strong>Error! </strong>Username must only contain alphanumeric,dashes,underscore</div>";
            return $msg;
        }
        if (strlen($password) < 4) {
            $msg = "<div class='alert alert-danger'><strong>Error! </strong>Password too short</div>";
            return $msg;
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $msg = "<div class='alert alert-danger'><strong>Error! </strong>Email address is not valid</div>";
            return $msg;
        }
        if ($chk_email == true) {
            $msg = "<div class='alert alert-danger'><strong>Error! </strong>Email Address already exists</div>";
            return $msg;
        }
        if ($chk_username == true) {
            $msg = "<div class='alert alert-danger'><strong>Error! </strong>Username already exists</div>";
            return $msg;
        }

        $password = md5($password);


        $sql = "INSERT INTO tbl_user(name,username,email,password,blood_group,last_donated) VALUES(:name,:username,:email,:password,:blood_group,:last_donated)";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':name', $name);
        $query->bindValue(':username', $username);
        $query->bindValue(':email', $email);
        $query->bindValue(':password', $password);
        $query->bindValue(':blood_group', strtoupper($blood_group));
        $query->bindValue(':last_donated', $donated);
        //$query->bindValue(':days', $diff);
        $result = $query->execute();

        if ($result) {
            //todo last inserted user id
            $sql1 = "INSERT INTO user_info(userid,pro_name,pro_value) VALUES(:userid,user_level,0)";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':name', $name);
            $query->bindValue(':username', $username);
            $query->bindValue(':email', $email);
            $query->bindValue(':password', $password);
            $query->bindValue(':blood_group', strtoupper($blood_group));
           $msg = "<div class='alert alert-success'><strong>Congratulations! </strong>You have been registered successfully.Now Login :)</div>";
            return $msg;
        } else {
            $msg = "<div class='alert alert-danger'><strong>Sorry! </strong>There is a problem</div>";
            return $msg;
        }
    }

    public function usernameCheck($username)
    {
        $sql = "SELECT username from tbl_user WHERE username = :username";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':username', $username);
        $query->execute();
        if ($query->rowCount() > 0) {
            return true;
        } else
            return false;
    }

    public function emailCheck($email)
    {
        $sql = "SELECT email from tbl_user WHERE email = :email";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':email', $email);
        $query->execute();
        if ($query->rowCount() > 0) {
            return true;
        } else
            return false;
    }

    public function getLoginUser($email, $password)
    {
        $sql = "SELECT * from tbl_user WHERE email = :email AND password = :password LIMIT 1";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':email', $email);
        $query->bindValue(':password', $password);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function userLogin($data)
    {
        $email = $data['email'];
        $password = md5($data['password']);
        $chk_email = $this->emailCheck($email);


        if ($email == "" OR $password == "") {
            $msg = "<div class='text-danger 'style=\"white-space:pre\"><h4>Invalid Login!!                                            </h4></div>";
            return $msg;
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $msg = "<div class='alert alert-danger'><strong>Error! </strong>Email address is not valid</div>";
            return $msg;
        }

        if ($chk_email == false) {
            $msg = "<div class='text-danger'style=\"white-space:pre\"><h4>Invalid Email!!                                            </h4></div>";
            return $msg;
        }

        $result = $this->getLoginUser($email, $password);
        if ($result) {
            Session::init();
            Session::set("login", true);
            Session::set("register",true);
            Session::set("id", $result->id);
            Session::set("name", $result->name);
            Session::set("username", $result->username);
            Session::set("loginmsg", "<div class='alert alert-success'><strong>Success! </strong>You are logged in</div>");
            header("Location: userhome.php");
        } else {
            $msg = "<div class='text-danger'style=\"white-space:pre\"><h4>Invalid Password!!                                            </h4></div>";
            return $msg;
        }
    }

    public function getUserData()
    {
        $sql = "SELECT * from tbl_user  ORDER BY name ASC ";
        $query = $this->db->pdo->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    public function getUserLevel($user_id)
    {
        $sql = "SELECT * from user_info WHERE userid=$user_id AND pro_name='user_level' ";
        $query = $this->db->pdo->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result[0]['pro_value'];
    }


    public function getUserById($id)
    {
        $sql = "SELECT * from tbl_user WHERE id = :id LIMIT 1";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }


    function updateUserData($id, $data)
    {
        $name = $data['name'];
        $username = $data["username"];
        $email = $data['email'];
        $blood = $data['blood_group'];
        $lastDonate = $data['lastDonation1'];
        //$date1 = new DateTime("$lastDonate");
        //echo $date1->format("d-m-Y");
        //echo $donated;
        //$date2 = new DateTime();
        //$diff = $date1->diff($date2)->days;
        // echo $diff;

        // $chk_username = $this->usernameCheck($username);

        if ($name == "" || $username == "" || $email == "" || $blood == "") {
            $msg = "<div class='alert alert-danger'><strong>Error! </strong>Field must not be empty</div>";
            return $msg;
        }
        if (strlen($username) < 3) {
            $msg = "<div class='alert alert-danger'><strong>Error! </strong>Username too short</div>";
            return $msg;
        } elseif (preg_match('/[^a-z0-9_-]+/i', $username)) {
            $msg = "<div class='alert alert-danger'><strong>Error! </strong>Username must only contain alphanumeric,dashes,underscore</div>";
            return $msg;
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $msg = "<div class='alert alert-danger'><strong>Error! </strong>Email address is not valid</div>";
            return $msg;
        }

        /* if ($chk_username == true) {
             $msg = "<div class='alert alert-danger'><strong>Error! </strong>Username already exists</div>";
             return $msg;
         }*/

        $sql = "UPDATE tbl_user set
                name = :name,
                username = :username,
                email = :email,
                blood_group = :blood_group,
                last_donated = :last_donated

                WHERE id = :id";

        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':name', $name);
        $query->bindValue(':username', $username);
        $query->bindValue(':email', $email);
        $query->bindValue(':id', $id);
        $query->bindValue(':blood_group', $blood);
        $query->bindValue(':last_donated', $lastDonate);
        //$query->bindValue(':days', $diff);
        $result = $query->execute();
        if ($result) {
            $msg = "<div class='alert alert-success'><strong>Congratulations! </strong>You have updated your data successfully</div>";
            return $msg;
        } else {
            $msg = "<div class='alert alert-danger'><strong>Sorry! </strong>User data not updated</div>";
            return $msg;
        }
    }


    private function checkPassword($old_pass, $id)
    {
        $password = md5($old_pass);
        $sql = "SELECT password from tbl_user WHERE id = :id AND password = :password";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':id', $id);
        $query->bindValue(':password', $password);
        $query->execute();
        if ($query->rowCount() > 0) {
            return true;
        } else
            return false;
    }

    public function updatePassword($id, $data)
    {
        $old_pass = $data['old_pass'];
        $new_pass = $data['password'];
        if ($old_pass == "" || $new_pass == "") {
            $msg = "<div class='alert alert-danger'><strong>Error! </strong>Field must not be empty</div>";
            return $msg;
        }

        $chk_pass = $this->checkPassword($old_pass, $id);

        if ($chk_pass == false) {
            $msg = "<div class='alert alert-danger'><strong>Error! </strong>Old Password does not exist</div>";
            return $msg;
        }

        if (strlen($new_pass) < 4) {
            $msg = "<div class='alert alert-danger'><strong>Error! </strong>Password is too short</div>";
            return $msg;
        }

        $password = md5($new_pass);
        $sql = "UPDATE tbl_user set
                password = :password
                WHERE id = :id ";

        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':password', $password);
        $query->bindValue(':id', $id);
        $result = $query->execute();
        if ($result) {
            $msg = "<div class='alert alert-success'><strong>Congratulations! </strong>Password updated successfully</div>";
            return $msg;
        } else {
            $msg = "<div class='alert alert-danger'><strong>Sorry! </strong>Password not updated</div>";
            return $msg;
        }

    }

    public function userSearch($data)
    {
        $sql = "SELECT * from tbl_user  WHERE blood_group like '$data' ";
        $query = $this->db->pdo->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    public function delete($id, $data)
    {
        $username = $data['username'];
        $sql = "DELETE from tbl_user WHERE id = :id and username = :username";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':username', $username);
        $query->bindValue(':id', $id);
        $result = $query->execute();
        return $result;
    }


}

?>
