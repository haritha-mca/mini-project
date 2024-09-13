<?php
session_start();

// Check if the hospital is logged in
if (!isset($_SESSION['hospital_id'])) {
    header('Location: hospital_login.php'); // Redirect to login page if not logged in
    exit;
}

include('config.php'); // Include your database connection file

$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form input
    $username = $_POST['username'];
    $password = $_POST['password'];
    $full_name = $_POST['full_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $patient_id_proof = $_POST['patient_id_proof'];

    // Start a transaction
    $con->begin_transaction();

    try {
        // Insert into users table (username and password)
        $sqlUsers = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmtUsers = $con->prepare($sqlUsers);
        $stmtUsers->bind_param("ss", $username, $password);

        if ($stmtUsers->execute()) {
            // Get the inserted user's ID
            $user_id = $con->insert_id;

            // Insert into personaldetails table (rest of the patient details)
            $sqlDetails = "INSERT INTO personaldetails (user_id, full_name, date_of_birth, gender, contact_number, email, address, patient_id_proof) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmtDetails = $con->prepare($sqlDetails);
            $stmtDetails->bind_param("isssssss", $user_id, $full_name, $date_of_birth, $gender, $contact_number, $email, $address, $patient_id_proof);

            if ($stmtDetails->execute()) {
                // Commit the transaction if both inserts are successful
                $con->commit();
                $successMessage = "Patient added successfully!";
            } else {
                // Rollback if the second insert fails
                throw new Exception("Error adding patient details: " . $stmtDetails->error);
            }

            $stmtDetails->close();
        } else {
            // Rollback if the first insert fails
            throw new Exception("Error adding user: " . $stmtUsers->error);
        }

        $stmtUsers->close();
    } catch (Exception $e) {
        $con->rollback(); // Undo changes on error
        $errorMessage = $e->getMessage();
    }
}

$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient - MedAlert Access System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #f4f4f4;
            background: url('assets/images/u.avif') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
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
        }
        nav a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        nav a:hover {
            background-color: #125a7b;
        }
        .content {
            margin-left: 200px;
            padding: 20px;
        }
        header {
            text-align: center;
            margin-bottom: 20px;
            color:white;
        }
        .form-container {
           
            padding: 20px;
            margin: 20px auto;
            border-radius: 8px;
            max-width: 500px;
        }
        .form-group {
            margin-bottom: 20px;
           
        }
        .form-group label {
            color:white;
            display: block;
            margin-bottom: 5px;
            max-width: 250px; /* Adjust width as needed */
            width: 100%; /* Ensures label width fits within form container */
            box-sizing: border-box; /* Includes padding and border in width calculation */
        }
        .form-group input[type="text"], .form-group input[type="password"], 
        .form-group input[type="date"], .form-group input[type="email"] {
            width: calc(100% - 150px); /* Adjust based on label width */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .alert {
            padding: 15px;
            margin: 15px 0;
            background-color: #d4edda;
            color: #155724;
            border-radius: 5px;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .btn-primary {
            background-color: #5DEBD7;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #3a9f9b;
        }
    </style>
</head>
<body>
    <nav>
        <h2>Hospital Menu</h2>
        <a href="hospital_dashboard.php">Dashboard</a>
        <a href="hospital_add_patient.php">Add Patients</a>
        <a href="hospital_view_patients.php">View Patients</a>
        <a href="hospital_view_feedback.php">View Feedback</a>
        <a href="view_hospital.php">View Hospital</a>
        <a href="logout.php">Logout</a>
    </nav>

    <div class="content">
        <header>
            <h1>Add Patient</h1>
        </header>

        <main>
            <div class="form-container">
                <?php if ($successMessage): ?>
                    <div class="alert"><?php echo htmlspecialchars($successMessage); ?></div>
                <?php elseif ($errorMessage): ?>
                    <div class="alert-error"><?php echo htmlspecialchars($errorMessage); ?></div>
                <?php endif; ?>

                <form action="hospital_add_patient.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="full_name">Full Name:</label>
                        <input type="text" id="full_name" name="full_name" required>
                    </div>
                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth:</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <input type="text" id="gender" name="gender" required>
                    </div>
                    <div class="form-group">
                        <label for="contact_number">Contact Number:</label>
                        <input type="text" id="contact_number" name="contact_number" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="patient_id_proof">Patient ID Proof:</label>
                        <input type="text" id="patient_id_proof" name="patient_id_proof" required>
                    </div>
                    <button type="submit" class="btn-primary">Add Patient</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
   
   