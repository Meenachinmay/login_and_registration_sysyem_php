<?php 
    session_start();
    $userName = "";
    $userEmail = "";
    $value_email = "";
    $value_userName = "";
    $validation_errors = array();

    // connect to database
	$conn = mysqli_connect('localhost', 'root', '', 'registration');

    if (filter_has_var(INPUT_POST, 'user_registration_data_submit')){
        $value_email = $_POST['email'];
        $value_userName = $_POST['username'];
        if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['username']) || empty($_POST['confirm_password'])) {
            array_push($validation_errors, "all fields are required");
        }else {
            if (strlen($_POST['username']) > 30 || strlen($_POST['username']) < 3) {
                array_push($validation_errors, "Username is invalide, length should be from 3 to 15 chars.");
            }else {
                $userName = mysqli_real_escape_string($conn,$_POST['username']);
            }

            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $check_email_query = "SELECT * FROM users WHERE email='".$_POST['email']."'";
                $check_email_query_result = mysqli_query($conn, $check_email_query);
                if (mysqli_num_rows($check_email_query_result)) {
                    array_push($validation_errors, "Email is already used, please try again with different email.");
                }else{
                    $userEmail = mysqli_real_escape_string($conn,$_POST['email']);
                }   
            }else {
                array_push($validation_errors, "Email is invalid");
            }

            if(strlen($_POST['password']) >= 25 || strlen($_POST['password'] < 6)) {
                array_push($validation_errors, "Length of the password should be between 6 and 25");
            }

            if ($_POST['password'] != $_POST['confirm_password']) {
                array_push($validation_errors, "Password and Confirm password are not same.");
            }

            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
        }

        if (count($validation_errors) > 0){
        } else {
            $password = md5($password);
            $user_register_query = "INSERT INTO users (username, email, password) VALUES ('$userName', '$userEmail', '$password')";
            
            if(mysqli_query($conn, $user_register_query)) {
                $_SESSION['email'] = $userEmail;
                $_SESSION['registration_success'] = "You are now registered in";
                $validation_errors = "";
                header('location: index.php');
            }

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <div class="container p-5">
    <?php include('errors.php'); ?>
    <form method="POST" action="my_Registration.php">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo $value_userName; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" value="<?php echo $value_email; ?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password">
            <label for="password">Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password">
        </div>

        <button type="submit" class="btn btn-primary" name="user_registration_data_submit">Submit</button>
    </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.mi
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" 
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>