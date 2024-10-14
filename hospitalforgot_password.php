<?php
session_start();
error_reporting(0);
include("config.php"); 

// Checking Details for reset password
if (isset($_POST['submit'])) {
    $name = $_POST['name'];  // Correct POST variable for name
    $email = $_POST['email'];

    // Query to check if the entered name and email exist in the hospitals table
    $query = mysqli_query($con, "SELECT id FROM hospitals WHERE name='$name' AND email='$email'");
    $row = mysqli_num_rows($query);
    
    if ($row > 0) {
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        header('Location: hospitalreset.php');
    } else {
        echo "<script>alert('Invalid details. Please try with valid details');</script>";
        echo "<script>window.location.href ='hospitalforgot_password.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>MedAlert Access System | Hospital Password Recovery</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('assets/images/hospitallogin.jpg') no-repeat center center fixed; /* Replace with your image path */
            background-size: cover;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .logo h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-actions {
            text-align: right;
        }
        .form-actions button {
            padding: 10px 15px;
            background-color: #074173;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-actions button:hover {
            background-color: #1679AB;
        }
        .new-account {
            text-align: center;
            margin-top: 10px;
        }
        .new-account a {
            color: #1679AB;
            text-decoration: none;
        }
        .new-account a:hover {
            text-decoration: underline;
        }
        .copyright {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <h2>MedAlert Access System | Hospital Password Recovery</h2>
        </div>
        <form method="post">
            <fieldset>
                <legend>Hospital Password Recovery</legend>
                <p>Please enter your Email and Name to recover your password.</p>

                <div class="form-group">
                    <input type="text" name="name" placeholder="Registered Name" required>  <!-- Corrected input name -->
                </div>

                <div class="form-group">
                    <input type="email" name="email" placeholder="Registered Email" required>
                </div>

                <div class="form-actions">
                    <button type="submit" name="submit">Reset</button>
                </div>
                <div class="new-account">
                    Already have an account? <a href="hospital_login.php">Log-in</a>
                </div>
            </fieldset>
        </form>
        <div class="copyright">
            &copy; <span class="text-bold text-uppercase">MedAlert Access System</span>
        </div
