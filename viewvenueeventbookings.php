<?php
include("connection/connect.php");

$userselect = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <h2>CURRENT BOOKINGS</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>BookingID</th>
                        <th>UserID</th>
                        <th>Forename</th>
                        <th>Surname</th>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Venue</th>
                        <th>Location</th>
                        <th>Performing</th>
                        <th>Event Image</th>
                    </tr>
                </thead>
                <?php
                $viewallbookings = "SELECT * FROM Users INNER JOIN Booking1 ON Users.user_id=Booking1.bookinguser INNER JOIN Events ON Booking1.bookingevent=Events.event_id INNER JOIN Venue ON Events.venueid=Venue.venue_id INNER JOIN Performance ON Events.performanceid=Performance.performance_id";

                $result = $conn->query($viewallbookings);

                if (!$result) {
                    echo $conn->error;
                }

                while ($row = $result->fetch_assoc()) {
                    $booking_id = $row["booking_id"];
                    $booking_user_id = $row["user_id"];
                    $booking_user_forename = $row["forename"];
                    $booking_user_surname = $row["surname"];
                    $booking_event_id = $row["event_id"];
                    $booking_event_name = $row["eventname"];
                    $booking_event_date = $row["date"];
                    $booking_event_time = $row["time"];
                    $booking_event_venue = $row["venuename"];
                    $booking_event_location = $row["location"];
                    $booking_event_performances = $row["performancename"];
                    $booking_event_image = $row["eventimage1"];
                }
                echo "<thead>
                    <tr>
                        <th>$booking_id</th>
                        <th>$booking_user_id</th>
                        <th>$booking_user_forename</th>
                        <th>$booking_user_surname</th>
                        <th>$booking_event_name</th>
                        <th>$booking_event_date</th>
                        <th>$booking_event_time</th>
                        <th>$booking_event_venue</th>
                        <th>$booking_event_location</th>
                        <th>$booking_event_performances</th>
                        <th>$booking_event_image</th>
                            <td><a href='removebooking.php?removebooking=$booking_id'>Cancel Booking</a></td>
                                <td><a href='reviewevent.php?reviewevent=$booking_id'>Write a review</a></td> 
                                    <td><a href='viewallbookingdetails.php?viewallbookingdetails=$booking_id'>View all details</a></td> 
                    </tr>
                </thead>
                
                   
          
           ";
                ?>
                </body>
                </html>
