<?php
class tmdt
{
    public function connect()
    {
        $conn = mysql_connect("localhost","lehoangnho","01255");
        if(!$conn)
        {
            echo 'Không kết nối được csdl';
            exit;
        }else{
            mysql_select_db('tmdt_db');
            mysql_query('SET NAMES UTF8');
            return $conn;
        }
    }

    public function uploadfile($name, $tmp_name, $folder)
    {
        $newname = $folder ."/". $name;
        if(move_uploaded_file($tmp_name, $newname))
        {
            return 1;
        }else{
            return 0;
        }
    }

    public function themsuaxoa($sql)
    {
        $link = $this->connect();
        if (mysql_query($sql, $link))
        {
            return 1;
        }else{
            return 0;
        }
    }

    public function laycot($sql)
    {
        $link = $this->connect();
        $ketqua = mysql_query($sql, $link);
        $i = mysql_num_rows($ketqua);
        $trave = '';
        if ($i > 0) {
            
            while ($row = mysql_fetch_array($ketqua)) {
                $gt = $row[0];
                $trave = $gt;
            }
        }
        return $trave;
    }
}
?>