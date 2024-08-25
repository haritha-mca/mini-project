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

// Prepare and execute the query to fetch medical details
$sql = "
    SELECT p.patient_name, p.patient_id_proof, p.details, p.bp, p.`blood sugar`, p.weight, p.allergies, p.previous_surgeries, p.bmi, p.height, p.heart_rate
    FROM patients p
    WHERE p.user_id = ? 
    ORDER BY p.patient_name ASC
";

$stmt = $con->prepare($sql);
if (!$stmt) {
    die('Prepare failed: ' . htmlspecialchars($con->error));
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$details = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Medical Details - MedAlert Access System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Styles are the same as before */
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            height: 100vh;
            overflow-y: auto;
        }

        nav {
            width: 200px;
            background-color: #1679AB;
            color: white;
            height: 100vh;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            box-sizing: border-box;
            z-index: 1000;
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
            background-color: #125a7b;
        }

        .content {
            margin-left: 200px;
            padding: 20px;
            width: calc(100% - 200px);
            box-sizing: border-box;
        }

        header {
            background-color: #5DEBD7;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #5DEBD7;
            color: #3A1078;
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
            <h2>Medical Details</h2>
            <?php if (empty($details)): ?>
                <p>No medical details found.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Patient Name</th>
                            <th>ID Proof</th>
                            <th>BP</th>
                            <th>Blood Sugar</th>
                            <th>Weight</th>
                            <th>Allergies</th>
                            <th>Previous Surgeries</th>
                            <th>BMI</th>
                            <th>Height</th>
                            <th>Heart Rate</th>
                            <th>Additional Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($details as $detail): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($detail['patient_name']); ?></td>
                                <td><?php echo htmlspecialchars($detail['patient_id_proof']); ?></td>
                                <td><?php echo htmlspecialchars($detail['bp']); ?></td>
                                <td><?php echo htmlspecialchars($detail['blood sugar']); ?></td>
                                <td><?php echo htmlspecialchars($detail['weight']); ?></td>
                                <td><?php echo htmlspecialchars($detail['allergies']); ?></td>
                                <td><?php echo htmlspecialchars($detail['previous_surgeries']); ?></td>
                                <td><?php echo htmlspecialchars($detail['bmi']); ?></td>
                                <td><?php echo htmlspecialchars($detail['height']); ?></td>
                                <td><?php echo htmlspecialchars($detail['heart_rate']); ?></td>
                                <td><?php echo htmlspecialchars($detail['details']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
