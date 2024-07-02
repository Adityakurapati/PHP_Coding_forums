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

          #carouselExampleIndicators,
          .carousel-item {
                    height: 70vh;
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
                    align-items: center;
          }

          .centered {
                    margin: 2rem auto;
          }

          .card {
                    /* max-width: 90vw !important; */
                    width: 100% !important;
          }

          /* .grp {
        display: flex;
    } */
          </style>
</head>
<?php include '_dbconn2.php' ?>

<?php
$catname="";
$catdesc="";
$catid="";
$showAlert=false;


session_start();
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true){
    header('Location: ./login.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // global $catid;
    // global $catname;
    // global $catdesc;
    $catid = $_GET['cat_id'];
    $sql = "SELECT * FROM categories WHERE category_id = $catid";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $catname = $row['category_name'];
        $catdesc = $row['category_desc'];
    }
}
$method = $_SERVER['REQUEST_METHOD'];
if($method=="POST"){
    $title = $_POST['thread_title'];
    $desc = $_POST['thread_desc'];
    $sql = "INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `client_id`, `posted`) VALUES (NULL, '$title', '$desc', '$catid', '1', current_timestamp());";
    $result =mysqli_query($conn,$sql);
    if($result){
        $showAlert=true;
    }
    if($showAlert){
        echo '<div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <h4 class="alert-heading">Success!</h4>
        <p class="mb-0">Your Thread Has Been Added , Please Wait For Community For Solution</p>
      </div>';
    }
}

?>

<body>
          <?php include './partials/_navbar.php' ?>
          <div class="card border-primary mb-3 centered" style="max-width=100vw;">
                    <div class="card-header ">Coding Forems</div>
                    <div class="card-body">
                              <h4 class="card-title">Welcome To <?php echo $catname;?> Forems</h4>
                              <p class="card-text"><?php echo $catdesc;?></p>
                              <p class="card-text">
                                        1. No Spam / Advertising / Self-promote in the forums<br>2. Do not post
                                        copyright-infringing
                                        material<br>
                                        3. Do not post “offensive” posts, links or images<br>4. Do not cross post
                                        questions<br>
                                        5. Do not PM users asking for help<br>6. Remain respectful of other members at
                                        all times

                              </p>
                    </div>
          </div>

          <div class="container" style="background:transparent;">
                    <h2 class="py-2 mb-4">Browse Questions</h2>
                    <?php
            $sql = "SELECT * FROM `threads` where `thread_cat_id`=$catid;";
            $result = mysqli_query($conn, $sql);
            $noThreads=true;
            $rows = mysqli_num_rows($result);
            if($rows>0){
                $noThreads=false;
                while($row = mysqli_fetch_assoc($result)){
                echo '<div class="media">
            <img src="https://source.unsplash.com/random/900×700/?user" width="60px" height="60px" class="mr-3"
                style="border-radius:50%;">
            <div class="media-body">
                <h5 class="mt-0"><a href="./thread.php?thread_id='.$row['thread_id'].'">'.$row['thread_title'].'</a></h5>
                <p>'.$row['thread_desc'].'</p>
            </div>
        </div>';
                }
            }
            echo '<form action="'. $_SERVER['REQUEST_URI'] .'" method="post" class="container my-4">
                <div class="form-group grp">
                    <input type="text" class="form-control my-2" placeholder="Enter Concern Title" id="exampleInputPassword1" name="thread_title">
                    <input type="text" class="form-control my-2" placeholder="Enter Description" id="exampleInputPassword1" name="thread_desc">
                    <button type="submit" class="btn btn-outline-danger">POST</button>
                </div>
            </form>';
            if($noThreads){
                echo '
                <div class="jumbotron">
                <h1 class="display-4">No Threads Found For This Category</h1>
                <p class="lead">Be The First Person TO Post Thread For This Category</p>
                <hr class="my-4">
            </div>
            
        ';
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