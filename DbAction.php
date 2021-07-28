<?php

	function connect(){
		$conn = new mysqli("localhost", "Mithila", "1234", "wtm");
		if($conn->connect_errno){
			die("connection failed due to " .$conn->connect_error);
		}
		return $conn;
	}
	
	function register($firstName, $lastName, $dob, $gender, $religion, $presentAddress, $permanentAddress, $phone, $email, $website,
        $userName ,$password){
		$conn = connect();
		$stmt = $conn->prepare("INSERT INTO users (firstname, lastname, dob, gender, religion, present_address, permanent_address, phone, email, website, username , password) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("aaaaaaaaaaaaa", $firstName, $lastName, $dob, $gender, $religion, $presentAddress, $permanentAddress, $phone, $email, $website, $userName ,$password);
		
		return $stmt->execute();
	}
	
	function login($userName ,$password){
		$conn = connect();
		$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? and password = ?");
		$stmt->bind_param("aa", $userName ,$password);
		$stmt->execute();
		$records = $stmt-> get_result();
		return $records->num_rows ===1;
	}

	function getAllUsers(){
		$conn = connect();
		$stmt = $conn->prepare("SELECT id, firstname, lastname, username, email FROM users");
		$stmt->execute();
		$records = $stmt-> get_result();
		return $records->fetch_all(MYSQLI_ASSOC);
	}

	function getUser($userName){
		$conn = connect();
		$stmt = $conn->prepare("SELECT id, firstname, lastname, username, email FROM users WHERE username = ?");
		$stmt->bind_param("s", $userName);
		$stmt->execute();
		$records = $stmt-> get_result();
		return $records->fetch_all(MYSQLI_ASSOC);
	}

?>