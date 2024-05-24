<?php
class login
{
    private function connect()
    {
        $conn = mysql_connect("localhost", "lehoangnho", "01255");
        if (!$conn) {
            echo 'Không kết nối được csdl';
            exit;
        } else {
            mysql_select_db('tmdt_db');
            mysql_query('SET NAMES UTF8');
            return $conn;
        }
    }
    public function mylogin($username, $password)
    {
        $password = md5($password);
        $sql = "select iduser, username, password, phanquyen from taikhoan where username = '$username' and password = '$password' limit 1";
        $link = $this->connect();
        $ketqua = mysql_query($sql, $link);
        $i = mysql_num_rows($ketqua);
        if ($i > 0) {
            while ($row = mysql_fetch_array($ketqua)) {
                $iduser = $row['iduser'];
                $username = $row['username'];
                $password = $row['password'];
                $phanquyen = $row['phanquyen'];

                session_start();

                $_SESSION['iduser'] = $iduser;
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['phanquyen'] = $phanquyen;

                header("location:../admin/admin.php");
            }
        } else {
            return 0;
        }
    }

    public function comfirmlogin($iduser, $username, $password, $phanquyen)
    {
        $sql = "select iduser phanquyen from taikhoan where iduser = '$iduser' and username = '$username' and password = '$password' and phanquyen = '$phanquyen' limit 1";
        $link = $this->connect();
        $ketqua = mysql_query($sql, $link);
        $i = mysql_num_rows($ketqua);
        if ($i != 1) {
            while ($row = mysql_fetch_array($ketqua)) {
                header("location:../login/");
            }
        } else {
            return 0;
        }
    }

    public function myLoginKh($user, $pass, $table, $header)
    {
        $pass = md5($pass);
        $sql = "SELECT iduser, username, password, phanquyen from $table where username='$user' and password='$pass' limit 1";
        $link = $this->connect();
        $ketqua = mysql_query($sql, $link);
        $i = mysql_num_rows($ketqua);
        echo $user, '<br>';
        echo $pass, '<br>';
        echo $table, '<br>';
        echo $header, '<br>';
        if ($i == 1) {
            while ($row = mysql_fetch_array($ketqua)) {
                $id = $row['iduser'];
                $myuser = $row['username'];
                $mypass = $row['password'];
                $phanquyen = $row['phanquyen'];
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['user'] = $myuser;
                $_SESSION['pass'] = $mypass;
                $_SESSION['phanquyen'] = $phanquyen;
                header('location:' . $header);
            }
        } else {
            return 0;
        }
    }
}
