<!doctype html>
<html lang="en">

<head>
          <!-- Bootstrap CSS -->
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
                    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
                    crossorigin="anonymous">

          <link rel="stylesheet" href="../middlewares/bootstrap.min.css">
          <title>Authentiation</title>
          <style>
          /* body {
        height: 100%;
    } */

          .container {
                    background: #6c28db;
                    filter: drop-shadow(0 0 0.5rem #000);
                    border-radius: 1rem;
                    padding: 2rem;
                    width: 50vw;
          }

          #carouselExampleIndicators,
          .carousel-item {
                    height: 100%;
          }

          .cards {
                    left: 25%;
                    position: absolute;
                    top: 85%;
                    padding: 1rem;
          }

          #carouselExampleIndicators {
                    position: relative;
          }

          .card1 {
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                    place-items: center;
                    width: 70vw;
          }

          .carousel-inner {
                    height: 70vh;
          }

          .card {
                    transition: all 0.2s ease-out;
          }

          .card:hover {
                    tranform: scale(1.3);
                    border: 3px solid purple;
                    box-shadow: 0.4rem 1rem 3rem 0.1rem #000;
          }

          @media only screen and (max-width:1400px) {
                    .card1 {
                              grid-template-columns: 1;
                    }
          }
          </style>
</head>
<?php include '_dbconn2.php' ?>

<?php
session_start();
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true){
    header('Location: ./login.php'); 
    exit();
}

?>

<body mb-4 pb-4>
          <?php include './partials/_navbar.php' ?>
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                              <div class="carousel-item active">
                                        <img src="https://source.unsplash.com/random/900×300/?js" class="d-block w-100"
                                                  alt="...">
                              </div>
                              <div class="carousel-item">
                                        <img src="https://source.unsplash.com/random/900×300/?python"
                                                  class="d-block w-100" alt="...">
                              </div>
                              <div class="carousel-item">
                                        <img src="https://source.unsplash.com/random/900×300/?django"
                                                  class="d-block w-100" alt="...">
                              </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators"
                              data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators"
                              data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                    </button>
                    <div class="container my-4 col-md-6 card1">
                              <?php 
           $sql = "SELECT * FROM `categories`";
           $result = mysqli_query($conn,$sql);
           
           if(mysqli_num_rows($result) > 0){
                while($category = mysqli_fetch_assoc($result)){
                    $name = $category['category_name'];
                    $id = $category['category_id'];
                    $desc = $category['category_desc'];
                    echo '<div class="card my-4 mx-4" style="width: 18rem;">
                    <img src="https://source.unsplash.com/random/900×700/?'.$name.'" height="200px" class=" card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">'.$name.'</h5>
                        <p class="card-text">'.substr($desc,0,50).'...</p>
                        <a href="./threadlist.php  ?cat_id= '. $id .'" class="btn btn-primary">Show Threads</a>
                    </div>
                </div>'; 
                }
           }
           ?>

                    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
          integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>

</html>