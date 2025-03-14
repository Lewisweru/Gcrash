<?php
require_once "conn.php";

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 1000');
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
    }

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
    }
    exit(0);
}

// OTP Removal: No need to fetch API key for sending OTP
if (isset($_GET['num'])) {
    $num = $_GET["num"];

    // OTP Removal: Skip OTP generation and insertion into the verify table

    // Instead of returning an OTP response, return a success message
    echo json_encode(["status" => "success", "message" => "User registration successful without OTP."]);
}
?>
