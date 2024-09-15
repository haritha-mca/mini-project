<?php
require 'config.php';

// Initialize variables
$success = '';
$error = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact_info = $_POST['contact_info'];
    $registration_number = $_POST['registration_number'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Start a transaction
    mysqli_begin_transaction($con);

    try {
        // Insert into hospitals table with username and password
        if ($stmt = mysqli_prepare($con, "INSERT INTO hospitals (name, address, contact_info, registration_number, email, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            mysqli_stmt_bind_param($stmt, "sssssss", $name, $address, $contact_info, $registration_number, $email, $username, $password);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            throw new Exception("Error preparing statement: " . mysqli_error($con));
        }

        // Commit the transaction
        mysqli_commit($con);
        $success = "Hospital registered successfully. You can now <a href='hospital_login.php'>login</a>.";

    } catch (Exception $e) {
        mysqli_rollback($con); // Roll back the transaction on error
        $error = "Transaction failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Registration</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-y: auto; /* Enable vertical scrollbar for the page */
            font-family:'Times New Roman', Times, serif;
            background: url('assets/images/hospital.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        header {
            background-color: #1679AB;
            color: white;
            padding: 15px;
            text-align: center;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            border-radius: 8px;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            width: 100%;
            max-width: 500px;
  
            border-radius: 8px;
            
            margin: 20px auto;
        }

        form {
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 8px;
            color: black;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            background-color: #f9f9f9;
        }

        button {
            background-color: #074173;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px; /* Add margin between buttons */
            font-family:'Times New Roman', Times, serif;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-button {
            background-color: #1679AB;
        }

        .back-button:hover {
            background-color: #005493;
        }

        .success-message, .error-message {
            margin-top: 15px;
            padding: 10px;
            text-align: center;
            border-radius: 4px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <header>
        <h2>Hospital Registration - MedAlert Access System</h2>
    </header>
    <main>
        <form method="POST" action="">
            <label for="name">Hospital Name:</label>
            <input type="text" name="name" required>

            <label for="address">Address:</label>
            <textarea name="address" required></textarea>

            <label for="contact_info">Contact Info:</label>
            <input type="text" name="contact_info" required>

            <label for="registration_number">Registration Number:</label>
            <input type="text" name="registration_number" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Register</button>
            <a href="hospital_login.php"><button type="button" class="back-button">Back to Login</button></a>

            <?php if (!empty($success)) { echo "<p class='success-message'>$success</p>"; } ?>
            <?php if (!empty($error)) { echo "<p class='error-message'>$error</p>"; } ?>
        </form>
    </main>
</body>
</html>
