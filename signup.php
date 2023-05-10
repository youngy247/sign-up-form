<?php
$success = 0;
$user = 0;
$invalid = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    $pdo = connectToDb($DB);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword=$_POST['cpassword'];

    $sql = "Select * from `registration` where username='$username'";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $user = 1;
    } else {
        if ($password === $cpassword) {
            $sql = "insert into `registration`(username,password)
        values('$username', '$password')";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute();
            if ($result) {
                $success = 1;
                header('location:login.php');
            }
        } else {
                $invalid = 1;
            }
        }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Signup page</title>

    <meta name="description" content="Sign up form">
    <meta name="author" content="Adam Young">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


</head>
<body>

<?php

if($user){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Ohh no Sorry </strong> User already exists
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>

<?php

if($invalid){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Ohh no Sorry </strong> Password did not match
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>

<?php

if($success){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success </strong> You are successfully signed up!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>
<h1 class="text-center">Sign up form</h1>
<div class="container mt-5">
    <form action="signup.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" placeholder="Enter your username" name="username">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" placeholder="Enter your password" name="password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword">
        </div>
        <button type="submit" class="btn btn-primary w-100">Sign up</button>
    </form>
</div>

</body>
</html>
