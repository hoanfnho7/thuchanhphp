<?php
include("clstmdt.php");
class quantri extends tmdt
{
    public function choncongty($sql, $chonid)
    {
        $link = $this->connect();
        $ketqua = mysql_query($sql, $link);
        $i = mysql_num_rows($ketqua);
        if ($i > 0) {
            echo '<select name="congty" id="congty">
            <option>Chọn công ty</option>';
            while ($row = mysql_fetch_array($ketqua)) {

                $idcty = $row['idcty'];
                $tencty = $row['tencty'];

                if ($chonid == $idcty) {
                    echo '<option value="' . $idcty . '"selected>' . $tencty . '</option>';
                } else {
                    echo '<option value="' . $idcty . '">' . $tencty . '</option>';
                }
            }

            echo '</select>';
        } else {
            echo 'Không có dữ liệu';
        }
    }

    public function xemdssanpham($sql)
    {
        $link = $this->connect();
        $ketqua = mysql_query($sql, $link);
        $i = mysql_num_rows($ketqua);
        if ($i > 0) {
            echo '<table width="349" border="1" align="center">
            <tbody>
              <tr>
                <td width="27" align="center">STT</td>
                <td width="110" align="center">Tên sản phẩm</td>
                <td width="63" align="center">Giá </td>
                <td width="121" align="center">Mô tả</td>
              </tr>';
            $dem = 1;
            while ($row = mysql_fetch_array($ketqua)) {
                $idsp = $row['idsp'];
                $tensp = $row['tensp'];
                $gia = $row['gia'];
                $mota = $row['mota'];

                echo '<tr>
                <td><a href="?id=' . $idsp . '">' . $dem . '</a></td>
                <td><a href="?id=' . $idsp . '">' . $tensp . '</a></td>
                <td><a href="?id=' . $idsp . '">' . $gia . '</a></td>
                <td><a href="?id=' . $idsp . '">' . $mota . '</a></td>
              </tr>';
                $dem++;
            }
            echo '</tbody>
            </table>';
        } else {
            echo 'Không có dữ liệu';
        }
    }

    public function xemdscongty($sql)
    {
        $link = $this->connect();
        $ketqua = mysql_query($sql, $link);
        $i = mysql_num_rows($ketqua);
        if ($i > 0) {
            echo '<table width="373" border="1" align="center">
            <tbody>
              <tr>
                <td width="34" align="center">STT</td>
                <td width="116" align="center">Tên công ty</td>
                <td width="201" align="center">Địa chỉ</td>
              </tr>';
            $dem = 1;
            while ($row = mysql_fetch_array($ketqua)) {
                $idcty = $row['idcty'];
                $tencty = $row['tencty'];
                $diachi = $row['diachi'];

                echo '<tr>
                <td><a href="?id=' . $idcty . '">' . $dem . '</a></td>
                <td><a href="?id=' . $idcty . '">' . $tencty . '</a></td>
                <td><a href="?id=' . $idcty . '">' . $diachi . '</a></td>
              </tr>';
                $dem++;
            }
            echo '</tbody>
            </table>';
        } else {
            echo 'Không có dữ liệu';
        }
    }
}
