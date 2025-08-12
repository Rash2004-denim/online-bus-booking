<?php
// Database configuration for Sri Lanka Bus Ticketing
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root'); // Default XAMPP username
define('DB_PASSWORD', ''); // Default XAMPP password is empty
define('DB_NAME', 'ticket_booking'); // Database name

// Attempt to connect to MySQL database
try {
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if($conn === false){
        throw new Exception("ERROR: Could not connect. " . mysqli_connect_error());
    }
    
    // Create tables if they don't exist
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        phone VARCHAR(15),
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    
    if(!mysqli_query($conn, $sql)) {
        throw new Exception("Error creating users table: " . mysqli_error($conn));
    }
    
    $sql = "CREATE TABLE IF NOT EXISTS bus_routes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        route_number VARCHAR(10) NOT NULL,
        start_point VARCHAR(50) NOT NULL,
        end_point VARCHAR(50) NOT NULL,
        via_cities TEXT,
        departure_time TIME NOT NULL,
        arrival_time TIME NOT NULL,
        fare DECIMAL(10,2) NOT NULL
    )";
    
    if(!mysqli_query($conn, $sql)) {
        throw new Exception("Error creating bus_routes table: " . mysqli_error($conn));
    }
    
    $sql = "CREATE TABLE IF NOT EXISTS bookings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        route_id INT,
        travel_date DATE NOT NULL,
        seats INT NOT NULL,
        total_fare DECIMAL(10,2) NOT NULL,
        booking_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        status ENUM('confirmed', 'cancelled') DEFAULT 'confirmed',
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (route_id) REFERENCES bus_routes(id)
    )";
    
    if(!mysqli_query($conn, $sql)) {
        throw new Exception("Error creating bookings table: " . mysqli_error($conn));
    }
    
    // Insert sample bus routes if table is empty
    $sql = "SELECT COUNT(*) as count FROM bus_routes";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if($row['count'] == 0) {
        $sql = "INSERT INTO bus_routes (route_number, start_point, end_point, via_cities, departure_time, arrival_time, fare) VALUES
            ('100', 'Colombo', 'Kandy', 'Kadawatha, Warakapola', '08:00:00', '11:30:00', 350.00),
            ('101', 'Colombo', 'Galle', 'Panadura, Kalutara', '07:30:00', '10:00:00', 300.00),
            ('102', 'Colombo', 'Jaffna', 'Kurunegala, Anuradhapura, Vavuniya', '06:00:00', '14:00:00', 1200.00),
            ('103', 'Kandy', 'Nuwara Eliya', 'Peradeniya, Gampola', '09:00:00', '11:00:00', 250.00),
            ('104', 'Colombo', 'Trincomalee', 'Kandy, Dambulla, Habarana', '07:00:00', '13:00:00', 800.00)";
            
        if(!mysqli_query($conn, $sql)) {
            throw new Exception("Error inserting sample routes: " . mysqli_error($conn));
        }
    }
    
} catch (Exception $e) {
    die($e->getMessage());
}

// Start session
session_start();

// Set timezone to Sri Lanka
date_default_timezone_set('Asia/Colombo');
?>