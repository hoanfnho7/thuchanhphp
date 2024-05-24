<?php
include("../myclass/clslogin.php");
$p = new login();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <form id="form1" name="form1" method="post">
        <table width="200" border="1" align="center">
            <tbody>
                <tr>
                    <th colspan="2" align="center">Đăng nhập</th>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="txtuser" id="txtuser"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="text" name="txtpass" id="txtpass"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" name="nut" id="nut" value="Đăng nhập">
                        <input type="submit" name="submit2" id="submit2" value="Huỷ bỏ">
                    </td>
                </tr>
            </tbody>
        </table>
        <?php
        switch ($_POST['nut']) {
            case 'Đăng nhập': {
                    $username = $_REQUEST['txtuser'];
                    $password = $_REQUEST['txtpass'];

                    if ($username != '' && $password != '') {
                        if ($p->mylogin($username, $password) == 0) {
                            echo '<script>alert("Sai tài khoản hoặc mật khẩu")</script>';
                        }
                    } else {
                        echo '<script>alert("Vui lòng nhập đầy đủ thông tin")</script>';
                    }
                    break;
                }
        }
        ?>
        </form>
</body>