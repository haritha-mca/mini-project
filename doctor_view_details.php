<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Patient</title>
</head>
<body>
    <h1>Search Patient Details</h1>
    <form method="POST" action="display_patient.php">
        <label for="patient_id_proof">Enter ID Proof Number:</label>
        <input type="text" id="patient_id_proof" name="patient_id_proof" required>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>
