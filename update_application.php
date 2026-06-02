<?php
include('config.php');

if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];

    // Fetch current values from the database
    $sql = "SELECT * FROM job_applications WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['address'];
    } else {
        echo "Application not found!";
        exit();
    }
}

if (isset($_POST['update'])) {
    $edit_id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Update the database with the new values
    $update_sql = "UPDATE job_applications SET first_name=?, last_name=?, email=?, phone=?, address=? WHERE id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sssssi", $first_name, $last_name, $email, $phone, $address, $edit_id);

    if ($stmt->execute()) {
        echo "Application updated successfully!";
        header("Location: empDB applications.php"); // Redirect after successful update
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Application</title>
    <link rel="stylesheet" href="styles/stylep.css">
    <link rel="stylesheet" href="styles/Page1_Style.css">
    
    
</head>
<body>
    <h2>Update Job Application</h2>
    <form action="update_application.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $edit_id; ?>">
        <label>First Name:</label>
        <input type="text" name="first_name" value="<?php echo $first_name; ?>" required><br>

        <label>Last Name:</label>
        <input type="text" name="last_name" value="<?php echo $last_name; ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $email; ?>" required><br>

        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo $phone; ?>" required><br>

        <label>Address:</label>
        <textarea name="address" rows="4" required><?php echo $address; ?></textarea><br>

        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
