<?php
session_start();

include 'conn.php'; // Include the database connection file

// Fetch API credentials from the database
$sql = "SELECT user_token, api_url FROM mrviptechgetway WHERE user_id = 'user123'"; // Change user_id as needed
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_token = $row['user_token'];
    $api_url = $row['api_url']; // Fetch the API endpoint URL from the database
} else {
    // Handle case where API credentials are not found
    die("API credentials not found for the specified user.");
}

$orderid=$_SESSION['xxorderid'];
$user=$_SESSION['xxuser'];

// API endpoint URL
$url = $api_url;

// POST data
$postData = array(
    "user_token" => $user_token,
    "order_id" => $orderid
);

// Initialize cURL session
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

// Execute cURL session and get the response
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
    exit;
}

// Close cURL session
curl_close($ch);

// Decode the JSON response
$responseData = json_decode($response, true);

// Check if the API call was successful
if ($responseData["status"] === "COMPLETED") {
    // API call was successful
    // Access the response data as needed
    $txnStatus = $responseData["result"]["txnStatus"];
    $orderId = $responseData["result"]["orderId"];
    $status = $responseData["result"]["status"];
    $amount = $responseData["result"]["amount"];
    $date = $responseData["result"]["date"];
    $utr = $responseData["result"]["utr"];
    $senderNote=$user;

} else {
    // API call failed
    $errorMessage = $responseData["message"];
    echo "API Error: $errorMessage";
}

if ($status=="SUCCESS"){    
    
    $sql = "UPDATE users
    SET balance = balance + $amount
    WHERE username = '$senderNote'";

    if ($conn->query($sql) === TRUE) {
        echo "Balance updated successfully.";
    } else {
        echo "Error updating balance: " . $conn->error;
    }

    // Insert into recharge table
    $datetime = date('Y-m-d H:i:s'); // Current date and time
    $insertSql = "INSERT INTO recharge (username, recharge, status, created_at, utr)
          VALUES ('$senderNote', $amount, 'Success', '$datetime', '$utr')";

    // Add bonus logic
    $username = $senderNote;

    $win = "SELECT refcode FROM users WHERE  username='$senderNote' ";
    $result3 = $conn->query($win);
    $row3 = mysqli_fetch_assoc($result3);
    $refcode = $row3['refcode'];

    $opt = "SELECT SUM(recharge) as total FROM recharge WHERE username='$username' AND status='Success'";
    $optres = $conn->query($opt);
    $sum = mysqli_fetch_assoc($optres);

    if ($sum['total'] == "" or $sum['total'] == "0") {
        if ($amount >= 1 && $amount < 1000) {
            $bonus = 150;
        } elseif ($amount >= 1000 && $amount < 3000) {
            $bonus = 200;
        } elseif ($amount >= 3000 && $amount < 4000) {
            $bonus = 400;
        } elseif ($amount >= 4000 && $amount < 5000) {
            $bonus = 500;
        } elseif ($amount >= 5000 && $amount < 10000) {
            $bonus = 600;
        } elseif ($amount >= 10000) {
            $bonus = 1100;
        }

        $adb = "UPDATE users SET balance= balance +$bonus WHERE usercode='$refcode'";
        $conn->query($adb);

        $addbrec = "INSERT INTO bonus (giver,usercode,amount,level) VALUES ('$username','$refcode','$bonus','6')";
        $conn->query($addbrec);
    }

    if ($conn->query($insertSql) === TRUE) {
        header("Location: /#/mine");
        exit; // Make sure
    } else {
        echo "Error inserting recharge record: " . $conn->error;
    }
} else {
    header("Location: /#/mine");
    exit; // Make sure
}

?>
