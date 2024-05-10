<?php
session_start(); // Start the session to get the current tenant_id

$host = 'localhost';
$dbname = 'iBalay_System';
$username = 'root';
$password = '';

// Connect to the database
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    error_log("Database connection failed: " . mysqli_connect_error(), 0);
    die("Connection failed. Please try again later.");
}

// Get the current tenant ID
$tenant_id = $_SESSION['tenant_id']; // Assuming tenant_id is stored in the session

// Get the room_id from the AJAX request
$room_id = isset($_POST['room_id']) ? (int) $_POST['room_id'] : 0;

$response = [
    'success' => false,
    'bookmarked' => false
];

// Check if the bookmark already exists
$query = "SELECT * FROM bookmark WHERE tenant_id = ? AND room_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'ii', $tenant_id, $room_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    // Bookmark exists, remove it
    $delete_query = "DELETE FROM bookmark WHERE tenant_id = ? AND room_id = ?";
    $delete_stmt = mysqli_prepare($conn, $delete_query);
    mysqli_stmt_bind_param($delete_stmt, 'ii', $tenant_id, $room_id);
    if (mysqli_stmt_execute($delete_stmt)) {
        $response['success'] = true;
        $response['bookmarked'] = false; // Unbookmarked
    }
} else {
    // Bookmark doesn't exist, add it
    $insert_query = "INSERT INTO bookmark (tenant_id, room_id, created_at) VALUES (?, ?, NOW())";
    $insert_stmt = mysqli_prepare($conn, $insert_query);
    mysqli_stmt_bind_param($insert_stmt, 'ii', $tenant_id, $room_id);
    if (mysqli_stmt_execute($insert_stmt)) {
        $response['success'] = true;
        $response['bookmarked'] = true; // Bookmarked
    }
}

echo json_encode($response); // Return the response as JSON
mysqli_close($conn); // Close the connection
?>