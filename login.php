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
	<link rel="stylesheet" href="index_css/login.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
	<div class="box">
		<form id="loginForm" method="POST">
			<h2>เข้าสู่ระบบ</h2>
			<input name="m_user" id="m_user" type="text" placeholder="สมาชิก">
			<input name="m_pass" id="m_pass" type="password" placeholder="รหัสผ่าน">
			<input type="submit" value="เข้าสู่ระบบ">
			<div class="group">
				<a href="signup.php">สมัครสมาชิก</a>
				<a href="index.php">หน้าหลัก</a>
			</div>
		</form>
	</div>

	<script>
		document.getElementById('loginForm').addEventListener('submit', function(e) {
			e.preventDefault();

			const formData = new FormData(this);

			fetch('cheack_login.php', {
					method: 'POST',
					body: formData
				})
				.then(response => response.json())
				.then(data => {
					if (data.status === 'error') {
						Swal.fire({
							position: "top-end",
							icon: 'error',
							title: 'ผิดพลาด',
							text: data.msg,
							timer: 1500,
							showConfirmButton: false
						});
					} else if (data.status === 'success') {
						window.location.href = data.location;
					}
				})
				.catch(error => {
					console.error('Error:', error);
					Swal.fire({
						position: "top-end",
						icon: 'error',
						title: 'ผิดพลาด',
						text: 'เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์',
						timer: 1500,
						showConfirmButton: false
					});
				});
		});
	</script>
</body>

</html>