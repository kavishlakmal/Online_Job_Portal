<?php

include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $job_title = $_POST['job_title'];
    $company = $_POST['company'];
    $workplace_type = $_POST['workplace_type'];
    $job_location = $_POST['job_location'];
    $responsibilities = $_POST['responsibilities'];
    $qualifications = $_POST['qualifications'];

    
    $sql = "INSERT INTO jobs (job_title, company, workplace_type, job_location, responsibilities, qualifications)
            VALUES ('$job_title', '$company', '$workplace_type', '$job_location', '$responsibilities', '$qualifications')";

    if ($conn->query($sql) === TRUE) {
        echo "New job posted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Job</title>
    <link rel="stylesheet" href="styles/stylep.css">
</head>
<body>
    <div class="job-form">
        <h1>Post a New Job</h1>
        <form action="PostJob.php" method="POST">
            <label for="job-title">Job Title</label><br>
            <input type="text" id="job-title" name="job_title" placeholder="Software Engineer" required><br><br>

            <label for="company">Company</label><br>
            <input type="text" id="company" name="company" placeholder="MS Holding Pvt" required><br><br>

            <label for="workplace-type">Workplace Type</label><br>
            <select id="workplace-type" name="workplace_type" required>
                <option>On-Site</option>
                <option>Remote</option>
                <option>Hybrid</option>
            </select><br><br>

            <label for="job-location">Job Location</label><br>
            <input type="text" id="job-location" name="job_location" placeholder="Colombo, Western Province, Sri Lanka" required><br><br>

            <label for="responsibilities">Responsibilities</label><br>
            <textarea id="responsibilities" name="responsibilities" rows="4" required></textarea><br><br>

            <label for="qualifications">Qualifications</label><br>
            <textarea id="qualifications" name="qualifications" rows="4" required></textarea><br><br>

            <button type="submit">Post</button>
        </form>
    </div>
</body>
</html>
