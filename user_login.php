<?php
session_start();
include("config.php"); // Ensure this file has your database connection

if (isset($_POST['submit'])) {
    $uname = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the query to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Check the plain text password
        if ($password === $user['password']) {
            // Store user details in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_username'] = $user['username'];

            // Redirect to user dashboard
            header('Location: user_dashboard.php');
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
    <title>User Login - MedAlert Access System</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background: url('assets/images/sign.png') no-repeat center center fixed;
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
            background-color: rgba(255, 255, 255, 0.8);
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
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
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
                <h2>MedAlert Access System | User Login</h2>
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
                    <div class="form-actions">
                        <button type="submit" class="btn" name="submit">Login</button>
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
