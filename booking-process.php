<?php
include 'config.php';

// Check if user is logged in
$logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$user_id = $logged_in ? $_SESSION['id'] : null;

// Process booking form data
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate route
    if(empty(trim($_POST["route_id"]))){
        die("Please select a bus route.");
    } else{
        $route_id = trim($_POST["route_id"]);
    }
    
    // Validate travel date
    if(empty(trim($_POST["travel_date"]))){
        die("Please select a travel date.");
    } else{
        $travel_date = trim($_POST["travel_date"]);
        // Check if date is in the past
        if(strtotime($travel_date) < strtotime(date('Y-m-d'))){
            die("Travel date cannot be in the past.");
        }
    }
    
    // Validate seats
    if(empty(trim($_POST["seats"])) || !is_numeric($_POST["seats"]) || $_POST["seats"] < 1 || $_POST["seats"] > 10){
        die("Please enter a valid number of seats (1-10).");
    } else{
        $seats = (int)trim($_POST["seats"]);
    }
    
    // Validate total fare
    if(empty(trim($_POST["total_fare"])) || !is_numeric($_POST["total_fare"]) || $_POST["total_fare"] <= 0){
        die("Invalid fare calculation.");
    } else{
        $total_fare = (float)trim($_POST["total_fare"]);
    }
    
    // Prepare an insert statement
    $sql = "INSERT INTO bookings (user_id, route_id, travel_date, seats, total_fare) VALUES (?, ?, ?, ?, ?)";
     
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "iisid", $param_user_id, $param_route_id, $param_travel_date, $param_seats, $param_total_fare);
        
        // Set parameters
        $param_user_id = $user_id;
        $param_route_id = $route_id;
        $param_travel_date = $travel_date;
        $param_seats = $seats;
        $param_total_fare = $total_fare;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Booking successful
            header("location: index.php?booking=success");
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
} else {
    header("location: index.php");
}
?>