<!doctype html>
<html lang="en">

<head>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> -->

    <link rel="stylesheet" href="../middlewares/bootstrap.min.css">
    <title>Authentiation</title>
    <style>
    body {
        height: 100vh;
    }

    .container {
        background: #6c28db;
        filter: drop-shadow(0 0 0.5rem #000);
        border-radius: 1rem;
        padding: 2rem;
        width: 50vw;
    }

    .footer {
        position: absolute;
        bottom: 0;
    }
    </style>
</head>
<?php include '_dbconn.php' ?>
<?php
$showerror="";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    
    // $sql = "SELECT * FROM `clients` WHERE `client_name` = '$username' AND `client_password` = '$epassword'";
    $sql = "SELECT * FROM `clients` WHERE `client_name` = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $epassword = password_verify($password, $row['client_password']);
    $rows = mysqli_num_rows($result);
    if($rows == 1 && $epassword){
        
        session_start();
        $_SESSION['loggedIn']="true";
        $_SESSION['username']=$usernamez;
        // echo "<script>window.location='/1Database/40_LoginSystem/Home.php';</script>";
        header('location: ./Home.php');
    }else{
        $showerror="Invalid Username or Password";
    }
}
?>

<body>

    <?php include './partials/_navbar.php' ?>
    <?php 
        if($showerror){
            echo '<div class="alert alert-dismissible alert-warning">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">Warning!</h4>
            <p class="mb-0">'.$showerror.'</p>
          </div>';
        }
    ?>
    <div class="container my-4">
        <form action="./login.php" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Username Or Email address </label>
                <input type="text" name="username" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <?php include './partials/_footer.php' ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>

</html>