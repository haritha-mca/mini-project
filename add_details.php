<?php
session_start();
include("config.php"); // Ensure this file has your database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

$message = ""; // Initialize an empty message variable

// Process form submission
if (isset($_POST['submit'])) {
    $additional_details = $_POST['additional_details']; // Get the additional details from the form
    
    // Prepare and execute the query to update the patient's details
    $sql = "
        UPDATE patients 
        SET additional_details = ? 
        WHERE user_id = ? 
    ";

    $stmt = $con->prepare($sql);
    if (!$stmt) {
        die('Prepare failed: ' . htmlspecialchars($con->error));
    }

    $stmt->bind_param("si", $additional_details, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $message = " Details have been added.";
    } else {
        $message = "Something went wrong. Please try again.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Details - MedAlert Access System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            height: 100vh;
            overflow-y: auto; /* Enable vertical scrolling */
        }

        nav {
            width: 200px; /* Width of the sidebar */
            background-color: #1679AB; /* Navigation background color */
            color: white;
            height: 100vh; /* Full height of the viewport */
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            box-sizing: border-box;
            z-index: 1000; /* Ensure the sidebar is above other content */
        }

        nav h2 {
            margin-top: 0;
            margin-bottom: 15px;
            font-family: 'Times New Roman', Times, serif;
        }

        nav a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 3px;
            transition: background-color 0.3s;
            font-family: 'Times New Roman', Times, serif;
        }

        nav a:hover {
            background-color: #125a7b; /* Hover effect */
        }

        .content {
            margin-left: 200px; /* Adjusted to match the sidebar width */
            padding: 20px;
            width: calc(100% - 200px); /* Adjusted to match the sidebar width */
            box-sizing: border-box;
        }

        header {
            background-color: #5DEBD7; /* Header background color */
            color: #3A1078;
            padding: 20px;
            width: 100%;
            box-sizing: border-box;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        header h1 {
            margin: 0;
            font-family: 'Times New Roman', Times, serif;
        }

        main {
            margin-top: 20px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            font-weight: bold;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
            font-size: 16px;
        }

        button {
            background-color: #1679AB; /* Button background color */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #125a7b; /* Hover effect */
        }

        .message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
    <nav>
        <h2>User Menu</h2>
        <a href="user_dashboard.php">Dashboard</a>
        <a href="view_details.php">View Details</a>
        <a href="add_details.php">Add Details</a>
        <a href="feedback.php">Feedback</a>
        <a href="logout1.php">Logout</a>
    </nav>
    <div class="content">
        <header>
            <h1>Medalert Access System</h1>
        </header>
        <main>
            <h2>Add Additional Details</h2>

            <?php if (!empty($message)): ?>
                <div class="message">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <label for="additional_details">Additional Details:</label>
                <textarea name="additional_details" id="additional_details" rows="5" cols="50" required></textarea>
                <br>
                <button type="submit" name="submit">Add Details</button>
            </form>
        </main>
    </div>
</body>
</html>
