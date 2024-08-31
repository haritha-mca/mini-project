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

    // Query to check how many hospitals the patient has visited
    $query_hospitals = "
        SELECT COUNT(DISTINCT hospital_id) AS hospital_count
        FROM patients 
        WHERE patient_id_proof = ?";

    if ($stmt_hospitals = $con->prepare($query_hospitals)) {
        $stmt_hospitals->bind_param("s", $patient_id_proof);
        $stmt_hospitals->execute();
        $result_hospitals = $stmt_hospitals->get_result();
        $row_hospitals = $result_hospitals->fetch_assoc();
        $hospital_count = $row_hospitals['hospital_count'];
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
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #074173;
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
        .section-divider {
            border-top: 2px solid #074173;
            margin: 20px 0;
        }
        .error {
            color: #ff0000;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($general_info)) {
            // Display General Information Once
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

        if (isset($hospital_count) && $hospital_count > 0) {
            // Display Medical Details Downwards
            $query_medical_details = "
                SELECT p.*, pd.full_name, pd.date_of_birth, pd.gender, pd.contact_number, pd.email, pd.address
                FROM patients p
                LEFT JOIN personaldetails pd ON p.patient_id_proof = pd.patient_id_proof
                WHERE p.patient_id_proof = ?
                ORDER BY p.last_visited_date DESC";

            if ($stmt_medical = $con->prepare($query_medical_details)) {
                $stmt_medical->bind_param("s", $patient_id_proof);
                $stmt_medical->execute();
                $result_medical = $stmt_medical->get_result();

                if ($result_medical->num_rows > 0) {
                    echo "<div class='section-divider'></div>";
                    echo "<h2>Medical Details</h2>";

                    while ($row_medical = $result_medical->fetch_assoc()) {
                        echo "<table>";
                        
                        echo "<tr><th>BP</th><td>" . htmlspecialchars($row_medical['bp']) . "</td></tr>";
                        echo "<tr><th>Blood Sugar</th><td>" . htmlspecialchars($row_medical['blood sugar']) . "</td></tr>";
                        echo "<tr><th>Weight</th><td>" . htmlspecialchars($row_medical['weight']) . "</td></tr>";
                        echo "<tr><th>Allergies</th><td>" . htmlspecialchars($row_medical['allergies']) . "</td></tr>";
                        echo "<tr><th>Previous Surgeries</th><td>" . htmlspecialchars($row_medical['previous_surgeries']) . "</td></tr>";
                        echo "<tr><th>BMI</th><td>" . htmlspecialchars($row_medical['bmi']) . "</td></tr>";
                        echo "<tr><th>Height</th><td>" . htmlspecialchars($row_medical['height']) . "</td></tr>";
                        echo "<tr><th>Heart Rate</th><td>" . htmlspecialchars($row_medical['heart_rate']) . "</td></tr>";
                        echo "<tr><th>Additional Details</th><td>" . htmlspecialchars($row_medical['additional_details']) . "</td></tr>";
                        echo "<tr><th>Blood Group</th><td>" . htmlspecialchars($row_medical['bloodgroup']) . "</td></tr>";
                        echo "<tr><th>Previous Hospitals</th><td>" . htmlspecialchars($row_medical['previous_hospitals_visited']) . "</td></tr>";
                        echo "<tr><th>Medications</th><td>" . htmlspecialchars($row_medical['medications']) . "</td></tr>";
                        echo "<tr><th>Immunizations</th><td>" . htmlspecialchars($row_medical['immunizations']) . "</td></tr>";
                        echo "<tr><th>Last Visited Date</th><td>" . htmlspecialchars($row_medical['last_visited_date']) . "</td></tr>";
                        echo "<tr><th>Test Results</th><td>" . htmlspecialchars($row_medical['test_results']) . "</td></tr>";
                        echo "<tr><th>Hospitalizations</th><td>" . htmlspecialchars($row_medical['hospitalizations']) . "</td></tr>";
                        echo "</table>";
                        echo "<div class='section-divider'></div>";
                    }
                } else {
                    echo "<div class='error'>No medical details found for this patient.</div>";
                }

                $stmt_medical->close();
            }
        } else {
            echo "<div class='error'>No hospital visit records found for this patient.</div>";
        }
        ?>
    </div>
</body>
</html>
