<?php
include('config.php'); 

// Check if the job ID is provided
if (isset($_GET['id'])) {
    $job_id = $_GET['id'];

    // Fetch the current data of the job
    $sql = "SELECT * FROM jobs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $job_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if job exists
    if ($result->num_rows === 0) {
        die("Job not found.");
    }

    $job = $result->fetch_assoc();
}

// Handle form submission for updates
if (isset($_POST['update'])) {
    $job_title = $_POST['job_title'];
    $company = $_POST['company'];
    $workplace_type = $_POST['workplace_type'];
    $job_location = $_POST['job_location'];
    $responsibilities = $_POST['responsibilities'];
    $qualifications = $_POST['qualifications'];

    // Update the job details
    $sql_update = "UPDATE jobs SET job_title = ?, company = ?, workplace_type = ?, job_location = ?, responsibilities = ?, qualifications = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssssssi", $job_title, $company, $workplace_type, $job_location, $responsibilities, $qualifications, $job_id);
    if ($stmt_update->execute()) {
        echo "Job updated successfully.";
    } else {
        echo "Error updating job: " . $conn->error;
    }

    $stmt_update->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Job - OnlineJobs.lk</title>
    <link rel="stylesheet" href="styles/stylep.css">
</head>
<body>
<div class="job-form">
    <h1>Update Job Posting</h1>
    <form action="update_job.php?id=<?php echo $job_id; ?>" method="POST">
        <label for="job-title">Job Title</label><br>
        <input type="text" id="job-title" name="job_title" value="<?php echo htmlspecialchars($job['job_title']); ?>" required><br><br>

        <label for="company">Company</label><br>
        <input type="text" id="company" name="company" value="<?php echo htmlspecialchars($job['company']); ?>" required><br><br>

        <label for="workplace-type">Workplace Type</label><br>
        <select id="workplace-type" name="workplace_type" required>
            <option value="On-Site" <?php echo $job['workplace_type'] == 'On-Site' ? 'selected' : ''; ?>>On-Site</option>
            <option value="Remote" <?php echo $job['workplace_type'] == 'Remote' ? 'selected' : ''; ?>>Remote</option>
            <option value="Hybrid" <?php echo $job['workplace_type'] == 'Hybrid' ? 'selected' : ''; ?>>Hybrid</option>
        </select><br><br>

        <label for="job-location">Job Location</label><br>
        <input type="text" id="job-location" name="job_location" value="<?php echo htmlspecialchars($job['job_location']); ?>" required><br><br>

        <label for="responsibilities">Responsibilities</label><br>
        <textarea id="responsibilities" name="responsibilities" rows="4" required><?php echo htmlspecialchars($job['responsibilities']); ?></textarea><br><br>

        <label for="qualifications">Qualifications</label><br>
        <textarea id="qualifications" name="qualifications" rows="4" required><?php echo htmlspecialchars($job['qualifications']); ?></textarea><br><br>

        <button type="submit" name="update">Update</button>
    </form>
</div>
</body>
</html>
