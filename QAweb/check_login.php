<?php

	/*
	* KIỂM TRA NGƯỜI DÙNG ĐĂNG NHẬP
	* - kết nối CSDL lấy thông tin
	* - so sánh với dữ liệu người dùng nhập
	* - kiểm tra phân quyền người dùng
	*/

	## import connect.php
		include "database/connect.php";

	## session

	## cookie


	// get input user post
		$input_user = $_POST["email"];
		$input_pass = $_POST["password"];

	// check input null
	if (!$input_user || !$input_pass) {
		# TODO mess NULL
		header('Location: index.php');
	}

	// get information from database
		# connect to database
		$sql = "SELECT role_id, user_names, user_pass, user_status FROM users WHERE user_names = '$input_user' AND user_pass = '$input_pass'";
		$result = $conn->query($sql);

		if (!$result) {
			die("Error connect to database! Pleas try again!");
		}

		# get result
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$sql_user = $row['user_names'];
			$sql_pass = $row['user_pass'];
			$sql_role = $row['role_id'];
			$sql_status = $row['user_status'];
		} else {
			$sql_user = "NULL";
			$sql_pass = "";
			$sql_role = "";
			$sql_status = "";
		}

	// check account
		if($input_user == $sql_user && $input_pass == $sql_pass){ // true
			# check status
			if($sql_status == "action"){	// true
				# check role
				if ($sql_role <= 2){
					header('Location: teacher');	// go to page teacher
				} else {
					header('Location: student');	// go to page student
				}
			} else {  // false: account banning
				# TODO: baning account
				echo "Account is banning. Try again!";
			}
		}else{	// false: incorrect info account
			# TODO: re-input
			echo "Thông tin tài khoản hoặc mật khẩu không chính xác!";
		}

?>