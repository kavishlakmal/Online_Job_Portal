<?php
include('config.php');

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM contact_messages WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $delete_id);
    $stmt_delete->execute();

    if ($stmt_delete->affected_rows > 0) {
        echo "Message deleted successfully.";
    } else {
        echo "Error deleting message.";
    }
}

// Fetch all contact messages
$sql = "SELECT * FROM contact_messages ORDER BY id DESC";
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
    <title>Manage Contact Messages - OnlineJobs.lk</title>
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

<center>
    <h2 class="jobs_txt">Manage Contact Messages</h2>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['message']); ?></td>
                    <td>
                        <!-- Delete Button -->
                        <a href="manage_feedbacks.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this message?');">
                            <button type="button">Delete</button>
                        </a>
                        <!-- Update Button -->
                        <a href="update_message.php?id=<?php echo $row['id']; ?>">
                            <button type="button">Update</button>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No messages found.</td>
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
            <a href="#"><img src="
