<?php
session_start();
include("config.php"); 


// Code for updating Password
if (isset($_POST['change'])) {
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $newpassword = $_POST['password'];
    $query = mysqli_query($con, "UPDATE doctors SET password='$newpassword' WHERE username='$username' AND email='$email'");
    
    if ($query) {
        echo "<script>alert('Password successfully updated.');</script>";
        echo "<script>window.location.href ='doctor_login.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>MedAlert Access System | Doctor Reset Password</title>
    <style>
        body {
            font-family:'Times New Roman', Times, serif ;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('assets/images/login.jpg') no-repeat center center fixed; /* Replace with your image path */
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
        .error {
            color: red;
        }
    </style>
    <script type="text/javascript">
        function valid() {
            var password = document.passwordreset.password.value;
            var password_again = document.passwordreset.password_again.value;
            if (password != password_again) {
                alert("Password and Confirm Password fields do not match!");
                document.passwordreset.password_again.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="logo">
            <h2>MedAlert Access System | Doctor Reset Password</h2>
        </div>
        <form name="passwordreset" method="post" onSubmit="return valid();">
            <fieldset>
                <legend>Doctor Reset Password</legend>
                <p>Please set your new password.<br />
                <span class="error"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg']="";?></span></p>

                <div class="form-group">
                    <input type="password" name="password" placeholder="New Password" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password_again" placeholder="Confirm Password" required>
                </div>

                <div class="form-actions">
                    <button type="submit" name="change">Change</button>
                </div>
                <div class="new-account">
                    Already have an account? <a href="doctor_login.php">Log-in</a>
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>
