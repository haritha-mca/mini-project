<?php
session_start();
include("config.php"); // Ensure this file has your database connection

if (isset($_POST['submit'])) {
    // Trim and sanitize user inputs
    $uname = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Username validation: alphanumeric and underscores, 5-20 characters
    $usernamePattern = "/^[a-zA-Z0-9_]{5,20}$/";
    
    // Password validation: at least 8 characters, one uppercase, one lowercase, one number, and one special character
    $passwordPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/";
    
    // Validation checks
    if (empty($uname)) {
        $error = "Username is required.";
    } elseif (!preg_match($usernamePattern, $uname)) {
        $error = "Username must be 5-20 characters long and contain only letters, numbers, or underscores.";
    } elseif (empty($password)) {
        $error = "Password is required.";
    } elseif (!preg_match($passwordPattern, $password)) {
        $error = "Password must be at least 8 characters long, include one uppercase letter, one lowercase letter, one number, and one special character.";
    } else {
        // If validation is successful, proceed with login logic
        $stmt = $con->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        if ($user) {
            // Here, you should use password_hash() and password_verify() for security in production
            if ($password === $user['password']) { // Replace with password_verify() if using hashed passwords
                $_SESSION['admin'] = $user['id'];
                header('Location: admin_dashboard.php');
                exit;
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Invalid username or password.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - MedAlert Access System</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background: url('assets/images/adminlogin.avif') no-repeat center center fixed;
            background-size: cover;
        }
        .login {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .main-login {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.8);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo h2 {
            margin: 0;
            font-weight: 300;
            color: #074173;
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
            font-family: 'Times New Roman', Times, serif;
        }
        .button-wrapper {
            margin-top: 10px;
        }
        .btn {
            background-color: #074173;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-family: 'Times New Roman', Times, serif;
        }
        .btn-home {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            text-decoration: none;
            display: inline-block;
        }
        .copyright {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body class="login">
    <div class="main-login">
        <div class="logo margin-top-30">
            <a href="index.php">
                <h2>MedAlert Access System | Admin Login</h2>
            </a>
        </div>

        <div class="box-login">
            <form class="form-login" method="post">
                <fieldset>
                    <legend>Sign in to your account</legend>
                    <p>Please enter your username and password to log in.<br />
                        <span style="color:red;"><?php echo isset($error) ? $error : ''; ?></span>
                    </p>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control password" name="password" placeholder="Password" required>
                    </div>
                    </span><a href="adminforgot_password.php">
									Forgot Password ?
								</a>
                    <div class="button-wrapper">
                        <button type="submit" class="btn" name="submit">Login</button>
                        <a href="login.php" class="btn-home">Back to Login</a>
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

