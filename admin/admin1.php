<?php
session_start();
if (isset($_SESSION['iduser']) && isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['phanquyen'])) {
    include('../myclass/clslogin.php');
    $p = new login();
    $p->comfirmlogin($_SESSION['iduser'], $_SESSION['username'], $_SESSION['password'], $_SESSION['phanquyen']);
} else {
    header("location:../login.");
}
?>
<?php
include("../myclass/clsquantri.php");
$p = new quantri();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<?php
$layid = $_REQUEST['id'];
$tencty = $p->laycot("select tencty from congty where idcty = '$layid' limit 1");
$diachi = $p->laycot("select diachi from congty where idcty = '$layid' limit 1");
$idcty = $p->laycot("select idcty from congty where idcty = '$layid' limit 1");
?>

<body>
    <form method="post" enctype="multipart/form-data" name="form1" id="form1">
        <table width="367" border="1" align="center">
            <tbody>
                <tr>
                    <th colspan="2" align="center">QUẢN LÝ CÔNG TY</th>
                </tr>
                <tr>
                    <td>Nhập tên công ty</td>
                    <td><input type="text" name="txtten" id="txtten" value="<?php echo $tencty; ?>">
                        <input type="hidden" name="txtid" id="" value="<?php echo $layid; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Nhập địa chỉ</td>
                    <td><input type="text" name="txtdiachi" id="txtdiachi" value="<?php echo $diachi; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="nut" id="nut" value="Thêm công ty">
                        <input type="submit" name="nut" id="nut" value="Sửa công ty">
                        <input type="submit" name="nut" id="nut" value="Xoá công ty">
                    </td>
                </tr>
            </tbody>
        </table>
        <?php
        switch ($_POST['nut']) {
            case 'Thêm công ty': {

                    $tencty = $_REQUEST['txtten'];
                    $diachi = $_REQUEST['txtdiachi'];

                    if ($p->themsuaxoa("INSERT INTO congty (tencty, diachi)
                        VALUES ('$tencty', '$diachi')") == 1) {
                        echo '<script>alert("Thêm công ty mới thành công")</script>';
                    } else {
                        echo '<script>alert("Thêm công ty mới thất bại")</script>';
                    }

                    echo '<script>window.location="../admin/admin1.php"</script>';
                    break;
                }

            case 'Xoá công ty': {
                    $idxoa = $_REQUEST['txtid'];

                    if ($p->themsuaxoa("delete from congty where idcty = '$idxoa' limit 1") == 1) {
                        echo '<script>alert("Xoá công ty thành công")</script>';
                    }
                }
                echo '<script>window.location="../admin/admin1.php"</script>';
                break;

            case 'Sửa công ty': {
                    $idsua = $_REQUEST['txtid'];
                    $tencty = $_REQUEST['txtten'];
                    $diachi = $_REQUEST['txtdiachi'];

                    if ($p->themsuaxoa("UPDATE congty SET tencty = '$tencty',
                       diachi = '$diachi' WHERE idcty = '$idsua' LIMIT 1 ;") == 1) {
                        echo '<script>alert("Sửa công ty mới thành công")</script>';
                    } else {
                        echo '<script>alert("Sửa công ty mới thất bại")</script>';
                    }

                    echo '<script>window.location="../admin/admin1.php"</script>';
                    break;
                }
        }
        ?>
        <hr>
        <?php
        $p->xemdscongty('select * from congty order by tencty asc');
        ?>
    </form>
</body>