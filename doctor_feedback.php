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
    $expertise_rating = $_POST['expertise_rating'];
    $communication_rating = $_POST['communication_rating'];
    $care_rating = $_POST['care_rating'];
    $concerns_addressed = $_POST['concerns_addressed'];
    $additional_comments = $_POST['additional_comments'];

    $stmt = $con->prepare("INSERT INTO doctor_feedback (user_id, feedback_type, expertise_rating, communication_rating, care_rating, concerns_addressed, additional_comments) VALUES (?, 'Doctor', ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $user_id, $expertise_rating, $communication_rating, $care_rating, $concerns_addressed, $additional_comments);

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
    <title>Submit Doctor Feedback</title>
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
                <label for="expertise_rating">1. Rate the doctor's expertise:</label>
                <div class="radio-group">
                    <label><input type="radio" name="expertise_rating" value="Good" required> Good</label>
                    <label><input type="radio" name="expertise_rating" value="Average"> Average</label>
                    <label><input type="radio" name="expertise_rating" value="Poor"> Poor</label>
                </div>
            </div>
            <div class="form-group">
                <label for="communication_rating">2. Rate the doctor's communication skills:</label>
                <div class="radio-group">
                    <label><input type="radio" name="communication_rating" value="Good" required> Good</label>
                    <label><input type="radio" name="communication_rating" value="Average"> Average</label>
                    <label><input type="radio" name="communication_rating" value="Poor"> Poor</label>
                </div>
            </div>
            <div class="form-group">
                <label for="care_rating">3. Rate the overall care provided by the doctor:</label>
                <div class="radio-group">
                    <label><input type="radio" name="care_rating" value="Satisfied" required> Satisfied</label>
                    <label><input type="radio" name="care_rating" value="Neutral"> Neutral</label>
                    <label><input type="radio" name="care_rating" value="Dissatisfied"> Dissatisfied</label>
                </div>
            </div>
            <div class="form-group">
                <label for="concerns_addressed">4. Did the doctor address all your concerns and questions during your appointment?</label>
                <div class="radio-group">
                    <label><input type="radio" name="concerns_addressed" value="Yes, completely" required> Yes, completely</label>
                    <label><input type="radio" name="concerns_addressed" value="Yes, partially"> Yes, partially</label>
                    <label><input type="radio" name="concerns_addressed" value="No"> No</label>
                </div>
            </div>
            <div class="form-group">
                <label for="additional_comments">5. Do you have any additional comments or suggestions?</label>
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
