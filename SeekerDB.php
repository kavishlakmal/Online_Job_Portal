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


$sql = "SELECT * FROM jobs";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Seeker Dashboard</title>
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
        <p>Logged in AS : Job Seeker</p>
        
    </div>

    <a href="SeekerDB.php"><button >Applied Jobs</button></a>
        <a href="manage_feedbacks.php"><button >Sent Feedbacks</button></a>

   

    <center><h2 class="jobs_txt">Applied Jobs</h2>

    <?php if (isset($delete_message)) { echo "<p>$delete_message</p>"; } ?>

    <table>
        <thead>
            <tr>
                <th>Job Title</th>
                <th>Company</th>
                <th>Workplace Type</th>
                <th>Job Location</th>
                <th>Responsibilities</th>
                <th>Qualifications</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row['job_title'] . "</td>
                    <td>" . $row['company'] . "</td>
                    <td>" . $row['workplace_type'] . "</td>
                    <td>" . $row['job_location'] . "</td>
                    <td>" . $row['responsibilities'] . "</td>
                    <td>" . $row['qualifications'] . "</td>
                    <td>
                        <a href='empDB.php?delete_id=" . $row['id'] . "'><button class='btn-delete'>Delete</button></a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No jobs found</td></tr>";
        }
        ?>
        </tbody>
    </table></center>

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
