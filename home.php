<?php
include("connection/connect.php");
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="style/home.css">
    </head>
    <body>
        <section id='navigation'>
            <nav class='navbar navbar-expand-lg navbar-light'>
                <img src='img/Assingment 1.png' width='120' height='100' alt=''>
                <a class='navbar-brand' href='Index.php'>BigFestBelfast</a>
                <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarNav'>
                    <ul class='navbar-nav ml-auto'>
                        <li class='nav-item active'>
                            <a class='nav-link' href='home.php'>HOME <span class='sr-only'>(current)</span></a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='venues.php'>VENUES</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='events.php'>EVENTS</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='performances.php'>PERFORMANCES</a>
                        </li>
                        <li class='nav-item'>
                            <?php
                            if (isset($_SESSION['username'])) {
                                $userselect = $_SESSION['username'];

                                $userprotect = "SELECT usertypeid FROM Users WHERE Username = '$userselect'";
                                $protectsession = $conn->query($userprotect) or die($mydb->error);
                                while ($rowdata = $protectsession->fetch_assoc()) {
                                    $usertype = $rowdata['usertypeid'];
                                    if ($usertype == '1') {
                                        echo "<a class='nav-link' href='adminpanel.php'>ACCOUNT</a>
                <li class='nav-item'>
            <a class='nav-link' href='logout.php'>LOGOUT</a>";
                                    }
                                    if ($usertype == '2') {
                                        echo "<a class='nav-link' href='useradminpanel.php'>ACCOUNT</a>
                <li class='nav-item'>
            <a class='nav-link' href='logout.php'>LOGOUT</a>";
                                    }
                                    if ($usertype == '3') {
                                        echo "<a class='nav-link' href='venuemanagerpanel.php'>ACCOUNT</a>
                <li class='nav-item'>
            <a class='nav-link' href='logout.php'>LOGOUT</a>";
                                    }
                                }
                            } else {
                                echo "<a class='nav-link' href='login.php'>LOGIN</a>
                                    <a class='nav-link' href='signup.php'>SIGNUP</a>
                                    ";
                            }
                            ?>    
                        <li class='nav-item'>
                            <form class="form-inline my-2 my-lg-0" action='search.php' method='POST'>
                                <input class="form-control mr-sm-2" type="search" name='search' placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name='submit-search'>Search</button>
                            </form>
                        </li>   
                    </ul>
                </div>
            </nav>
        </section>


        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <img src="img/SSEarena.jpg" id="homepageimage4" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Welcome to BigFestBelfast </h5>
                        <p class="card-text">BigFestBelfast is home to several of the highest rated venues in Belfast and the UK that continues to host over 300 events per year with such venues as The SSE Arena, The Telegraph Building, The Manchester Arena to namme a few providing customers with only the best experience </p>
                        <a href="venues.php" class="btn btn-primary">View Venues</a>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4">
                <div class="card mb-3">
                    <img src="img/PATD.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">World Renowned Peformances</h5>
                        <p class="card-text">BigFestBelfast offers a diverse range of critically acclimaed performances from across the globe each year such as The Script, One Republic, Imagine Dragons and many more ensuring customers have an outstanding experience </p>
                        <a href="performances.php" class="btn btn-primary">View Current/Upcoming Performances</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-md-4">
                <div class="jumbotron">
                    <h1 class="display-4">Who are BigFestBelfast? </h1>
                    <p class="lead">Want to learn more about BigFestBelfast visit our about page to get a better understanding of our company and what we aim to achieve</p>
                    <hr class="my-4">
                    <p>Click the link below to find out more.</p>
                    <a class="btn btn-primary btn-lg" href="about.php" role="button">Learn more</a>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="card bg-dark text-white">
                    <img src="img/JaxJones.jpg" class="card-img" alt="...">
                    <div class="card-img-overlay">
                        <h5 class="card-title">Live Performances to remember</h5>
                        <p class="card-text">Jax Jones at our summertime ball in 2018</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="card bg-dark text-white">
                    <img src="img/Thehydro.jpg" class="card-img" alt="...">
                    <div class="card-img-overlay">
                        <h5 class="card-title">Venues to tend to thousands of guests</h5>
                        <p class="card-text">The Iconic SSE Hyrdo Arena</p>

                    </div>
                </div>
            </div>
        </div>



    </body>
</html>
