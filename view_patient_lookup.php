<?php
// Include the database connection
include('config.php');

// SQL query to fetch patient_id and patient_name from the patients table
$sql = "SELECT user_id, patient_name FROM patients";
$result = mysqli_query($con, $sql);

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
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            background-image: url('assets/images/patientdetail.avif'); /* Path to your background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh; /* Ensures the body takes up the full height of the viewport */
            display: flex; /* Optional: Allows centering content if needed */
            flex-direction: column;
        }

        h1 {
            color: white;
            text-align: center;
        }

        table {
            width: 80%; /* Increased width for more visibility */
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
        }

        table, th, td {
            border: 1px solid #1679AB;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #1679AB;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Patient Details</h1>
    <table>
        <tr>
            <th>Patient ID</th>
            <th>Patient Name</th>
        </tr>
        <?php
        // Check if there are any records
        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>" . $row['patient_name'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No patients found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
