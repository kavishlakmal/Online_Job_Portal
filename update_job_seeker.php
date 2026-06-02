<?php
include('config.php');

// Check if job seeker ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the job seeker's current details from the database
    $sql = "SELECT * FROM job_seekers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $job_seeker = $result->fetch_assoc();
    } else {
        echo "Job seeker not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

// Handle form submission for updating job seeker details
if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $dof = $_POST['dof'];
    $interested_field = $_POST['interested_field'];
    $qualifications = $_POST['qualifications'];
    $experience = $_POST['experience'];

    // Update query to save the changes
    $sql_update = "UPDATE job_seekers SET first_name = ?, last_name = ?, email = ?, dob = ?, interested_field = ?, qualifications = ?, experience = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sssssssi", $fname, $lname, $email, $dof, $interested_field, $qualifications, $experience, $id);

    if ($stmt_update->execute()) {
        echo "Job seeker details updated successfully.";
        // Redirect back to the manage page after update (optional)
        header("Location: mangeJobSeekers.php");
        exit();
    } else {
        echo "Error updating job seeker details: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Job Seeker</title>
    <link rel="stylesheet" href="styles/styleSignJBS.css">
</head>
<body>
<div class="signup_jbSk">
    <center>
    <form action="update_job_seeker.php?id=<?php echo $id; ?>" method="POST">
        <h1>Update Job Seeker Details</h1>

        <label>First Name</label>
        <input type="text" name="fname" value="<?php echo htmlspecialchars($job_seeker['first_name']); ?>" required>

        <label>Last Name</label>
        <input type="text" name="lname" value="<?php echo htmlspecialchars($job_seeker['last_name']); ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($job_seeker['email']); ?>" required>

        <label>Date Of Birth</label>
        <input type="date" name="dof" value="<?php echo htmlspecialchars($job_seeker['dob']); ?>">

        <label>Interested Field</label>
        <input type="text" name="interested_field" value="<?php echo htmlspecialchars($job_seeker['interested_field']); ?>">

        <label>Qualifications</label>
        <textarea name="qualifications" rows="4" required><?php echo htmlspecialchars($job_seeker['qualifications']); ?></textarea>

        <label>Experience</label>
        <textarea name="experience" rows="4"><?php echo htmlspecialchars($job_seeker['experience']); ?></textarea>

        <input type="submit" name="submit" value="Update">
    </form>
    </center>
</div>
</body>
</html>
