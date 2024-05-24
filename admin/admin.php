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
$tensp = $p->laycot("select tensp from sanpham where idsp = '$layid' limit 1");
$gia = $p->laycot("select gia from sanpham where idsp = '$layid' limit 1");
$giamgia = $p->laycot("select giamgia from sanpham where idsp = '$layid' limit 1");
$mota = $p->laycot("select mota from sanpham where idsp = '$layid' limit 1");
$idcty = $p->laycot("select idcty from sanpham where idsp = '$layid' limit 1");
?>

<body>
    <form method="post" enctype="multipart/form-data" name="form1" id="form1">
        <table width="367" border="1" align="center">
            <tbody>
                <tr>
                    <th colspan="2" align="center">QUẢN LÝ SẢN PHẨM</th>
                </tr>
                <tr>
                    <td width="127">Chọn nhà cung cấp</td>
                    <td width="224">
                        <?php
                        $p->choncongty("select * from congty order by tencty asc", $idcty);
                        ?>
                        <input type="hidden" name="txtid" id="" value="<?php echo $layid; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Nhập tên sản phẩm</td>
                    <td><input type="text" name="txtten" id="txtten" value="<?php echo $tensp; ?>"></td>
                </tr>
                <tr>
                    <td>Nhập giá sản phẩm</td>
                    <td><input type="text" name="txtgia" id="txtgia" value="<?php echo $gia; ?>"></td>
                </tr>
                <tr>
                    <td>Nhập mô tả</td>
                    <td><textarea name="txtmota" id="txtmota"><?php echo $mota; ?></textarea></td>
                </tr>
                <tr>
                    <td>Nhập giảm giá</td>
                    <td><input type="text" name="txtgiamgia" id="txtgiamgia" value="<?php echo $giamgia; ?>"></td>
                </tr>
                <tr>
                    <td>Chọn ảnh đại diện</td>
                    <td><input type="file" name="myfile" id="myfile"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="nut" id="nut" value="Thêm sản phẩm">
                        <input type="submit" name="nut" id="nut" value="Sửa sản phẩm">
                        <input type="submit" name="nut" id="nut" value="Xoá sản phẩm">
                    </td>
                </tr>
            </tbody>
        </table>
        <?php
        switch ($_POST['nut']) {
            case 'Thêm sản phẩm': {
                    $name = $_FILES['myfile']['name'];
                    $tmp_name = $_FILES['myfile']['tmp_name'];
                    $name = time() . "_" . $name;

                    $idcty = $_REQUEST['congty'];
                    $tensp = $_REQUEST['txtten'];
                    $gia = $_REQUEST['txtgia'];
                    $mota = $_REQUEST['txtmota'];
                    $giamgia = $_REQUEST['txtgiamgia'];

                    if ($tmp_name != '') {
                        if ($p->uploadfile($name, $tmp_name, "../hinh/")) {
                            if ($p->themsuaxoa("INSERT INTO sanpham (tensp, gia, mota, hinh, giamgia, idcty)
                        VALUES ('$tensp', '$gia', '$mota', '$name', '$giamgia', '$idcty')") == 1) {
                                echo '<script>alert("Thêm sản phẩm thành công")</script>';
                            }
                        } else {
                            echo '<script>alert("Upload hình không thành công")</script>';
                        }
                    } else {
                        echo '<script>alert("Vui lòng chọn ảnh đại diện")</script>';
                    }
                    echo '<script>window.location="../admin/admin.php"</script>';
                    break;
                }

            case 'Xoá sản phẩm': {
                    $idxoa = $_REQUEST['txtid'];
                    $hinh = $p->laycot("select hinh from sanpham where idsp = '$idxoa' limit 1");
                    if ($idxoa > 0) {
                        if (unlink("../hinh/" . $hinh)) {
                            if ($p->themsuaxoa("delete from sanpham where idsp = '$idxoa' limit 1") == 1) {
                                echo '<script>alert("Xoá sản phẩm thành công")</script>';
                            }
                        }
                    } else {
                        echo '<script>alert("Vui lòng chọn sản phẩm cần xoá")</script>';
                    }
                    echo '<script>window.location="../admin/admin.php"</script>';
                    break;
                }

                // case 'Sửa sản phẩm': {

                //         $hinh = $p->laycot("select hinh from sanpham where idsp = '$idsua' limit 1");

                //         $name = $_FILES['myfile']['name'];
                //         $tmp_name = $_FILES['myfile']['tmp_name'];
                //         $name = time() . "_" . $name;

                //         $idsua = $_REQUEST['txtid'];
                //         $idcty = $_REQUEST['congty'];
                //         $tensp = $_REQUEST['txtten'];
                //         $gia = $_REQUEST['txtgia'];
                //         $mota = $_REQUEST['txtmota'];
                //         $giamgia = $_REQUEST['txtgiamgia'];

                //         if (unlink("../hinh/" . $hinh)) {
                //             if ($idsua > 0) {
                //                 if ($p->themsuaxoa("UPDATE sanpham SET tensp = '$tensp',
                //             gia = '$gia',
                //             mota = '$mota',
                //             giamgia = '$giamgia',
                //             idcty = '$idcty',
                //             hinh = '$name' WHERE idsp = '$idsua' LIMIT 1 ;
                //             ") == 1) {
                //                     echo '<script>alert("Sửa sản phẩm thành công")</script>';
                //                 }
                //             } else {
                //                 echo '<script>alert("Vui lòng chọn sản phẩm cần sửa")</script>';
                //             }
                //         }
                //         echo '<script>window.location="../admin/admin.php"</script>';
                //         break;
                //     }

                // case 'Sửa sản phẩm': {

                //     $idsua = $_REQUEST['txtid'];
                //     $idcty = $_REQUEST['congty'];
                //     $tensp = $_REQUEST['txtten'];
                //     $gia = $_REQUEST['txtgia'];
                //     $mota = $_REQUEST['txtmota'];
                //     $giamgia = $_REQUEST['txtgiamgia'];

                //     // Fetch the current image from the database
                //     $hinh = $p->laycot("SELECT hinh FROM sanpham WHERE idsp = '$idsua' LIMIT 1");

                //     // Check if a new file has been uploaded
                //     if (isset($_FILES['myfile']) && $_FILES['myfile']['error'] == 0) {
                //         $name = $_FILES['myfile']['name'];
                //         $tmp_name = $_FILES['myfile']['tmp_name'];
                //         $name = time() . "_" . $name;

                //         // Delete the old image file if it exists
                //         if ($hinh && file_exists("../hinh/" . $hinh)) {
                //             unlink("../hinh/" . $hinh);
                //         }

                //         // Move the new uploaded file to the desired directory
                //         if (move_uploaded_file($tmp_name, "../hinh/" . $name)) {
                //             // Update the database with the new image
                //             $query = "UPDATE sanpham SET 
                //                 tensp = '$tensp',
                //                 gia = '$gia',
                //                 mota = '$mota',
                //                 giamgia = '$giamgia',
                //                 idcty = '$idcty',
                //                 hinh = '$name' 
                //                 WHERE idsp = '$idsua' 
                //                 LIMIT 1";
                //         } else {
                //             echo '<script>alert("Upload hình không thành công")</script>';
                //             break;
                //         }
                //     } else {
                //         // No new image uploaded, keep the old image
                //         $query = "UPDATE sanpham SET 
                //             tensp = '$tensp',
                //             gia = '$gia',
                //             mota = '$mota',
                //             giamgia = '$giamgia',
                //             idcty = '$idcty'
                //             WHERE idsp = '$idsua' 
                //             LIMIT 1";
                //     }

                //     // Execute the query
                //     if ($p->themsuaxoa($query) == 1) {
                //         echo '<script>alert("Sửa sản phẩm thành công")</script>';
                //     } else {
                //         echo '<script>alert("Có lỗi xảy ra khi sửa sản phẩm")</script>';
                //     }

                //     echo '<script>window.location="../admin/admin.php"</script>';
                //     break;
                // }

            case 'Sửa sản phẩm': {
                    $idsua = $_REQUEST['txtid'];
                    $idcty = $_REQUEST['congty'];
                    $tensp = $_REQUEST['txtten'];
                    $gia = $_REQUEST['txtgia'];
                    $mota = $_REQUEST['txtmota'];
                    $giamgia = $_REQUEST['txtgiamgia'];

                    $name = $_FILES['myfile']['name'];
                    $tmp_name = $_FILES['myfile']['tmp_name'];
                    $name = time() . "_" . $name;
                    // Fetch the current image from the database
                    $hinh = $p->laycot("SELECT hinh FROM sanpham WHERE idsp = '$idsua' LIMIT 1");

                    // Check if a new file has been uploaded
                    if ($tmp_name != '') {
                        // Delete the old image file
                        if ($hinh && file_exists("../hinh/" . $hinh)) {
                            unlink("../hinh/" . $hinh);
                        }

                        // Move the new uploaded file to the desired directory
                        if ($p->uploadfile($name, $tmp_name, "../hinh/") == 1) {
                            if ($p->themsuaxoa("UPDATE sanpham SET 
                    tensp = '$tensp',
                    gia = '$gia',
                    mota = '$mota',
                    giamgia = '$giamgia',
                    idcty = '$idcty',
                    hinh = '$name'
                  WHERE idsp = '$idsua' LIMIT 1") == 1) {
                                echo '<script>alert("Sửa sản phẩm thành công")</script>';
                            } else {
                                echo '<script>alert("Có lỗi xảy ra khi sửa sản phẩm")</script>';
                            }
                        } else {
                            echo '<script>alert("Upload hình sản phẩm thất bại")</script>';
                        }


                        // Update the query to include the new image
                    } else {
                        $p->themsuaxoa("UPDATE sanpham SET 
                    tensp = '$tensp',
                    gia = '$gia',
                    mota = '$mota',
                    giamgia = '$giamgia',
                    idcty = '$idcty'
                  WHERE idsp = '$idsua' LIMIT 1");
                    }

                    echo '<script>window.location="../admin/admin.php"</script>';
                    break;
                }
        }
        ?>
        <hr>
        <?php
        $p->xemdssanpham('select * from sanpham order by gia asc');
        ?>
    </form>
</body>