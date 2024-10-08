<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['hospital_id'])) {
    header('Location: hospital_login.php'); // Redirect to login page if not logged in
    exit;
}

include('config.php'); // Include your database connection file

// Fetch hospital name from the database
$hospital_id = $_SESSION['hospital_id'];
$sql = "SELECT name FROM hospitals WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $hospital_id);
$stmt->execute();
$stmt->bind_result($hospital_name);
$stmt->fetch();
$stmt->close();

// Close the database connection
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Dashboard - MedAlert Access System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* General body styles */
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            height: 100vh;
            overflow-y: auto; /* Enable vertical scrolling */
            background: url('assets/images/hospital.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        /* Sidebar styles */
        nav {
            width: 200px; /* Width of the sidebar */
            background-color: #1679AB; /* Updated navigation background color */
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
            background-color: #125a7b; /* Slightly darker color for hover effect */
        }

        /* Content container styles */
        .content {
            margin-left: 200px; /* Adjusted to match the sidebar width */
            padding: 0;
            width: calc(100% - 200px); /* Adjusted to match the sidebar width */
            box-sizing: border-box;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header styles */
        header {
            background-color: #5DEBD7; /* Slightly lighter shade for the header */
            color: #3A1078;
            padding: 20px;
            width: 100%; /* Full width of the content area */
            box-sizing: border-box; /* Include padding in the width calculation */
            position: sticky; /* Stick the header to the top */
            top: 0; /* Stick the header to the top */
            z-index: 1000; /* Ensure the header is above other content */
        }

        /* Header title */
        header h1 {
            margin: 0;
            font-family: 'Times New Roman', Times, serif;
        }

        /* Main content styles */
        main {
            flex: 1; /* Allow the main content to grow and fill remaining space */
            position: relative; /* Positioning context for absolute children */
        }

        .dashboard-image {
            width: 100%;
            height: auto;
            object-fit: cover;
            display: block; /* Ensure the image takes up the full width */
        }

        /* Button container */
        .button-container {
            position: absolute;
            top: 50%; /* Center vertically */
            left: 50%; /* Center horizontally */
            transform: translate(-50%, -50%); /* Center the container */
            text-align: center;
            z-index: 1; /* Ensure buttons are above the image */
        }

        .button-container a {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            background-color: #4535C1;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
            transition: background-color 0.3s;
            font-family: 'Times New Roman', Times, serif;
        }

        .button-container a:hover {
            background-color: #0056b3;
        }

        .welcome-message {
            position: absolute;
            top: 30px; /* Space from the top */
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 30px;
            z-index: 1; /* Ensure the message is above the image */
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
</head>
<body>
    <nav>
        <h2>Hospital Menu</h2>
        <a href="hospital_dashboard.php">Dashboard</a>
        <a href="hospital_add_patient.php">Add Patients</a>
        <a href="hospital_view_patients.php">View Patients</a>
        <a href="hospital_view_feedback.php">View Feedback</a>
        <a href="view_hospital.php">View Hospital</a>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="content">
        <header>
            <h1>Hospital Dashboard - MedAlert Access System</h1>
        </header>
        <main>
            <div class="welcome-message">
                Welcome, <?php echo htmlspecialchars($hospital_name); ?>!
            </div>
            <div class="button-container">
                <a href="hospital_add_patient.php">Add Patients</a>
                <a href="hospital_view_patients.php">View Patients</a>
                <a href="hospital_view_feedback.php">View Feedback</a>
                <a href="view_hospital.php">View Hospital</a>
                <a href="logout.php">Logout</a>
            </div>
        </main>
    </div>
</body>
</html>
