<?php
include_once('../myclass/clslogin.php');
$p = new Login();
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./kh.css">
	<title>Document</title>
	
	
</head>

<body>
	<div class="container_kh">
		<form id="form1" name="form1" method="post" class="form_kh">
			<table class="table_kh">
				<tbody>
					<!-- đăng nhập -->
					<tr class ="login">
						<td class="td_login"> 
							<span class ="td_login--item">Đăng nhập</span>
						</td>
					</tr>
					<!-- tài khoản -->
					<tr class ="td_info">
						<td class="td_kh">Tài khoản</td>
						<td class="td_kh"><input class="td_info-user" type="text" name="txtemail" id="txtemail"></td>
					</tr>
					<!-- mật khẩu -->
					<tr class ="td_info">
						<td class="td_kh">Mật khẩu</td>
						<td class="td_kh"><input class="td_info-user" type="password" name="txtpass" id="txtpass"></td>
					</tr>
					<!-- đăng nhâp -->
					<tr class ="td_info">
						<td class="td_kh-submit"><input class="td_submit" type="submit" value="Login" name="nut" id="nut">
							<input class="td_submit" type="reset" value="reset" id="reset" value="Reset">
						</td>
	
					</tr>
	
				</tbody>
			</table>
			<div align="center">
				<?php
				if ($_POST["nut"] == "Login") {
					$user = $_REQUEST["txtemail"];
					$pass = $_REQUEST["txtpass"];
					if ($user!=''&& $pass!='') {
						if ($p->myLoginKh($user, $pass,"khachhang","../")==0) {
							echo '<script>alert("Sai tài khoản hoặc mật khẩu")</script>';
						}
					} else {
						echo '<script>alert("Vui lòng nhập đầy đủ thông tin")</script>';
					}
				}
				?>
			</div>
		</form>
	</div>

</body>

</html>