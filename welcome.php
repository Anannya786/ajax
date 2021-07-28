<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Welcome</title>
	<script src="Welcome.js"></script>
</head>
<body>
	<?php
	include 'DbAction.php';
	if (empty($_GET['search']) or empty($_GET['username'])) {
		$users =getAllUsers();
	}
	else{
		$users =getUser($_GET['username']);
	}
  		session_start();  

		$username = "";

		if (isset($_SESSION['username'])) {
  			$username= $_SESSION['username'];
		}

	?>

	<h1>Welcome, <?php echo $username ?></h1>
	<br>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET" name="home" onsubmit="return fetch();">
		<input type="text" name="username">
		<input type="submit" name="search" value="search" onclick="showUser()">

	</form>

	<table id="userlist">
  <tr>
  	<th>ID</th>
  	<th>Name</th>
    <th>Username</th>
    <th>Email</th>
  </tr>
  <?php
  for ($i = 0; $i < sizeof($users);$i++) { ?>
  	 <tr>
  	 <td><?php echo $users[$i]["id"] ?></td>
  	 <td> <?php echo $users[$i]["firstname"] . " " . $users[$i]["lastname"] ?></td>
     <td> <?php echo $users[$i]["username"] ?></td>
     <td><?php echo $users[$i]["email"] ?></td>
  <?php }  ?>

</body>
</html>