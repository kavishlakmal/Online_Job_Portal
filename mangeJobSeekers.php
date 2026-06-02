<?php
include('config.php');

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM job_seekers WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $delete_id);
    $stmt_delete->execute();

    if ($stmt_delete->affected_rows > 0) {
        echo "Job seeker deleted successfully.";
    } else {
        echo "Error deleting job seeker.";
    }
}

// Fetch all job seekers
$sql = "SELECT * FROM job_seekers ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Job Seekers - OnlineJobs.lk</title>
    <link rel="stylesheet" href="styles/Page1_Style.css">
    <link rel="stylesheet" href="styles/EmployerDB_style.css">
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
    <p>Logged in AS : Admin</p>
</div>

<div class="btns">
        <a href="adminDB.php"><button>Manage Feedbacks</button></a>
        <a href="mangeJobSeekers.php"><button>Manage Job Seekers</button></a>
        <a href="manage_employers.php"><button>Manage Employers</button></a>
        <a href="manage_jobs.php"><button>Manage Job Postings</button></a>
    </div>

<center>
    <h2 class="jobs_txt">Manage Job Seekers</h2>

    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>DOB</th>
                <th>Interested Field</th>
                <th>Qualifications</th>
                <th>Experience</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['dob']); ?></td>
                    <td><?php echo htmlspecialchars($row['interested_field']); ?></td>
                    <td><?php echo htmlspecialchars($row['qualifications']); ?></td>
                    <td><?php echo htmlspecialchars($row['experience']); ?></td>
                    <td>
                        <!-- Update Button -->
                        <a href="update_job_seeker.php?id=<?php echo $row['id']; ?>"><button>Update</button></a>
                        
                        <!-- Delete Button -->
                        <a href="mangeJobSeekers.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this job seeker?');">
                            <button>Delete</button>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No job seekers found.</td>
                </tr>
            <?php endif; ?>
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
