<?php
include('config.php'); 

// Check if the recruiter ID is provided
if (isset($_GET['id'])) {
    $recruiter_id = $_GET['id'];

    // Fetch the current data of the recruiter
    $sql = "SELECT * FROM recruiters WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $recruiter_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if recruiter exists
    if ($result->num_rows === 0) {
        die("Recruiter not found.");
    }

    $recruiter = $result->fetch_assoc();
}

// Handle form submission for updates
if (isset($_POST['update'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $dob = $_POST['dof'];
    $company_name = $_POST['companyN'];
    $company_address = $_POST['company_address'];

    // Update the recruiter details
    $sql_update = "UPDATE recruiters SET first_name = ?, last_name = ?, email = ?, dob = ?, company_name = ?, company_address = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sssssii", $fname, $lname, $email, $dob, $company_name, $company_address, $recruiter_id);
    if ($stmt_update->execute()) {
        echo "Recruiter updated successfully.";
        header("Location: manage_employers.php");
        exit();
    } else {
        echo "Error updating recruiter: " . $conn->error;
    }

    $stmt_update->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Recruiter - OnlineJobs.lk</title>
    <link rel="stylesheet" href="styles/styleSignRCT.css">
</head>
<body>
<div class="signup_recruiter">
    <center>
    <form action="update_recruiter.php?id=<?php echo $recruiter_id; ?>" method="POST">
        <h1>Update Recruiter Information</h1>
        <label>First Name</label>
        <input type="text" name="fname" value="<?php echo htmlspecialchars($recruiter['first_name']); ?>" required>

        <label>Last Name</label>
        <input type="text" name="lname" value="<?php echo htmlspecialchars($recruiter['last_name']); ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($recruiter['email']); ?>" required>

        <label>Date Of Birth</label>
        <input type="date" name="dof" value="<?php echo htmlspecialchars($recruiter['dob']); ?>">

        <label>Company Name</label>
        <input type="text" name="companyN" value="<?php echo htmlspecialchars($recruiter['company_name']); ?>" required>

        <label>Company Address</label>
        <textarea name="company_address" rows="4" required><?php echo htmlspecialchars($recruiter['company_address']); ?></textarea>

        <input type="submit" name="update" value="Update">
    </form>
    </center>
</div>
</body>
</html>
