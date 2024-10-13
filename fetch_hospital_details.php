<?php
include('config.php');

if (isset($_GET['hospital_id']) && isset($_GET['patient_id_proof'])) {
    $hospital_id = intval($_GET['hospital_id']);
    $patient_id_proof = mysqli_real_escape_string($con, $_GET['patient_id_proof']);

    // Fetch medical details for the given hospital and patient
    $query_medical_details = "
        SELECT p.*, pd.full_name, pd.date_of_birth, pd.gender, pd.contact_number, pd.email, pd.address
        FROM patients p
        LEFT JOIN personaldetails pd ON p.patient_id_proof = pd.patient_id_proof
        WHERE p.patient_id_proof = ? AND p.hospital_id = ?
        ORDER BY p.last_visited_date DESC";

    if ($stmt_medical = $con->prepare($query_medical_details)) {
        $stmt_medical->bind_param("si", $patient_id_proof, $hospital_id);
        $stmt_medical->execute();
        $result_medical = $stmt_medical->get_result();

        if ($result_medical->num_rows > 0) {
            echo "<h2>Medical Details</h2>";
            while ($row_medical = $result_medical->fetch_assoc()) {
                echo "<table>";
                echo "<tr><th>Doctor Name</th><td>" . htmlspecialchars($row_medical['doctor_name']) . "</td></tr>";
                echo "<tr><th>BP</th><td>" . htmlspecialchars($row_medical['bp']) . "</td></tr>";
                echo "<tr><th>Blood Sugar</th><td>" . htmlspecialchars($row_medical['blood sugar']) . "</td></tr>";
                echo "<tr><th>Weight</th><td>" . htmlspecialchars($row_medical['weight']) . "</td></tr>";
                echo "<tr><th>Allergies</th><td>" . htmlspecialchars($row_medical['allergies']) . "</td></tr>";
                echo "<tr><th>Previous Surgeries</th><td>" . htmlspecialchars($row_medical['previous_surgeries']) . "</td></tr>";
                echo "<tr><th>BMI</th><td>" . htmlspecialchars($row_medical['bmi']) . "</td></tr>";
                echo "<tr><th>Height</th><td>" . htmlspecialchars($row_medical['height']) . "</td></tr>";
                echo "<tr><th>Heart Rate</th><td>" . htmlspecialchars($row_medical['heart_rate']) . "</td></tr>";
                echo "<tr><th>Additional Details From Patient</th><td>" . htmlspecialchars($row_medical['additional_details']) . "</td></tr>";
                echo "<tr><th>Blood Group</th><td>" . htmlspecialchars($row_medical['bloodgroup']) . "</td></tr>";
                
                echo "<tr><th>Medications</th><td>" . htmlspecialchars($row_medical['medications']) . "</td></tr>";
                echo "<tr><th>Immunizations</th><td>" . htmlspecialchars($row_medical['immunizations']) . "</td></tr>";
                echo "<tr><th>Last Visited Date</th><td>" . htmlspecialchars($row_medical['last_visited_date']) . "</td></tr>";
                echo "<tr><th>Test Results</th><td>" . htmlspecialchars($row_medical['test_results']) . "</td></tr>";
                echo "<tr><th>Hospitalizations</th><td>" . htmlspecialchars($row_medical['hospitalizations']) . "</td></tr>";
                echo "</table>";
                echo "<hr>";
            }
        } else {
            echo "<div class='error'>No medical records found for this hospital.</div>";
        }
        $stmt_medical->close();
    } else {
        echo "<div class='error'>Error fetching medical details.</div>";
    }
} else {
    echo "<div class='error'>Invalid request.</div>";
}
?>
