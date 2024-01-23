<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
</head>
<body>

<?php
// Database connection configuration
$servername = "localhost"; // Use the correct hostname or IP address
$username = "root";
$password = ""; // Your MySQL password (leave empty for development purposes)
$database = "task_manager";

// Create a connection to the MySQL server
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get task details from the form
    $taskName = htmlspecialchars($_POST["task_name"]);
    $taskDescription = htmlspecialchars($_POST["task_description"]);

    // Insert task into the tasks table
    $sqlInsertTask = "INSERT INTO tasks (task_name, task_description) VALUES ('$taskName', '$taskDescription')";
    if ($conn->query($sqlInsertTask) === TRUE) {
        echo "Task added successfully.<br>";
    } else {
        echo "Error adding task: " . $conn->error . "<br>";
    }
}

// Close the database connection
$conn->close();
?>

<!-- HTML Form for adding tasks -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="task_name">Task Name:</label>
    <input type="text" id="task_name" name="task_name" required>
    <br>
    <label for="task_description">Task Description:</label>
    <textarea id="task_description" name="task_description" rows="4" required></textarea>
    <br>
    <button type="submit">Add Task</button>
</form>

</body>
</html>
