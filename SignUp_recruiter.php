<?php
include('config.php'); 

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $dob = $_POST['dof'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $company_name = $_POST['companyN'];
    $company_address = $_POST['companyN'];

    
    $sql = "INSERT INTO recruiters (first_name, last_name, email, dob, password, company_name, company_address)
            VALUES ('$fname', '$lname', '$email', '$dob', '$password', '$company_name', '$company_address')";

    if ($conn->query($sql) === TRUE) {
        echo "New recruiter record created successfully";
        header("Location: empDB.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles/styleSignRCT.css">
</head>
<body>
<div class="signup_recruiter">
    <center>
    <form action="signup_recruiter.php" method="POST">
        <h1>Sign Up As Recruiter</h1>
        <label>First Name</label>
        <input type="text" id="fname" name="fname" placeholder="Enter Your First Name" required>

        <label>Last Name</label>
        <input type="text" id="lname" name="lname" placeholder="Enter Your Last Name" required>

        <label>Email</label>
        <input type="email" id="email" name="email" placeholder="Enter Your Email" required>

        <label>Date Of Birth</label>
        <input type="date" id="dof" name="dof">

        <label>Password</label>
        <input type="password" id="pw" name="password" placeholder="Enter New Password" required>

        <label>Company Name</label>
        <input type="text" id="companyN" name="companyN" required>

        <label>Company Address</label>
        <textarea id="companyN" name="companyN" rows="4" required></textarea>

        <input type="checkbox" id="cbox" required>I agree to privacy policy and Terms&Conditions<br><br>
        <input type="submit" id="sub" name="submit" value="Sign Up">
    </form>
    </center>
</div>
</body>
</html>