<?php
session_start();
include 'conn.php'; // Include the database connection file

// Fetch API credentials from the database
$sql = "SELECT * FROM mrviptechgetway WHERE user_id = 'user123'"; // Change user_id as needed
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_token = $row['user_token'];
    $api_url = $row['api_endpoint'];
    $callback_url = $row['callback_url'];
    
    

} else {
    // Handle case where API credentials are not found
    die("API credentials not found for the specified user.");
}

// Retrieve amount and user from GET parameters
$am = $_GET['am'] ?? null;
$user = $_GET['user'] ?? null;

if (!$am || !$user) {
    die("Required parameters missing.");
}

$orderid = uniqid().time().rand(1111, 9999);
$_SESSION['xxorderid'] = $orderid;
$_SESSION['xxuser'] = $user;

// Define the payload data
$data = array(
    'customer_mobile' => '1234567890',
    'user_token' => $user_token,
    'amount' => $am,
    'order_id' => $orderid,
    'redirect_url' => $callback_url . '/callback.php',
    'remark1' => $user,
    'remark2' => 'testremark2',
);

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Encode the data as form-urlencoded

// Execute the cURL request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    // Parse the JSON response
    $result = json_decode($response, true);

    // Check if the status is true or false
    if ($result && isset($result['status'])) {
        if ($result['status'] === true) {
            // Order was created successfully
            header("Location: {$result['result']['payment_url']}");
            exit(); // Terminate script execution
        } else {
            // Plan expired
            echo 'Status: ' . $result['status'] . '<br>';
            echo 'Message: ' . $result['message'];
        }
    } else {
        // Invalid response
        echo 'Invalid API response';
    }
}

// Close cURL session
curl_close($ch);

// Close database connection
$conn->close();
?>
