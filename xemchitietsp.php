<?php
error_reporting(1);
include_once('./myclass/clskhachhang.php');
$p = new khachhang();
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="footer">
            <div class="home">

                <a href="./" class="home-link">
                    <i class=" icon-link fa-solid fa-house-laptop"></i>
                </a>
            </div>
        </div>
        <div class="main">
            <form id="form1" name="form1" method="post">
                <?php
                $idsp = $_REQUEST['id'];
                $layid = $_REQUEST['id'];
                $p->xemchitietsp("SELECT * from sanpham where idsp ='$idsp' limit 1");

                ?>
                <input type="hidden" name="txtid" id="txtid" value="<?php echo $layid; ?>">
                <div align="center">
                    <?php
                    if ($_POST['nut'] == "Thêm vào giỏ hàng") {

                        if (isset($_SESSION['id'])) {
                            $idkh = $_SESSION['id'];
                            $ngay = date('Y-m-d');
                            $idsp = $_REQUEST['id'];
                            $gia = $p->laycot("SELECT gia from sanpham where idsp ='$idsp' limit 1");
                            $giamgia = $p->laycot("SELECT giamgia from sanpham where idsp ='$idsp' limit 1");
                            $soluong = $_REQUEST['txtsoluong'];
                            if ($idkh > 0 && $idsp > 0) {
                                if ($p->themsuaxoa("INSERT INTO dathang (idkh, id_nhanvien, ngaydathang, trangthai) values ('$idkh','0','$ngay','0')") == 1) {

                                    $iddh = $p->laycot("SELECT iddh from dathang where idkh='$idkh' order by iddh desc limit 1");

                                    if ($iddh > 0) {
                                        if ($p->themsuaxoa("INSERT INTO dathang_chitiet( iddh, idsp, soluong, dongia , giamgia) 
										VALUES ('$iddh','$idsp','$soluong','$gia','$giamgia')") == 1) {
                                            echo 'Đặt hàng thành công';
                                        } else {
                                            echo 'Đặt hàng không thành công';
                                        }
                                    }
                                }
                                else{
                                    echo ' <script language="javascript">
                                    alert("Thêm sản phẩm không thành công");
                                    </script>';
                                    
                                }
                            }
                        } else {
                            echo ' <script language="javascript">
            				alert("Vui lòng đăng nhập trước khi đặt hàng");
            				</script>';

                            echo '<script language="javascript">
         					 window.location="./khachhang";
        					 </script>';
                        }
                    }


                    ?>
                </div>
                <div align="center">

                    <?php
                    if (isset($_SESSION['id'])) {
                        $idkh = $_SESSION['id'];
                        $p->giohang("SELECT ct.iddh, ct.idsp,ct.soluong,ct.dongia,ct.giamgia from dathang dh, dathang_chitiet ct where dh.iddh=ct.iddh and idkh='$idkh'");
                    }
                    ?>

                    <?php
                    if (isset($_SESSION['id'])) {
                        $idkh = $_SESSION['id'];
                        $iddh = $_REQUEST['txtiddh'];

                        if ($_POST['nut'] == "Xóa") {
                            if ($p->themsuaxoa("delete from dathang_chitiet where iddh='$iddh'") == 1) {
                                if ($p->themsuaxoa("delete from dathang where iddh='$iddh'") == 1) {
                                    echo ' <script language="javascript">
									alert("Xóa thành công đơn hàng");
									</script>';
                                } else {
                                    echo '<script>alert("Xóa đơn hàng thất bại")</script>';
                                }

                                echo '<script language="javascript">
								window.location="?id=' . $idsp . '";
								</script>';
                            }
                        }

                        if ($_POST['nut'] == "Sửa") {
                            $soluong = $_REQUEST['txtsl'];
                            if ($iddh > 0) {
                                if ($p->themsuaxoa("UPDATE dathang_chitiet SET soluong='$soluong' WHERE iddh='$iddh'") == 1) {
                                    echo '<script>window.location="?id=' . $idsp . '"</script>';
                                }
                            }
                        }
                    }
                    ?>

                </div>
            </form>
        </div>
    </div>
</body>

</html>


<style>
    /* chi tiết sản phẩm*/
    .home {
        display: flex;
        justify-content: center;
        margin-left: 66%;

    }

    .icon-link {
        font-size: 1.4rem;
        color: #183052;
    }
</style>