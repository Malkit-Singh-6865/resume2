<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2, h3 {
            color: #333;
        }
        ul {
            margin: 0;
            padding: 0 0 0 20px;
        }
        li {
            margin-bottom: 10px;
        }
        p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>My Resume</h1>

        <?php
        // Connect to database
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'your_database';

        $conn = new mysqli($host, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch resume data from database
        $sql = "SELECT * FROM resume_data";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<h2>" . $row["name"] . "</h2>";
                echo "<p>Email: " . $row["email"] . "</p>";
                echo "<p>Phone: " . $row["phone"] . "</p>";
                echo "<p>Address: " . $row["address"] . "</p>";
                echo "<p>Summary: " . $row["summary"] . "</p>";
                echo "<h3>Experience</h3>";
                echo "<ul>";
                // Output experience data
                $experience = json_decode($row["experience"], true);
                foreach ($experience as $exp) {
                    echo "<li>" . $exp . "</li>";
                }
                echo "</ul>";
                echo "<h3>Education</h3>";
                echo "<ul>";
                // Output education data
                $education = json_decode($row["education"], true);
                foreach ($education as $edu) {
                    echo "<li>" . $edu . "</li>";
                }
                echo "</ul>";
            }
        } else {
            echo "No resume data found.";
        }
        $conn->close();
        ?>

    </div>
</body>
</html>
