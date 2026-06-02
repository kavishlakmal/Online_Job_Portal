<?php

include('config.php');

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    
    $delete_sql = "DELETE FROM job_applications WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        $delete_message = "Application deleted successfully!";
    } else {
        $delete_message = "Error deleting application: " . $conn->error;
    }
}


$sql = "SELECT * FROM job_applications";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OnlineJobs.lk</title>
    <link rel="stylesheet" href="styles/Page1_Style.css">
    <link rel="stylesheet" href="styles/EmployerDB_style.css">
    <link rel="stylesheet" href="styles/JobSeekerDB_style.css">
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

    <div class="hello">Hello!
        <p>Logged in AS : Employer</p>
        
    </div>

    <div class="btns">
        <a href="PostJob.php"><button >Post New Job</button></a>
        <a href="empDB.php"><button >Posted Jobs</button></a>
        <a href="joblisting.php"><button >Applications</button></a>
    </div>

    <center><h2 class="jobs">Recent Job Applications</h2>

    <?php if (isset($delete_message)) { echo "<p>$delete_message</p>"; } ?> 

    <table>
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row['first_name'] . "</td>
                <td>" . $row['last_name'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['phone'] . "</td>
                <td>" . $row['address'] . "</td>
                <td>
                    <a href='empDB applications.php?delete_id=" . $row['id'] . "'><button class='btn-delete'>Delete</button></a>
                    <a href='update_application.php?edit_id=" . $row['id'] . "'><button class='btn-update'>Update</button></a>
                </td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No applications found</td></tr>";
    }
    ?>
    </tbody>
</table>
</center>

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

<?php

$conn->close();
?>
