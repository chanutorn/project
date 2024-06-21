<?php
session_start();
include('h.php');
?>

<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="index_css/signup.css">
</head>

<body>
	<div class="box">
		<form id="signupForm">
			<h2>สมัครสมาชิก</h2>

			<input type="text" name="m_user" placeholder="ไอดีสมาชิก">

			<input type="password" name="m_pass" placeholder="รหัสผ่าน">

			<input type="password" name="confirm_pass" placeholder="ยืนยันรหัสผ่าน">

			<input type="text" name="m_name" placeholder="ชื่อ">

			<input type="text" name="m_tel" placeholder="เบอร์โทรศัพท์" maxlength="10">

			<input type="email" name="m_email" placeholder="อีเมล">

			<input type="text" name="m_address" placeholder="ที่อยู่">

			<input type="submit" value="สมัครสมาชิก">
			<div class="group">
				<a href="login.php">เข้าสู่ระบบ</a>
				<a href="index.php">หน้าหลัก</a>
			</div>
		</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
		$(document).ready(function() {
			$("#signupForm").submit(function(e) {
				e.preventDefault();

				let formUrl = "signup_db.php";
				let reqMethod = "POST";
				let formData = $(this).serialize();

				$.ajax({
					url: formUrl,
					type: reqMethod,
					data: formData,
					success: function(data) {
						let result = JSON.parse(data);
						if (result.status == "success") {
							Swal.fire({
								position: "top-end",
								title: "สำเร็จ",
								text: result.msg,
								icon: result.status,
								timer: 1500,
								showConfirmButton: false
							}).then(() => {
								window.location.reload();
							});
						} else {
							Swal.fire({
								position: "top-end",
								title: "ล้มเหลว",
								text: result.msg,
								icon: result.status,
								timer: 1500,
								showConfirmButton: false
							})
						}
					}
				});
			});
		});
	</script>
</body>

</html>