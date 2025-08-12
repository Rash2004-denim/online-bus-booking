<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sri Lanka Online Bus Ticketing System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1><i class="fas fa-bus"></i> SL Bus</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="routes.php">Bus Routes</a></li>
                    <li><a href="#about">About</a></li>
                    <?php if(isset($_SESSION['username'])): ?>
                        <li><a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h2>Book Bus Tickets Across Sri Lanka</h2>
            <p>Travel comfortably to any destination in the island</p>
        </div>
    </section>

    <section class="booking-section">
        <div class="container">
            <h2>Book Your Bus Ticket</h2>
            <form action="booking-process.php" method="post">
                <div class="form-group">
                    <label for="route">Select Route:</label>
                    <select id="route" name="route_id" required>
                        <option value="">-- Select Bus Route --</option>
                        <?php
                        $sql = "SELECT id, route_number, start_point, end_point, departure_time, fare FROM bus_routes ORDER BY start_point, end_point";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$row['id']}' data-fare='{$row['fare']}'>
                                Route {$row['route_number']}: {$row['start_point']} to {$row['end_point']} (Dep: {$row['departure_time']}, Fare: Rs.{$row['fare']})
                                </option>";
                        }
                        ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="date">Travel Date:</label>
                    <input type="date" id="date" name="travel_date" required>
                </div>
                
                <div class="form-group">
                    <label for="seats">Number of Seats:</label>
                    <input type="number" id="seats" name="seats" min="1" max="10" required>
                </div>
                
                <div class="form-group">
                    <label>Total Fare:</label>
                    <div id="total-fare">Rs. 0.00</div>
                    <input type="hidden" id="calculated-fare" name="total_fare" value="0">
                </div>
                
                <button type="submit" class="btn">Book Now</button>
            </form>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2>Why Choose SL Bus?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-clock"></i>
                    <h3>On Time Service</h3>
                    <p>Our buses depart and arrive on schedule, ensuring you reach your destination when you need to.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-rupee-sign"></i>
                    <h3>Affordable Fares</h3>
                    <p>Competitive pricing that makes travel accessible to everyone across Sri Lanka.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-shield-alt"></i>
                    <h3>Safe Travel</h3>
                    <p>Well-maintained buses and experienced drivers for a safe journey.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="popular-routes" id="popular-routes">
        <div class="container">
            <h2>Popular Routes</h2>
            <div class="routes-grid">
                <?php
                $popular_routes = "SELECT * FROM bus_routes LIMIT 4";
                $result = mysqli_query($conn, $popular_routes);
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="route-card">
                        <h3>Route '.$row['route_number'].'</h3>
                        <p><i class="fas fa-route"></i> '.$row['start_point'].' to '.$row['end_point'].'</p>
                        <p><i class="fas fa-clock"></i> '.$row['departure_time'].' - '.$row['arrival_time'].'</p>
                        <p><i class="fas fa-rupee-sign"></i> Rs. '.number_format($row['fare'], 2).'</p>
                    </div>';
                }
                ?>
            </div>
            <div class="center">
                <a href="routes.php" class="btn">View All Routes</a>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3>SL Bus</h3>
                    <p>Your trusted partner for bus travel across Sri Lanka. Book tickets online for a hassle-free journey.</p>
                </div>
                <div class="footer-col">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="routes.php">Bus Routes</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Contact Us</h3>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Bus Stand, Colombo 10, Sri Lanka</p>
                    <p><i class="fas fa-phone"></i> +94 11 234 5678</p>
                    <p><i class="fas fa-envelope"></i> info@slbus.lk</p>
                </div>
                <div class="footer-col">
                    <h3>Follow Us</h3>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; <?php echo date('Y'); ?> Sri Lanka Bus Ticketing System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>