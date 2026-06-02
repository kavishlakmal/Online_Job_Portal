<?php
include('config.php'); 

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM jobs WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $delete_id);
    $stmt_delete->execute();

    if ($stmt_delete->affected_rows > 0) {
        echo "Job deleted successfully.";
    } else {
        echo "Error deleting job.";
    }
}

// Fetch all jobs
$sql = "SELECT * FROM jobs ORDER BY id DESC";
$result = $conn->query($sql);

// Check for query execution error
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Jobs - OnlineJobs.lk</title>
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
    <p>Logged in AS : Job Seeker</p>
</div>
<div class="btns">
        <a href="adminDB.php"><button>Manage Feedbacks</button></a>
        <a href="mangeJobSeekers.php"><button>Manage Job Seekers</button></a>
        <a href="manage_employers.php"><button>Manage Employers</button></a>
        <a href="manage_jobs.php"><button>Manage Job Postings</button></a>
    </div>


<center>
    <h2 class="jobs_txt">Manage Jobs</h2>

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
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['job_title']); ?></td>
                    <td><?php echo htmlspecialchars($row['company']); ?></td>
                    <td><?php echo htmlspecialchars($row['workplace_type']); ?></td>
                    <td><?php echo htmlspecialchars($row['job_location']); ?></td>
                    <td><?php echo htmlspecialchars($row['responsibilities']); ?></td>
                    <td><?php echo htmlspecialchars($row['qualifications']); ?></td>
                    <td>
                        <!-- Update Button -->
                        <a href="update_job.php?id=<?php echo $row['id']; ?>"><button>Update</button></a>
                        
                        <!-- Delete Button -->
                        <a href="manage_jobs.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this job?');">
                            <button>Delete</button>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No jobs found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</center>

<footer>
    <div class="footer-content">
        <a href="About us page.html">About Us</a>
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
