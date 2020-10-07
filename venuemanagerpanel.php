<?php
include("connection/connect.php");
session_start();
if (isset($_SESSION['username'])) {

            $userselect = $_SESSION['username'];
            
            $userprotect = "SELECT usertypeid FROM Users WHERE UserName = '$userselect'";
$protectsession = $conn->query($userprotect) or die($mydb->error);
while($rowdata = $protectsession->fetch_assoc()){
    $usertype = $rowdata['usertypeid'];

    if ($usertype == '1') {
        header('location:login.php?unauthorised=1');
    }
    if ($usertype == '2') {
        header('location:login.php?unauthorised=1');
    }
    
}
 $userread = "SELECT * FROM Users WHERE username='$userselect'";
            $userresult = $conn->query($userread);
            

            while ($row = $userresult->fetch_assoc()) {
                $userid = $row["user_id"];
                $username = $row["username"];
                $userprofilepicture = $row["profilepicture"];
                $userforename = $row["forename"];
                $usersurname = $row["surname"];
                $userdateofbirth = $row["dateofbirth"];
                $useraddress = $row["address"];
                $userphonenumber = $row["phonenumber"];
                $useremail = $row["email"];
                $userauthorised=$row["authorised"];
                $usertypeid=$row["usertypeid"];
                
                
            }
            
            if(!$usertypeid==3){
                header("location:login.php?unauthorised=1");
            }
           
}
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
        <link rel="stylesheet" type="text/css" href="styles/login.css">
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
                                    <a class="nav-link active" href="venuemanagerpanel.php?adminaccountinformation">
                                        <span data-feather="home"></span>
                                        Account Information <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="venuemanagerpanel.php?addnewvenue">
                                        <span data-feather="file"></span>
                                        Add New Venue
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="venuemanagerpanel.php?viewallvenues">
                                        <span data-feather="file"></span>
                                        View All Venues
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="venuemanagerpanel.php?addnewevent">
                                        <span data-feather="file"></span>
                                        Add New Event
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="venuemanagerpanel.php?viewallevents">
                                        <span data-feather="file"></span>
                                        View All Events
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="venuemanagerpanel.php?viewallperformances">
                                        <span data-feather="file"></span>
                                        View All Venue Performances
                                    </a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="venuemanagerpanel.php?addnewannouncement">
                                        <span data-feather="file"></span>
                                        Add New Announcement
                                    </a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="venuemanagerpanel.php?viewallannouncements">
                                        <span data-feather="file"></span>
                                        View All Announcements
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="venuemanagerpanel.php?viewreservedtickets">
                                        <span data-feather="file"></span>
                                        Reserved Tickets
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="venuemanagerpanel.php?recievedmessages">
                                        <span data-feather="file"></span>
                                      Message Inbox
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
                        if (isset($_GET['adminaccountinformation'])) {
                            include ("venuemanageraccountinformation.php");
                        }
                        if (isset($_GET['addnewvenue'])) {
                            include ("venuemanageraddnewvenue.php");
                        }
                        if (isset($_GET['viewallvenues'])) {
                            include ("venuemanagerviewvenues.php");
                        }
                        if (isset($_GET['addnewevent'])) {
                            include ("venuemanageraddnewevent.php");
                        }
                        if (isset($_GET['viewallevents'])) {
                            include ("venuemanagerviewevents.php");
                        }
                         if (isset($_GET['addnewannouncement'])) {
                            include ("venuemanageraddannouncement.php");
                        }
                        if (isset($_GET['viewallannouncements'])) {
                            include ("venuemanagerviewannouncements.php");
                        }
                         if (isset($_GET['viewallperformances'])) {
                            include ("venuemanagerviewperformances.php");
                        }
                        if (isset($_GET['editeventdetails'])) {
                            include ("venuemanagerviewevents.php");
                        }
                        if (isset($_GET['recievedmessages'])) {
                            include ("venuemanagerviewmessages.php");
                        }
                        
                        
                    }
                    ?>
                </main>

                </body>
                </html>

