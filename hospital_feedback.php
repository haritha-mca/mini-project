<?php
session_start();
include("config.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$error = '';
$success = '';

if (isset($_POST['submit'])) {
    $overall_experience = $_POST['overall_experience'];
    $staff_communication = $_POST['staff_communication'];
    $facility_cleanliness = $_POST['facility_cleanliness'];
    $overall_care = $_POST['overall_care'];
    $additional_comments = $_POST['additional_comments'];

    $stmt = $con->prepare("INSERT INTO hospital_feedback (user_id, overall_experience, staff_communication, facility_cleanliness, overall_care, additional_comments) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $user_id, $overall_experience, $staff_communication, $facility_cleanliness, $overall_care, $additional_comments);

    if ($stmt->execute()) {
        $success = "Feedback submitted successfully!";
    } else {
        $error = "Error: " . $con->error;
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Hospital Feedback</title>
    <style>
            body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            max-width: 100%;
            position: relative;
            z-index: 1;
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #3A1078;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-group .radio-group {
            display: flex;
            flex-direction: column;
        }
        .form-group .radio-group label {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
            cursor: pointer;
        }

        .form-group .radio-group input[type="radio"] {
            margin-right: 10px;
        }

        .form-group textarea {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .message {
            margin-top: 20px;
            text-align: center;
        }
        .message.success {
            color: green;
        }

        .message.error {
            color: red;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #5DEBD7;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #3A1078;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form method="post">
            <div class="form-group">
                <label for="overall_experience">1. Rate the overall quality of services provided by the hospital:</label>
                <div class="radio-group">
                    <label><input type="radio" name="overall_experience" value="Good" required> Good</label>
                    <label><input type="radio" name="overall_experience" value="Average"> Average</label>
                    <label><input type="radio" name="overall_experience" value="Poor"> Poor</label>
                </div>
            </div>
            <div class="form-group">
                <label for="staff_communication">2. Rate the communication and responsiveness of the hospital staff:</label>
                <div class="radio-group">
                 
                    <label><input type="radio" name="staff_communication" value="Good"> Good</label>
                    <label><input type="radio" name="staff_communication" value="Average"> Average</label>
                    <label><input type="radio" name="staff_communication" value="Poor"> Poor</label>
                </div>
            </div>
            <div class="form-group">
                <label for="facility_cleanliness">3. Rate the cleanliness and maintenance of hospital facilities:</label>
                <div class="radio-group">
                   
                    <label><input type="radio" name="facility_cleanliness" value="Good"> Good</label>
                    <label><input type="radio" name="facility_cleanliness" value="Average"> Average</label>
                    <label><input type="radio" name="facility_cleanliness" value="Poor"> Poor</label>
                </div>
            </div>
          
            <div class="form-group">
                <label for="overall_care">4. Rate your overall care experience at the hospital:</label>
                <div class="radio-group">
                   
                    <label><input type="radio" name="overall_care" value="Satisfied"> Satisfied</label>
                    <label><input type="radio" name="overall_care" value="Neutral"> Neutral</label>
                    <label><input type="radio" name="overall_care" value="Dissatisfied"> Dissatisfied</label>
                </div>
            </div>
            <div class="form-group">
                <label for="additional_comments">5. Do you have any additional comments or suggestions:</label>
                <textarea id="additional_comments" name="additional_comments" rows="4" required></textarea>
            </div>
            <button type="submit" name="submit">Submit Feedback</button>
            <div class="message <?php echo $success ? 'success' : ($error ? 'error' : ''); ?>">
                <?php if ($success) echo htmlspecialchars($success); ?>
                <?php if ($error) echo htmlspecialchars($error); ?>
            </div>
        </form>
    </div>
</body>
</html>
