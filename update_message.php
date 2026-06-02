<?php
include('config.php');

// Check if the message ID is provided
if (isset($_GET['id'])) {
    $message_id = $_GET['id'];

    // Fetch the current data of the message
    $sql = "SELECT * FROM contact_messages WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $message_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the message exists
    if ($result->num_rows === 0) {
        die("Message not found.");
    }

    $message = $result->fetch_assoc();
}

// Handle form submission for updates
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message_content = $_POST['message'];

    // Update the message details
    $sql_update = "UPDATE contact_messages SET name = ?, email = ?, phone = ?, message = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssssi", $name, $email, $phone, $message_content, $message_id);

    if ($stmt_update->execute()) {
        echo "Message updated successfully.";
        header("Location: manage_feedbacks.php");
        exit();
    } else {
        echo "Error updating message: " . $conn->error;
    }

    $stmt_update->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Contact Message</title>
    <link rel="stylesheet" href="styles/stylep.css">
</head>
<body>
<div class="job-form">
    <h1>Update Contact Message</h1>
    <form action="update_message.php?id=<?php echo $message_id; ?>" method="POST">
        <label for="name">Name</label><br>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($message['name']); ?>" required><br><br>

        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($message['email']); ?>" required><br><br>

        <label for="phone">Phone</label><br>
        <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($message['phone']); ?>" required><br><br>

        <label for="message">Message</label><br>
        <textarea id="message" name="message" rows="4" required><?php echo htmlspecialchars($message['message']); ?></textarea><br><br>

        <button type="submit" name="update">Update</button>
    </form>
</div>
</body>
</html>
