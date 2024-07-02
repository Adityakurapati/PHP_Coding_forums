<?php 
echo '<nav class="navbar navbar-expand-lg navbar-light bg-primary">
<div class="container-fluid">
    <a class="navbar-brand" href="./Home.php">Securio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
        aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-haspopup="true" aria-expanded="false">Categories</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                </div>
            </li>
            <li>
                <a href="./about.php" class="nav-link">About</a>
            </li>
            <li>
                <a href="./contact.php" class="nav-link">Contact Us</a>
            </li>
        </ul>
        <form class="d-flex column">
            <input class="form-control me-sm-2" type="search" placeholder="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            <button class="btn btn-danger row my-2 mx-2">
                <a class="nav-link" href="./sign_up.php">Sign Up</a>
            </button>
            <button class="btn btn-danger row my-2 mx-2">
                <a class="nav-link" href="./login.php">Login</a>
            </button>
            <button class="btn btn-danger nav-item">
                <a class="nav-link" href="./logout.php">Logout</a>
            </button>
            <?php
                if(!isset($_SESSION[\'loggedIn\'])){
                    echo \'\';
                    echo \'\';
                }
            ?>

<?php
                if(isset($_SESSION[\'loggedIn\'])){
                    echo \'\';
                }
            ?>
</form>
</div>
</div>
</nav>';
?>