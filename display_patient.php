<?php
include("config.php"); // Ensure this file contains the correct database connection

// Handle form submission
if (isset($_POST['submit'])) {
    $patient_id_proof = mysqli_real_escape_string($con, $_POST['patient_id_proof']);

    // Query to get general patient information
    $query_general_info = "
        SELECT p.patient_name, p.patient_id_proof, pd.full_name, pd.date_of_birth, pd.gender, pd.contact_number, pd.email, pd.address
        FROM patients p
        LEFT JOIN personaldetails pd ON p.patient_id_proof = pd.patient_id_proof
        WHERE p.patient_id_proof = ?";

    if ($stmt_general_info = $con->prepare($query_general_info)) {
        $stmt_general_info->bind_param("s", $patient_id_proof);
        $stmt_general_info->execute();
        $result_general_info = $stmt_general_info->get_result();
        $general_info = $result_general_info->fetch_assoc();
        $stmt_general_info->close();
    }

    // Query to get hospital information where the patient has visited
    $query_hospitals = "
        SELECT h.id, h.name
        FROM patients p
        JOIN hospitals h ON p.hospital_id = h.id
        WHERE p.patient_id_proof = ?";

    if ($stmt_hospitals = $con->prepare($query_hospitals)) {
        $stmt_hospitals->bind_param("s", $patient_id_proof);
        $stmt_hospitals->execute();
        $result_hospitals = $stmt_hospitals->get_result();
        $hospitals = $result_hospitals->fetch_all(MYSQLI_ASSOC);
        $stmt_hospitals->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            background: url('assets/images/viewdetail.avif') no-repeat center center fixed;
            background-size: cover;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
        }
        h2 {
            color: black;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #074173;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .error {
            color: #ff0000;
            font-weight: bold;
        }
        .back-button {
            position: absolute;
            bottom: 0;
            left: 0;
            margin: 20px;
            padding: 10px 20px;
            background-color: #1679AB;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-button:hover {
            background-color: #053a6d;
        }
        .hospital-details {
            margin-top: 20px;
            display: none;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function fetchHospitalDetails(hospital_id, patient_id_proof) {
            $.ajax({
                url: 'fetch_hospital_details.php',
                type: 'GET',
                data: {hospital_id: hospital_id, patient_id_proof: patient_id_proof},
                success: function(response) {
                    $('.hospital-details').html(response).slideDown();
                }
            });
        }
    </script>
</head>
<body>
    <div class="container">
        <?php
        if (isset($general_info)) {
            // Display General Information
            echo "<h2>Patient General Information</h2>";
            echo "<table>";
            echo "<tr><th>Patient Name</th><td>" . htmlspecialchars($general_info['patient_name']) . "</td></tr>";
            echo "<tr><th>ID Proof</th><td>" . htmlspecialchars($general_info['patient_id_proof']) . "</td></tr>";
            echo "<tr><th>Full Name</th><td>" . htmlspecialchars($general_info['full_name']) . "</td></tr>";
            echo "<tr><th>Date of Birth</th><td>" . htmlspecialchars($general_info['date_of_birth']) . "</td></tr>";
            echo "<tr><th>Gender</th><td>" . htmlspecialchars($general_info['gender']) . "</td></tr>";
            echo "<tr><th>Contact Number</th><td>" . htmlspecialchars($general_info['contact_number']) . "</td></tr>";
            echo "<tr><th>Email</th><td>" . htmlspecialchars($general_info['email']) . "</td></tr>";
            echo "<tr><th>Address</th><td>" . htmlspecialchars($general_info['address']) . "</td></tr>";
            echo "</table>";
        }

        if (!empty($hospitals)) {
            echo "<h2>Medical History</h2>";
            echo "<ul>";
            foreach ($hospitals as $hospital) {
                echo "<li><a href='javascript:void(0);' onclick='fetchHospitalDetails(" . $hospital['id'] . ", \"" . urlencode($patient_id_proof) . "\");'>" . htmlspecialchars($hospital['name']) . "</a></li>";
            }
            echo "</ul>";
        } else {
            echo "<div class='error'>No hospital visit records found for this patient.</div>";
        }
        ?>
        
        <div class="hospital-details"></div>
    </div>
</body>
</html>
