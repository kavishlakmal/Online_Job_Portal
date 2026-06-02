<?php
// Include database configuration file
include('config.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Insert form data into the database
    $sql = "INSERT INTO job_applications (first_name, last_name, email, phone, address) 
            VALUES ('$fname', '$lname', '$email', '$phone', '$address')";

    if ($conn->query($sql) === TRUE) {
        $message = "Application submitted successfully!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application</title>
    <link rel="stylesheet" href="styles/styleJobApplication.css">
</head>
<body>
<div class="job_application">
    <center>
        <form action="jobApplication.php" method="POST">
            <h1>Job Application</h1>
            
            <?php if (isset($message)) { echo "<p>$message</p>"; } ?> <!-- Display submission message -->
            
            <label>First Name</label>
            <input type="text" id="fname" name="fname" placeholder="Enter Your First Name" required>

            <label>Last Name</label>
            <input type="text" id="lname" name="lname" placeholder="Enter Your Last Name" required>

            <label>Contact Email</label>
            <input type="email" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Enter Your Email" required>

            <label>Phone Number</label>
            <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" placeholder="077XXXXXXX" required>

            <label>Address</label>
            <textarea id="address" name="address" rows="4" placeholder="Enter Your Address" required></textarea><br>

            <input type="submit" value="Apply Now">
        </form>
    </center>
</div>
</body>
</html>
