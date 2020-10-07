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
    <body><h2>LISTED EVENT REVIEWS</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>PerformanceID</th>
                        <th>Performance Name</th>
                        <th>Performance Bio</th>
                        <th>Logo</th>
                        <th>Performance Image</th>
                        <th>Performance Type</th>
                    </tr>
                </thead>
                <?php
                $userreviewdetails = "SELECT * FROM Performance INNER JOIN PerformanceType ON Performance.typeid=PerformanceType.performance_type_id";

                $result = $conn->query($userreviewdetails);

                if (!$result) {
                    echo $conn->error;
                }

                while ($row = $result->fetch_assoc()) {
                    $review_id = $row["performance_id"];
                    $review_title = $row["performancename"];
                    $review_content = $row["performancebio"];
                    $review_rating = $row["performanceimage1"];
                    $review_event_id = $row["performanceimage2"];
                    $review_event_date = $row["name"];
                }
                echo "<thead>
                    <tr>
                        <th>$review_id</th>
                        <th>$review_title</th>
                        <th>$review_content</th>
                        <th>$review_rating</th>
                        <th>$review_event_id</th>
                            <th>$review_event_date</th>
                        
                            <td><a href='removereview.php?removereview=$review_id'>Remove Review</a></td>
                                
                    </tr>
                </thead>
                
                   
          
           ";
                ?>

                </body>
                </html>
