<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedAlert Access System</title>
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
            background: url('assets/images/home.jpeg') no-repeat center center fixed;
            background-size: cover;
        }

        /* Header styles */
        header {
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            margin-bottom: 10px;
            font-size: 2.5rem;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
            font-size: 1.2rem;
        }

        nav a:hover {
            text-decoration: underline;
        }

        /* Main section styles */
        main {
            padding: 40px 20px;
            text-align: center;
        }

        .intro {
            /* Remove the background and padding from this section */
            margin: 0;
        }

        .intro h2 {
            margin-bottom: 15px;
            font-size: 2rem;
            color: #03346E;
        }

        .intro p {
            font-size: 1.2rem;
        }

        /* Footer styles */
        footer {
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            text-align: center;
            padding: 10px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>MedAlert Access System</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="login.php">Login</a>
        </nav>
    </header>
    <main>
        <section class="intro">
            <h2>Welcome to MedAlert Access System</h2>
            <p>Please log in to access the features.</p>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 MedAlert Access System</p>
    </footer>
</body>
</html>
