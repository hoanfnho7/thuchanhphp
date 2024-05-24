<?php
include("./myclass/clskhachhang.php");
$p = new khachhang();
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
    <div id="container">
        <div id="header">
            <form action="" method="post">
                <ul>
                    <li><a href="./">Trang chủ</a></li>
                    <li><a href="./admin/admin.php">Quản lí sản phẩm</a></li>
                    <li><a href="./admin/admin1.php">Quản lí công ty</a></li>
                    <li><input type="text" name="txttim" id="">
                        <input type="submit" name="nut" id="" value="Tìm kiếm sản phẩm">
                    </li>
                </ul>
            </form>
        </div>
        <div id="main">
            <div id="left">
                <?php
                $p->xemcongty("select * from congty order by tencty asc");
                ?>
            </div>
            <div id="right">
                <?php
                $idcty = $_REQUEST['id'];
                $txttim = $_REQUEST['txttim'];
                if (isset($_POST['nut'])) {
                    $p->xemdssanpham("select * from sanpham where tensp like '%$txttim%' order by gia asc");
                } else if ($idcty > 0) {
                    $p->xemdssanpham("select * from sanpham where idcty = '$idcty' order by gia asc");
                } else {
                    $p->xemdssanpham("select * from sanpham order by gia asc");
                }
                ?>
            </div>
        </div>
        <div id="footer"></div>
    </div>
</body>

</html>