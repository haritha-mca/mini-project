<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Your Role - MedAlert Access System</title>
    <style>
        /* Reset some default styles */
        body, h1, h2 {
            margin: 0;
            padding: 0;
        }

        /* Body styles */
        body {
            font-family:'Times New Roman', Times, serif;
            line-height: 1.6;
            color: #333;
            background: url('assets/images/index.webp') no-repeat center center fixed;
            background-size: cover; /* Cover the entire viewport */
            text-align: center;
            padding: 0; /* Remove extra padding */
            margin: 0; /* Remove margin */
            height: 100vh; /* Ensure body takes up full viewport height */
        }

        header {
            background-color: rgba(0, 123, 255, 0.7); /* Add transparency to match the background */
            color: white;
            padding: 20px; /* Increase padding to move header content away from edges */
            width: 100%; /* Ensure header stretches across the full width */
            box-sizing: border-box; /* Include padding in width calculation */
            position: fixed; /* Fix header at the top */
            top: 0; /* Align with the top */
            left: 0; /* Align with the left */
            z-index: 1000; /* Ensure header is above other content */
        }

        header h1 {
            margin: 0;
        }

        nav {
            margin-top: 10px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        /* Main section styles */
        main {
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            flex-direction: column;
            height: calc(100vh - 80px); /* Adjust height to account for header */
            margin: 0;
            padding: 20px;
        }

        h2 {
            font-size: 2rem;
            color: white;
        }

        .login-options {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }

        .login-options a {
            display: block;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            padding: 15px 30px;
            border-radius: 5px;
            font-size: 1.2rem;
            transition: background-color 0.3s;
        }

        .login-options a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>MedAlert Access System</h1>
        <nav>
            <a href="index.php">Home</a>
        </nav>
    </header>
    <main>
        <h2>Select Your Role</h2>
        <div class="login-options">
            <a href="admin_login.php">Admin</a>
            <a href="user_login.php">User</a>
            <a href="hospital_login.php">Hospital</a>
        </div>
    </main>
</body>
</html>
