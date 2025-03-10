<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h2 {
            color: #333;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
<!DOCTYPE html>
<html>
<head>
    <title>Update Data</title>
</head>
<body>
    <h2>Update Data</h2>
    <?php
    include 'conn.php'; // Include the database connection file

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $userToken = $_POST['user_token'];
        $callbackUrl = $_POST['callback_url'];

        // Prepare and execute SQL query to update data
        $sql = "UPDATE mrviptechgetway SET user_token = '$userToken', callback_url = '$callbackUrl' WHERE id = 1";

        if ($conn->query($sql) === TRUE) {
            // Data updated successfully
            echo "Data updated successfully!";
        } else {
            // Error updating data
            echo "Error updating record: " . $conn->error;
        }
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="user_token">4in1.upipay.in Token:</label><br>
        <input type="text" id="user_token" name="user_token" required><br><br>
        <label for="callback_url">Callback URL:</label><br>
        <input type="text" id="callback_url" name="callback_url" required><br><br>
        <input type="submit" value="Update"><br><br>
    </form>

    <form method="post" action="https://4in1.upipay.in.net/auth/register">
        <input type="submit" value="Buy API">
    </form>
    
</body>
</html>
