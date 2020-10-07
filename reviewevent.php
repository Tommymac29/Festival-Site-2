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
    </head>
    <body>
            <section id='navigation'>
            <nav class='navbar navbar-expand-lg navbar-light'>
                <img src='img/Assingment 1.png' width='120' height='100' alt=''>
                <a class='navbar-brand' href='Index.php'>BELFAST BIGFEST</a>
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
                            <a class='nav-link' href='about.php'>ABOUT</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='contact.php'>CONTACT US</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </section>
        <?php
        if (isset($_SESSION['username'])) {

            $userselect = $_SESSION['username'];

            $queryread = "SELECT * FROM Users WHERE username='$userselect'";

            $result = $conn->query($queryread);

            while ($row = $result->fetch_assoc()) {
                $userid = $row["user_id"];
                $username = $row["username"];
                $userprofilepicture = $row["profilepicture"];
                $userforename = $row["forename"];
                $usersurname = $row["surname"];
                $userdateofbirth = $row["dateofbirth"];
                $useraddress = $row["address"];
                $userphonenumber = $row["phonenumber"];
                $useremail = $row["email"];
            }
            ?>
            <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
                <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Welcome back <?php echo "$username" ?></a>
                <ul class="navbar-nav px-3">
                    <li class="nav-item text-nowrap">
                        <a class="nav-link" href="logout.php">Sign out</a>
                    </li>
                </ul>
            </nav>
            <div class="container-fluid">
                <div class="row">
                    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                        <div class="sidebar-sticky">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active" href="useradminpannel.php?accountinformation">
                                        <span data-feather="home"></span>
                                        Account Information <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="useradminpannel.php?bookings">
                                        <span data-feather="file"></span>
                                       Bookings
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <span data-feather="shopping-cart"></span>
                                        Reviews
                                    </a>
                                </li>
                        </div>
                    </nav>
                    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                            <h1 class="h2">USER DASHBOARD</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group mr-2">
                                    <button class="btn btn-sm btn-outline-secondary">Share</button>
                                    <button class="btn btn-sm btn-outline-secondary">Export</button>
                                </div>
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                                </button>
                            </div>
                        </div>
                         <?php
                        if (isset($_GET['accountinformation'])) {
                            include ("useraccountinformation.php");
                        }
                        if (isset($_GET['bookings'])) {
                            include ('useraccountbookings.php');
                        }
                        if (isset($_GET['reviews'])) {
                            include ('useraccountreviews.php');
                        }               
        }
        ?>
        <?php
        if (isset($_GET["reviewevent"])) {
           $eid = $_GET["reviewevent"];
           echo $eid;
           
           $sql = "SELECT * FROM `Booking1` WHERE `booking_id` = '$eid'";
           $result1 = $conn->query($sql) or die($conn->error);
           while($rowdata = $result1->fetch_assoc()){
               $eventid = $rowdata['bookingevent'];
               $userid = $rowdata['bookinguser'];
           }
        } echo  $eventid;
            ?>
         <form method="POST" action="addreview.php?rowid=$reviewevent" enctype="multipart/form-data">

        <div class="field">
            <div class="form-group">

                <label for="Title">Review Title:</label>
                <input type="text" class="input"  name="title" placeholder="Review Title">
            </div>
        </div>

        <div class="field">
            <div class="form-group">
                <label for="Content">Content:</label>
                <input type="text"  class="input"  class="form-control" name="content" placeholder=>
            </div>
        </div>

        <div class="field">
            <div class="form-group">
                <label for="Rating">Event Rating:</label>
                <input type="number"   class="input" class="form-control" name="rating" placeholder=>
            </div>
        </div>
             
             <div class="form-group">
                <input type="hidden" class="input"  name="id" value=<?php echo $eventid?>>
            </div>
             <div class="form-group">
                <input type="hidden" class="input"  name="uid" value=<?php echo $userid?>>
            </div>
             
             
        <button  class="button" type="submit" name="submitreview" class="btn btn-primary">Submit review</button>

    </form> 
                    </main>
                   
        
    </body>
</html>
