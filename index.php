<?php 
	session_start(); 

	if (!isset($_SESSION['email'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: my_login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['email']);
		header("location: my_login.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
	<div class="header">
		<h2>Home Page</h2>
	</div>
	<div class="content">

		<!-- notification message -->
		<?php if (isset($_SESSION['registration_success'])) : ?>
			<div class="alert alert-success" role="alert">
				<p>You are registered successfully, Thank you.</p>
				<?php unset($_SESSION['registration_success']); ?>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<?php  if (isset($_SESSION['email'])) : ?>
			<p>Welcome <strong><?php echo $_SESSION['email']; ?></strong></p>
			<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
		<?php endif ?>

	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.mi
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" 
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>