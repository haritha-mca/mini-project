<?php
session_start();
include('config.php'); 

// Get the logged-in hospital's ID from the session
//$logged_in_hospital_id = $_SESSION['hospital_id'];

// Query to retrieve distinct hospital details excluding the logged-in hospital
$sql = "SELECT DISTINCT id, name, address, contact_info, email 
        FROM hospitals ";  // Exclude current hospital

$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Details</title>
    <style>
        body {
            font-family:'Times New Roman', Times, serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            background: url('assets/images/hospitaluserview.webp') no-repeat center center fixed;
            background-size: cover;
        }
        h2 {
            text-align: center;
            color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #074173;
            color: white;
        }
        td {
            background-color: #f9f9f9;
        }
        tr:nth-child(even) td {
            background-color: #e8f4f9;
        }
        tr:hover td {
            background-color: #d0ebf2;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        a {
            color: green;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Hospital Details</h2>

    <?php
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Name</th><th>Address</th><th>Contact Info</th><th>Email</th><th>Doctor Details</th></tr>";
        
        // Fetching and displaying rows
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['contact_info'] . "</td>";
           
            echo "<td>" . $row['email'] . "</td>";
            // Link to view doctor details for the selected hospital
            echo "<td><a href='patientview_doctor_details.php?hospital_id=" . $row['id'] . "'>Doctor Details</a></td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "<p>No hospital details found.</p>";
    }

    // Close the connection
    mysqli_close($con);
    ?>
</div>

</body>
</html>
