<?php
session_start();
include("config.php"); // Ensure this file has your database connection

$error = ''; // Initialize error variable

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the query to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM hospital WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $hospital = $result->fetch_assoc();

    if ($hospital) {
        // Directly compare the entered password with the stored password
        if ($password === $hospital['password']) {
            // Store hospital details in session
            $_SESSION['hospital_id'] = $hospital['hospital_id'];
            $_SESSION['hospital_username'] = $hospital['username'];

            // Redirect to hospital dashboard
            header('Location: hospital_dashboard.php');
            exit;
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Login - MedAlert Access System</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background: url('assets/images/sign.png') no-repeat center center fixed; /* Replace with your image path */
            background-size: cover;
        }
        .login {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5); /* Dark overlay to enhance text visibility */
        }
        .main-login {
            width: 100%;
            max-width: 400px;
            background-color: #D1E9F6; /* Slight transparency for the login box */
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo h2 {
            margin: 0;
            font-weight: 300;
            color: #074173; /* Dark blue color */
        }
        .box-login {
            padding: 20px;
        }
        .form-login {
            width: 100%;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group input {
            width: 100%;
            padding: 4px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }
        .btn {
            background-color: #074173; /* Dark blue color */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #053a61; /* Darker shade on hover */
        }
        .copyright {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #999;
        }
        .btn-home {
            background-color:#074173;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .button-wrapper {
            margin-top: 10px;
        }
    </style>
</head>
<body class="login">
    <div class="main-login">
        <div class="logo">
            <a href="index.php">
                <h2>MedAlert Access System | Hospital Login</h2>
            </a>
        </div>

        <div class="box-login">
            <form class="form-login" method="post">
                <fieldset>
                    <legend>Sign in to your account</legend>
                    <p>Please enter your username and password to log in.<br />
                        <span style="color:red;"><?php echo isset($error) ? htmlspecialchars($error) : ''; ?></span>
                    </p>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control password" name="password" placeholder="Password" required>
                    </div>
                    <div class="button-wrapper">
                        <button type="submit" class="btn" name="submit">Login</button>
                        <a href="login.php" class="btn-home">Back to Home</a>
                    </div>
                </fieldset>
            </form>

            <div class="copyright">
                <span class="text-bold text-uppercase">MedAlert Access System</span>
            </div>
        </div>
    </div>
</body>
</html>
