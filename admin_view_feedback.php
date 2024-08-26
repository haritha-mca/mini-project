<?php
session_start();
include("config.php");

$query = "SELECT * FROM feedback WHERE feedback_type = 'Admin'";
$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Feedback</title>
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
            
        }

        .feedback-container {
           
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 100%;
            height:100%;
            overflow-x: auto;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #3A1078; /* Header color */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #5DEBD7;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="feedback-container">
        <h2>Feedback for Admin</h2>
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Overall Experience</th>
                    <th>Access Ease</th>
                    <th>System Speed</th>
                    <th>Issues Encountered</th>
                    <th>Additional Comments</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['user_id']) . "</td>
                            <td>" . htmlspecialchars($row['overall_experience']) . "</td>
                            <td>" . htmlspecialchars($row['access_ease']) . "</td>
                            <td>" . htmlspecialchars($row['system_speed']) . "</td>
                            <td>" . htmlspecialchars($row['issues_encountered']) . "</td>
                            <td>" . htmlspecialchars($row['additional_comments']) . "</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No feedback available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
