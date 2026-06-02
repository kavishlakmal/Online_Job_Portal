<?php
include('config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact_messages (name, email, phone, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $phone, $message);

    if ($stmt->execute()) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="styles/contactstyles.css">
</head>

<body>
<header>
        <div class="top-bar">
            <img src="images/logo.png" alt="OnlineJobs.lk Logo" class="logo">
            <div class="header-title">
                <center><h1>OnlineJobs.lk</h1>
                <p>Find Your Dream Job</p></center>
            </div>
            <div class="auth-buttons">
                <button onclick="location.href='log in page.php'">Job Seeker Login</button><br><br>
                <button onclick="location.href='emp login.php'">Employer Login</button>
            </div>
        </div>
        <nav class="menu">
            <ul>
                <li><a href="Home page.html">Home</a></li>
                <li><a href="jobs.php">Jobs</a></li>
                <li><a href="manage_jobs.php">Dashboard</a></li>
                <li><a href="faqs.html">FAQs</a></li>
                <li><a href="Contact Us.php">Contact Us</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="left-side">
            <h2>Contact Us</h2>
            <p>Have a question or need help? Contact us through the form below,<br>and we'll get back to you shortly. We're here to make your job search <br>or hiring process easier!</p>
            <div class="c">
                <div class="details">
                    <img src="images/location.png" height="30px"><br>
                    <p><b>Address</b> <br> Galle Road <br> Colombo 5</p>
                </div>

                <div class="details">
                    <img src="images/phone.png" height="30px">
                    <p><b>Phone</b> <br> +112258457</p>
                </div>

                <div class="details">
                    <img src="images/email.png" height="30px">
                    <p><b>Email</b> <br> onlinejobs@gmail.com</p>
                </div>
            </div>
        </div>

        <div class="right-side">
            <form action="Contact Us.php" method="POST" id="contact_form"> 
                <label for="name">Name</label><br>
                <input type="text" id="name" name="name" placeholder="Your Name" required><br> 
    
                <label for="email">Email</label><br>
                <input type="text" id="email" name="email" placeholder="Your Email" required><br> 
    
                <label for="phone">Phone Number</label><br> 
                <input type="tel" id="phone" name="phone" placeholder="Your Phone Number" required><br>
    
                <label for="message">Message</label><br>
                <textarea id="message" name="message" rows="5" placeholder="Type Your message" required></textarea><br> 
    
                <input type="submit" class="b" value="Submit"> 
            </form>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <a href="Abot us page.html">About Us</a>
            <a href="Terms&Condition.php">Terms & Conditions</a>
            <a href="Privacy policy page.html">Privacy Policy</a><br><br>
            <div class="social-icons">
                <a href="#"><img src="images/linkedin.png" alt="LinkedIn"></a>
                <a href="#"><img src="images/facebook.png" alt="Facebook"></a>
                <a href="#"><img src="images/twitter.png" alt="Twitter"></a>
                <a href="#"><img src="images/instagram.png" alt="Instagram"></a>
            </div>
        </div>
        <p>2024 OnlineJobs.lk - All Rights Reserved</p>
		
		
    </footer>
</body>

</html>
