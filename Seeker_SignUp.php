<?php
include('config.php'); 

if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $dof = $_POST['dof'];
    $gender = $_POST['gender'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 
    $interested_field = $_POST['interested_field'];
    $qualifications = $_POST['qualifications'];
    $experience = $_POST['experience'];

    $sql = "INSERT INTO job_seekers (first_name, last_name, email, dob, password, interested_field, qualifications, experience)
            VALUES ('$fname', '$lname', '$email', '$dof', '$password', '$interested_field', '$qualifications', '$experience')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: SeekerDB.php");
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
    <link rel="stylesheet" href="styles/styleSignJBS.css">
    <script src="js/SignUpJBS.js"></script>
</head>
<body>
<div class="signup_jbSk">
    <center>
    <form action="Seeker_SignUp.php" method="POST">
        <h1>Sign Up As Job Seeker</h1>
        <label>First Name</label>
        <input type="text" id="fname" name="fname" placeholder="Enter Your First Name" required>

        <label>Last Name</label>
        <input type="text" id="lname" name="lname" placeholder="Enter Your Last Name" required>

        <label>Email</label>
        <input type="email" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Enter Your Email" required>

        <label>Date Of Birth</label>
        <input type="date" id="dof" name="dof">


        <label>Password</label>
        <input type="password" id="pw" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Enter New Password" required>

        <label>Confirm Password</label>
        <input type="password" id="rpw" name="re_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Confirm Your Password" required>

        <label>Interested Field</label>
        <input type="text" id="itf" name="interested_field">

        <label>Qualifications</label>
        <textarea id="qualification" name="qualifications" rows="4" required></textarea>

        <label>Experience</label>
        <textarea id="experience" name="experience" rows="4"></textarea>

        <input type="checkbox" id="cbox" onclick="enableButton()" required>I agree to privacy policy and Terms & Conditions<br><br>

        <input type="submit" id="sub" name="submit" value="Sign Up">
    </form>
    </center>
</div>
</body>
</html>
