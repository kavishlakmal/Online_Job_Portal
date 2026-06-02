<?php

include('config.php');

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM recruiters WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_role'] = 'employer';
            
           
            header("Location: empDB.php");
            exit;
        } else {
            echo "Incorrect password!";
        }
    } else {
        
        echo "No account found with that email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OnlineJobs.lk - Employer Log In</title>
    <link rel="stylesheet" href="styles/log in.css">
</head>
<body>

    <img src="images/welcome.jpg" alt="Welcome to OnlineJobs.lk" class="welcome-image">
    
    <form action="emp login.php" method="POST">
        <div class="log-in-form">
            <input type="text" name="email" placeholder="Email" required>
        </div>
    
        <div class="log-in-form">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        
        <div class="reset">
            <a href="#">Forgot password?</a>
        </div>
        
        <button type="submit" class="btn">Employer Log In</button>

       
        <?php
        if (isset($error)) {
            echo "<p style='color: red;'>$error</p>";
        }
        ?>
    </form>
   
    <p class="instruction"> -Or Log in with-</p>
   
    <div class="accounts">
        <a href="#"><img src="images/icon-G.png" alt="Google"></a>
        <a href="#"><img src="images/icon-F.png" alt="Facebook"></a>
        <a href="#"><img src="images/icon-T.png" alt="Twitter"></a>
    </div>
    
    <p class="register"><i>Don't have an account? <a href="#">Sign up</a></i></p>
   
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
