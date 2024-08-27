<?php
session_start();
include('config.php'); // Include the database connection

// SQL query to fetch hospital details from the hospital table
$sql = "SELECT id, name, address, contact_info, registration_number, email FROM hospitals";
$result = mysqli_query($con, $sql);

// Check for query errors
if (!$result) {
    die("Query failed: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Hospital Details</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background-image: url('assets/images/hospital.jpg'); /* Path to your background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 90%;
            max-width: 1200px;
           
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        h1 {
            color: blue;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent table background */
        }

        table, th, td {
            border: 1px solid #1679AB;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #1679AB;
            color: white;
        }

        td {
            background-color: white; /* Solid background for table cells */
            color: #000;
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.7);
        }

        tr:hover {
            background-color: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hospital Details</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Contact Info</th>
                <th>Registration Number</th>
                <th>Email</th>
            </tr>
            <?php
            // Check if there are any records
            if (mysqli_num_rows($result) > 0) {
                // Output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['contact_info']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['registration_number']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hospitals found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
