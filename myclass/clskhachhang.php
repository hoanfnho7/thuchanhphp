<?php
include("clstmdt.php");
class khachhang extends tmdt
{
    public function xemdssanpham($sql)
    {
        $link = $this->connect();
        $ketqua = mysql_query($sql, $link);
        $i = mysql_num_rows($ketqua);
        if ($i > 0) {
            while ($row = mysql_fetch_array($ketqua)) {
                $idsp = $row['idsp'];
                $tensp = $row['tensp'];
                $gia = $row['gia'];
                $hinh = $row['hinh'];

                echo '<div id="sanpham">
                <div id="ten_sanpham"><a href="xemchitietsp.php?id=' . $idsp . '">' . $tensp . '</a></div>
                <div id="hinh_sanpham"><a href="xemchitietsp.php?id=' . $idsp . '"><img src="./hinh/' . $hinh . '" alt="" width="160"></a></div>
                <div id="gia_sanpham"><a href="xemchitietsp.php?id=' . $idsp . '">' . $gia . '</a></div>
            </div>';
            }
        } else {
            echo 'Không có dữ liệu';
        }
    }
    public function xemcongty($sql)
    {
        $link = $this->connect();
        $ketqua = mysql_query($sql, $link);
        $i = mysql_num_rows($ketqua);
        if ($i > 0) {
            while ($row = mysql_fetch_array($ketqua)) {
                $idcty = $row['idcty'];
                $tencty = $row['tencty'];


                echo '<a href="?id=' . $idcty . '">' . $tencty . '</a>';
                echo '<br>';
            }
        } else {
            echo 'Không có dữ liệu';
        }
    }

    public function xemchitietsp($sql)
    {
        $link = $this->connect();
        $ketqua = mysql_query($sql, $link);
        $i = mysql_num_rows($ketqua);
        if ($i > 0) {
            echo '<form id="form1" name="form1" method="post">
            <table width="668" border="1" align="center" cellpadding="10" cellspacing="0">
              <tbody>';
            while ($row = mysql_fetch_array($ketqua)) {

                $idsp = $row['idsp'];
                $tensp = $row['tensp'];
                $gia = $row['gia'];
                $giamgia = $row['giamgia'];
                $hinh = $row['hinh'];
                $mota = $row['mota'];
                $idcty = $row['idcty'];
                $tencty = $this->laycot("select tencty from congty where idcty = '$idcty' limit 1");

                echo '<tr>
                <td width="225" rowspan="8"><img src="./hinh/' . $hinh . '" alt="" width="220"></a></td>
                <td width="123">Tên sản phẩm</td>
                <td width="298">'.$tensp.'</td>
              </tr>
              <tr>
                <td>Công ty</td>
                <td>' . $tencty . '</td>
              </tr>
              <tr>
                <td>Mô tả</td>
                <td>' . $mota . '</td>
              </tr>
              <tr>
                <td>Giá</td>
                <td>' . $gia . '</td>
              </tr>
              <tr>
                <td>Giảm giá</td>
                <td>' . $giamgia . '</td>
              </tr>
              <tr>
                <td>Giá mua</td>
                <td>' . ($gia - $giamgia) . '</td>
              </tr>
              <tr>
                <td>Số lượng</td>
                <td><input type="text" name="txtsoluong" id="txtsoluong" value="1"></td>
              </tr>
              <tr>
                <td>Đặt hàng</td>
                <td align="center"><input type="submit" name="nut" id="nut" value="Thêm vào giỏ hàng"></td>
              </tr>';
            }
            echo '</tbody>
            </table>';
        } else {
            echo 'Không có dữ liệu';
        }
    }

    public function giohang($sql)
        {
            $link = $this->connect();
        $ketqua = mysql_query($sql, $link);
        $i = mysql_num_rows($ketqua);

            if ($i > 0) {
                echo '<form id ="form1" name = "form1" method ="post">
                <table width="600" border="1" align="center" cellpadding="5">
                        <tbody>
                        <tr>
                        <td> STT </td>
                        <td> Tên sản phẩm </td>
                        <td> Số lượng </td>
                        <td> Giá </td>
                        <td> Giảm giá </td>
                        <td> Giá thành </td>
                        <td> Chức năng </td>
                        </tr>';

                $dem = 1;
                while ($row = mysql_fetch_array($ketqua)) {
                    $iddh = $row['0'];
                    $idsp = $row['1'];
                    $soluong = $row['2'];
                    $gia = $row['3'];
                    $giamgia = $row['4'];
                    $giathanh = ($gia - $giamgia) * $soluong;
                    $tensp = $this->laycot("SELECT tensp from sanpham where idsp ='$idsp' limit 1" );
                   


                    echo'<tr>
						<form method="post">
						  <td>'.$dem.'</td>
						  <td>'.$tensp.'</td>
						  <td><input type="text" name="txtsl" id="txtsl" value="'.$soluong.'"></td>
						  <td>'.$gia.'</td>
						  <td>'.$giamgia.'</td>
						  <td>'.$giathanh.'</td>
						  <td align="center">
						  <input type="submit" name="nut" id="nut" value="Xóa">
						  <input type="hidden" name="txtiddh" id="txtiddh" value="'.$iddh.'">
						  <input type="submit" name="nut" id="nut" value="Sửa">
						 </form>
						  </td>
						</tr>';
                    $dem++;
                }
                echo '</tbody>
                   </table>
                    ';
                echo '<a href="../khachhang/logout.php">Đăng xuất</a><br>';
                   
            } 
            else 
            {
                echo ' khong co du lieu';
            }         
        }
}
