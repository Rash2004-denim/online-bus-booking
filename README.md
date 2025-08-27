Bus Ticket Booking System

Overview:
This is a Bus Ticket Booking System developed using PHP, MySQL, and XAMPP.
It allows users to register, log in, view available bus routes, and make ticket bookings.
The admin (or database manager) can manage bus routes and monitor bookings through phpMyAdmin.

---

Technologies Used:

* Frontend: HTML, CSS, JavaScript
* Backend: PHP
* Database: MySQL (phpMyAdmin)
* Local Server: XAMPP
* Editor: Visual Studio Code

---

Project Structure:
ticket\_booking/
│-- config.php          (Database configuration & table creation)
│-- index.php           (Homepage / login or route display)
│-- register.php        (User registration)
│-- login.php           (User login)
│-- booking.php         (Ticket booking page)
│-- logout.php          (Logout functionality)
│-- css/                (Stylesheets)
│-- js/                 (JavaScript files)
│-- assets/             (Images / icons)
│-- README.txt          (Project documentation)

---

Database Setup:

1. Open phpMyAdmin ([http://localhost/phpmyadmin](http://localhost/phpmyadmin)).
2. Create a new database named:
   CREATE DATABASE ticket\_booking;
3. Import or run the SQL script below:

USE ticket\_booking;

CREATE TABLE users (
id INT AUTO\_INCREMENT PRIMARY KEY,
username VARCHAR(50) NOT NULL UNIQUE,
email VARCHAR(100) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
phone VARCHAR(15),
created\_at DATETIME DEFAULT CURRENT\_TIMESTAMP
);

CREATE TABLE bus\_routes (
id INT AUTO\_INCREMENT PRIMARY KEY,
route\_number VARCHAR(10) NOT NULL,
start\_point VARCHAR(50) NOT NULL,
end\_point VARCHAR(50) NOT NULL,
via\_cities TEXT,
departure\_time TIME NOT NULL,
arrival\_time TIME NOT NULL,
fare DECIMAL(10,2) NOT NULL
);

CREATE TABLE bookings (
id INT AUTO\_INCREMENT PRIMARY KEY,
user\_id INT,
route\_id INT,
travel\_date DATE NOT NULL,
seats INT NOT NULL,
total\_fare DECIMAL(10,2) NOT NULL,
booking\_date DATETIME DEFAULT CURRENT\_TIMESTAMP,
status ENUM('confirmed', 'cancelled') DEFAULT 'confirmed',
FOREIGN KEY (user\_id) REFERENCES users(id) ON DELETE CASCADE,
FOREIGN KEY (route\_id) REFERENCES bus\_routes(id) ON DELETE CASCADE
);

INSERT INTO bus\_routes (route\_number, start\_point, end\_point, via\_cities, departure\_time, arrival\_time, fare) VALUES
('100', 'Colombo', 'Kandy', 'Kadawatha, Warakapola', '08:00:00', '11:30:00', 350.00),
('101', 'Colombo', 'Galle', 'Panadura, Kalutara', '07:30:00', '10:00:00', 300.00),
('102', 'Colombo', 'Jaffna', 'Kurunegala, Anuradhapura, Vavuniya', '06:00:00', '14:00:00', 1200.00),
('103', 'Kandy', 'Nuwara Eliya', 'Peradeniya, Gampola', '09:00:00', '11:00:00', 250.00),
('104', 'Colombo', 'Trincomalee', 'Kandy, Dambulla, Habarana', '07:00:00', '13:00:00', 800.00);

---

How to Run the Project:

1. Install XAMPP.
2. Place the project folder (ticket\_booking) inside the htdocs directory.
   Example: C:\xampp\htdocs\ticket\_booking
3. Start Apache and MySQL from the XAMPP Control Panel.
4. Set up the database in phpMyAdmin as described above.
5. Open your browser and go to:
   [http://localhost/ticket\_booking](http://localhost/ticket_booking)

---

Features:

* User Registration & Login
* Browse available bus routes
* Book tickets with seat selection
* View booking history
* Cancel bookings
* Admin/DB can manage routes in phpMyAdmin

---

Credentials:

* Database User: root
* Password: (empty by default in XAMPP)
* Database Name: ticket\_booking

---

Notes:

* Make sure to enable MySQLi extension in XAMPP.
* Passwords are stored using hashed format for security.
* Timezone is set to Asia/Colombo (Sri Lanka) in config.php.


