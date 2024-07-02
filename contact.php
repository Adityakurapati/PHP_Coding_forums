<html lang="en">

<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="../middlewares/bootstrap.min.css">
    <link rel="stylesheet" href="../middlewares/style.css">
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
    </style>
</head>


<body>
    <?php
    echo "Hello";
    // session_start();
    
    session_start(); 
    session_unset();
    
    header('Location: ./login.php');
    session_destroy();
?>

</body>
<?php include './partials/_navbar.php' ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>

</html>