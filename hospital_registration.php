<?php
session_start();
require 'config.php'; // Make sure this path is correct

// Redirect if the user is not logged in as admin
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit;
}

$success = '';
$error = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact_info = $_POST['contact_info'];
    $registration_number = $_POST['registration_number'];
    $email = $_POST['email'];

    // Prepare and bind
    if ($stmt = mysqli_prepare($con, "INSERT INTO hospitals (name, address, contact_info, registration_number, email) VALUES (?, ?, ?, ?, ?)")) {
        mysqli_stmt_bind_param($stmt, "sssss", $name, $address, $contact_info, $registration_number, $email);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            $success = "Hospital registered successfully";
        } else {
            $error = "Error: " . mysqli_error($con);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $error = "Error preparing statement: " . mysqli_error($con);
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
        /* Reset some default styles */
        body, h1, h2, p {
            margin: 0;
            padding: 0;
        }

        /* Body styles */
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.6;
            color: #333;
            background: #f4f4f4; /* Fallback color */
            overflow: auto; /* Enable scrolling */
            position: relative; /* Create a positioning context */
            min-height: 100vh; /* Ensure body covers the full viewport height */
        }

        /* Background image with blur effect */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('assets/images/hospital.jpg') no-repeat center center fixed;
            background-size: cover;
            filter: blur(8px); /* Adjust the blur level */
            z-index: -1; /* Ensure the pseudo-element is behind other content */
        }

        header {
            background-color: #36C2CE; /* Updated header color */
            color: white; /* Adjusted text color for better contrast */
            padding: 15px;
            text-align: center;
            position: relative; /* Ensure header is above the background */
            z-index: 1; /* Ensure header is above the pseudo-element */
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column; /* Ensure content is centered vertically */
            padding: 20px;
            position: relative; /* Ensure the main section is above the background */
            z-index: 1; /* Ensure the form is above the pseudo-element */
            min-height: 80vh; /* Provide space for scrolling if necessary */
        }

        form {
           /* Slightly transparent background */
            padding: 20px;
            border-radius: 5px;
            width: 100%;
            max-width: 500px;
            margin-top: 20px; /* Adjust margin as needed */
            box-shadow: none; /* Remove box shadow */
            border: none; /* Remove border */
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4535C1;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            margin-top: 15px;
            color: light green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <header>
        <h1>Hospital Registration - MedAlert Access System</h1>
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

            <button type="submit">Register</button>

            <?php if (!empty($success)) { echo "<p>$success</p>"; } ?>
            <?php if (!empty($error)) { echo "<p class='error'>$error</p>"; } ?>
        </form>
    </main>
</body>
</html>
