<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

$user_username = $_SESSION['user_username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Feedback - MedAlert Access System</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-y: auto;
            background: url('assets/images/feedback.jpg') no-repeat center center fixed; /* Replace with your image path */
            background-size: cover;
        }

        .feedback-container {
            
            padding: 30px;
            border-radius: 8px;
           
            text-align: center;
            width: 400px;
        }

        .feedback-container h2 {
            margin-bottom: 20px;
        }

        .feedback-container a {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            background-color: #1679AB;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
            transition: background-color 0.3s;
            width: 50%; /* Full width */
        }

        .feedback-container a:hover {
            background-color: #125a7b;
        }

        .logout-button {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            background-color: #f44336; /* Red color for logout */
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .logout-button:hover {
            background-color: #c62828;
        }
    </style>
</head>
<body>
    <div class="feedback-container">
        <h2>Provide Your Feedback</h2>
        <a href="admin_feedback.php?type=admin" aria-label="Give feedback to Admin">Give Feedback to Admin</a>
        <a href="hospital_feedback.php?type=hospital" aria-label="Give feedback to Hospital">Give Feedback to Hospital</a>
        <a href="doctor_feedback.php?type=doctor" aria-label="Give feedback to Doctor">Give Feedback to Doctor</a>
       
    </div>
</body>
</html>
