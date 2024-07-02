<!doctype html>
<html lang="en">

<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
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
        min-width: 90vw !important;
    }
    </style>
</head>
<?php include '_dbconn2.php' ?>

<?php
$catname;
$catid;
$post="";
session_start();
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true){
    header('Location: ./login.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $threadid = $_GET['thread_id'];
    $_SESSION['thread_id'] = $threadid;
    if(isset($_GET['post'])){
        $post = $_GET['post'];
    }
    $sql = "SELECT * FROM threads WHERE thread_id = $threadid";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $date = $row['posted'];
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $thread_id = $_SESSION['thread_id'];
    $comment_message = $_POST['comment_message'];
    $sql = "INSERT INTO `comments` (`comment_message`, `thread_id`, `thread_cat_id`, `comment_time`) VALUES ('$comment_message', '$thread_id', '2', current_timestamp());";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_affected_rows($conn);
    if($rows > 0){
        echo '<div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="success"></button>
        <h4 class="alert-heading">Success!</h4>
        <p class="mb-0">Your Comment Was Posted</p>
      </div>';
    }else{
        echo "Error ".mysqli_error($conn);
    }
    header('location: '.$_SERVER['REQUEST_URI']);
}

?>

<body>
    <?php include './partials/_navbar.php' ?>
    <div class="card border-primary mb-3 centered" style="max-width: 20rem;">
        <div class="card-header ">Coding Forems</div>
        <div class="card-body">
            <h4 class="card-title"><i class="uil uil-comment-alt-question"></i> <?php echo $title;?> Forems</h4>
            <p class="card-text"><?php echo $desc;?></p>
            <p class="card-text">Posted On <?php echo $date;?> By </p>
        </div>
    </div>
    <div class="container-fluid my-4 mx-4" style="background:transparent;">
        <h2 class="py-2 mb-4">Discussions</h2>

        <a href="<?php echo $_SERVER['REQUEST_URI']."&post=true";?>" class="mx-4"><button
                class="btn btn-primary my-4 btn-success text-bg-dark"><i class="uil uil-corner-up-left-alt"></i>
                Post A
                Reply</button></a>
        <?php
            $noResult=true;
            if($post){
                echo '<form action="'.$_SERVER['REQUEST_URI'].'" method="POST" class="mx-4 my-4">
                        <div class="form-group">
                        <textarea class="form-control row" name="comment_message" cols="20" placeholder="Type Your Solution" id="exampleFormControlTextarea1" rows="1"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Post</button>
              </form>';
            }

            $sql = "SELECT * FROM comments WHERE thread_id = $threadid";
            $result = mysqli_query($conn, $sql);        
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $noResult=false;
                    echo '<div class="media my-4 mx-4">
                    <img src="https://source.unsplash.com/random/900×700/?user" width="50px" height="50px" class="mr-3" alt="...">
                    <div class="media-body">
                      <h5 class="mt-0">Anonymous User</h5>
                      <p>'.$row['comment_message'].'</p>
                    </div>
                  </div>';
                }
            }
            ?>
    </div>
</body>
<script src=" https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>

</html>