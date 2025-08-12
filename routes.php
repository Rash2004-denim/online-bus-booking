<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Routes - SL Bus Ticketing System</title>
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

    <section class="routes-list">
        <div class="container">
            <h2>All Bus Routes</h2>
            <div class="search-box">
                <input type="text" id="route-search" placeholder="Search routes...">
                <button id="search-btn"><i class="fas fa-search"></i></button>
            </div>
            
            <div class="routes-table">
                <table>
                    <thead>
                        <tr>
                            <th>Route No.</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Via</th>
                            <th>Departure</th>
                            <th>Arrival</th>
                            <th>Fare (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM bus_routes ORDER BY start_point, end_point";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>{$row['route_number']}</td>
                                <td>{$row['start_point']}</td>
                                <td>{$row['end_point']}</td>
                                <td>{$row['via_cities']}</td>
                                <td>{$row['departure_time']}</td>
                                <td>{$row['arrival_time']}</td>
                                <td>".number_format($row['fare'], 2)."</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
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