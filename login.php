<!DOCTYPE html>
<?php
session_start();
?>

<?php
include ("connection/connect.php");
?>

<!DOCTYPE html>
<head>
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

    <div class="container-fluid mt-3 mb-5">

        <div class="mask d-flex justify-content-center align-items-center">

            <div class="container py-5 my-5">

                <h3 class="font-weight-bold text-center white-text pb-2">Log-in Today to BigFestBelfast </h3>
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-md-6 col-xl-5">
                        <form method="Post" action="processlogin.php">
                            <div class="card">
                                <div class="card-body z-depth-2 px-4">
                                    <div class="md-form mt-3">
                                        <i class="fa fa-user prefix grey-text"></i>
                                        <input type="text" name="username" placeholder="Username" required="required" class="form-control">
                                        <label for="form3">Username:</label>
                                    </div>
                                    <div class="md-form">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" name="password" placeholder="Password" required="required" class="form-control">
                                        <label for="form2">Password:</label>
                                    </div>
                                    <div class="text-center my-3">
                                        <button type="submit" name="login" class="btn btn-indigo btn-block" name="login">Sign in</button>
                                       
                                    </div>
                                    
                                </div>

                            </div>
 </form>
                        <div class="text-center my-3">
                         <a href="reset-password.php"><button class="btn btn-indigo btn-block" >Forgot your password?</button></a>
                         </div>
                    </div>

                </div>

            </div>

        </div>

    

</div>

   


</html>
