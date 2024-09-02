<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Patient</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: url('assets/images/search.avif') no-repeat center center fixed;
            background-size: cover;
        }

        h1 {
            color: #074173;
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
            color: #1679AB;
        }

        input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            background-color: #1679AB;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #074173;
        }
    </style>
</head>
<body>
    <form method="POST" action="display_patient.php">
        <h3>Search Patient Details</h3>
        <label for="patient_id_proof">Enter ID Proof Number:</label>
        <input type="text" id="patient_id_proof" name="patient_id_proof" required>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>

