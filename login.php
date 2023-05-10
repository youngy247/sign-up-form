<?php
$login = 0;
$invalid = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    $pdo = connectToDb($DB);
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "Select * from `registration` where username='$username' and password='$password'";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $login=1;
        session_start();
        $_SESSION['username']=$username;
        header('location:home.php');
    } else {
        $invalid = 1;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login page</title>

    <meta name="description" content="Sign up form">
    <meta name="author" content="Adam Young">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


</head>
<body>
<?php
if($login){
echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success </strong> You are successfully logged in!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
}
?>
<?php
if($invalid){
echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error </strong> Invalid credentials
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
}
?>

<h1 class="text-center">Login to our website</h1>
<div class="container mt-5">
    <form action="login.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" placeholder="Enter your username" name="username">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" placeholder="Enter your password" name="password">
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>

</body>
</html>
