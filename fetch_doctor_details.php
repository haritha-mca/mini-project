<?php
include("config.php"); // Ensure this file contains the correct database connection

if (isset($_GET['hospital_id']) && isset($_GET['patient_id_proof'])) {
    $hospital_id = mysqli_real_escape_string($con, $_GET['hospital_id']);
    $patient_id_proof = mysqli_real_escape_string($con, $_GET['patient_id_proof']);

    // Query to get doctors associated with the selected hospital
    $query_doctors = "
        SELECT d.name, d.specialization, d.contact_number, d.email
        FROM doctor_details d
        WHERE d.hospital_id = ?";

    if ($stmt_doctors = $con->prepare($query_doctors)) {
        $stmt_doctors->bind_param("i", $hospital_id);
        $stmt_doctors->execute();
        $result_doctors = $stmt_doctors->get_result();
        $doctors = $result_doctors->fetch_all(MYSQLI_ASSOC);
        $stmt_doctors->close();

        if ($doctors) {
            echo "<h3>Doctors at this Hospital</h3>";
            echo "<table>";
            echo "<tr><th>Name</th><th>Specialization</th><th>Contact Number</th><th>Email</th></tr>";
            foreach ($doctors as $doctor) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($doctor['name']) . "</td>";
                echo "<td>" . htmlspecialchars($doctor['specialization']) . "</td>";
                echo "<td>" . htmlspecialchars($doctor['contact_number']) . "</td>";
                echo "<td>" . htmlspecialchars($doctor['email']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<div class='error'>No doctors found for this hospital.</div>";
        }
    }
}
?>
