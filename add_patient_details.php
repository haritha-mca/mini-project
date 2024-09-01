<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient Details - MedAlert Access System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f8;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .content {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            width: 100%;
        }

        header h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #074173;
        }

        form label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        form input[type="text"],
        form input[type="date"],
        form textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        form input[type="submit"] {
            background-color: #074173;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 20px;
        }

        form input[type="submit"]:hover {
            background-color: #1679AB;
        }

        form textarea {
            resize: vertical;
            min-height: 50px;
        }

        .success-message {
            color: green;
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
        }

        .error-message {
            color: red;
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
  
    <div class="content">
        <header>
            <h1>Add Patient Details</h1>
        </header>
        <main>
            <form action="" method="post">
                <label for="patient_name">Patient Name:</label>
                <input type="text" id="patient_name" name="patient_name" required>

                <label for="patient_id_proof">Patient ID Proof:</label>
                <input type="text" id="patient_id_proof" name="patient_id_proof" required>

                <label for="details">Details:</label>
                <textarea id="details" name="details" required></textarea>

                <label for="bp">Blood Pressure:</label>
                <input type="text" id="bp" name="bp">

                <label for="blood sugar">Blood Sugar:</label>
                <input type="text" id="blood sugar" name="blood sugar">

                <label for="weight">Weight:</label>
                <input type="text" id="weight" name="weight">

                <label for="allergies">Allergies:</label>
                <textarea id="allergies" name="allergies"></textarea>

                <label for="previous_surgeries">Previous Surgeries:</label>
                <textarea id="previous_surgeries" name="previous_surgeries"></textarea>

                <label for="bmi">BMI:</label>
                <input type="text" id="bmi" name="bmi">

                <label for="height">Height:</label>
                <input type="text" id="height" name="height">

                <label for="heart_rate">Heart Rate:</label>
                <input type="text" id="heart_rate" name="heart_rate">

                <label for="additional_details">Additional Details:</label>
                <textarea id="additional_details" name="additional_details"></textarea>

                <label for="bloodgroup">Blood Group:</label>
                <input type="text" id="bloodgroup" name="bloodgroup">

                <label for="previous_hospitals_visited">Previous Hospitals Visited:</label>
                <textarea id="previous_hospitals_visited" name="previous_hospitals_visited"></textarea>

                <label for="medications">Medications:</label>
                <textarea id="medications" name="medications"></textarea>

                <label for="immunizations">Immunizations:</label>
                <textarea id="immunizations" name="immunizations"></textarea>

                <label for="last_visited_date">Last Visited Date:</label>
                <input type="date" id="last_visited_date" name="last_visited_date">

                <label for="test_results">Test Results:</label>
                <textarea id="test_results" name="test_results"></textarea>

                <label for="hospitalizations">Hospitalizations:</label>
                <textarea id="hospitalizations" name="hospitalizations"></textarea>

                <input type="submit" name="submit" value="Add Patient Details">
            </form>

            <?php
            // Include the database connection file
            include('config.php');

            if (isset($_POST['submit'])) {
                // Get form data
                $patient_name = $_POST['patient_name'];
                $patient_id_proof = $_POST['patient_id_proof'];
                $details = $_POST['details'];
                $bp = $_POST['bp'];
                $blood_sugar = $_POST['blood sugar'];
                $weight = $_POST['weight'];
                $allergies = $_POST['allergies'];
                $previous_surgeries = $_POST['previous_surgeries'];
                $bmi = $_POST['bmi'];
                $height = $_POST['height'];
                $heart_rate = $_POST['heart_rate'];
                $additional_details = $_POST['additional_details'];
                $bloodgroup = $_POST['bloodgroup'];
                $previous_hospitals_visited = $_POST['previous_hospitals_visited'];
                $medications = $_POST['medications'];
                $immunizations = $_POST['immunizations'];
                $last_visited_date = $_POST['last_visited_date'];
                $test_results = $_POST['test_results'];
                $hospitalizations = $_POST['hospitalizations'];

                // Insert data into the database
                $sql = "INSERT INTO patients (
                            patient_name, patient_id_proof, details, bp, blood sugar, weight, 
                            allergies, previous_surgeries, bmi, height, heart_rate, additional_details,
                            bloodgroup, previous_hospitals_visited, medications, immunizations, 
                            last_visited_date, test_results, hospitalizations
                        ) VALUES (
                            '$patient_name', '$patient_id_proof', '$details', '$bp', '$blood_sugar', '$weight',
                            '$allergies', '$previous_surgeries', '$bmi', '$height', '$heart_rate', '$additional_details',
                            '$bloodgroup', '$previous_hospitals_visited', '$medications', '$immunizations',
                            '$last_visited_date', '$test_results', '$hospitalizations'
                        )";

                if (mysqli_query($con, $sql)) {
                    echo "<div class='success-message'>Patient details added successfully!</div>";
                } else {
                    echo "<div class='error-message'>Error: " . $sql . "<br>" . mysqli_error($con) . "</div>";
                }
            }
            ?>
        </main>
    </div>
</body>
</html>
