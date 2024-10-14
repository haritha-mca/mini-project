<?php
session_start();
include("config.php"); // Ensure this file has your database connection

// Check if the hospital is logged in
if (!isset($_SESSION['hospital_id'])) {
    header("Location: hospital_login.php");
    exit;
}

// Retrieve the patient details from the database
$query = "SELECT * FROM personaldetails";
$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patient Details</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            background: url('assets/images/patients.jpg') no-repeat center center fixed;
            background-size: cover;
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
            background-color: #074173; /* Dark blue color */
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        h2 {
            color: #074173;
        }
    </style>
</head>
<body>

<h2>Patient Details</h2>

<table>
    <thead>
        <tr>
            
            <th>Full Name</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Contact Number</th>
            <th>Email</th>
            <th>Address</th>
            <th>Patient ID Proof</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if there are any patient records
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
               
                echo "<td>" . htmlspecialchars($row['full_name']) . "</td>";
                echo "<td>" . $row['date_of_birth'] . "</td>";
                echo "<td>" . $row['gender'] . "</td>";
                echo "<td>" . $row['contact_number'] . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                echo "<td>" . htmlspecialchars($row['patient_id_proof']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No patients found.</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
