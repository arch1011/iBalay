<?php
// Include database connection script
include('../../database/config.php');

// Retrieve form data
$tenant_id = $_POST['tenant_id'];
$room_id = $_POST['room_id'];
$landlord_id = $_POST['landlord_id'];
$room_price = $_POST['room_price'];
$payment = $_POST['payment'];
$due_date = $_POST['due_date'];

// Insert record into rented_rooms table
$query1 = "INSERT INTO rented_rooms (room_id, TenantID, landlord_id, start_date, end_date) 
           VALUES (?, ?, ?, CURDATE(), ?)";

$stmt1 = mysqli_prepare($conn, $query1);

if ($stmt1) {
    // Calculate end date (due date) based on due_date input
    $end_date = date('Y-m-d', strtotime($due_date . ' +1 month'));

    // Bind parameters
    mysqli_stmt_bind_param($stmt1, "iiis", $room_id, $tenant_id, $landlord_id, $end_date);

    // Execute the statement
    mysqli_stmt_execute($stmt1);

    // Close the statement
    mysqli_stmt_close($stmt1);
} else {
    echo "Error: " . mysqli_error($conn);
}

// Insert record into tenant_payments table
$query2 = "INSERT INTO tenant_payments (rented_id, TenantID, room_id, landlord_id, payment_date, amount) 
           VALUES (LAST_INSERT_ID(), ?, ?, ?, CURDATE(), ?)";

$stmt2 = mysqli_prepare($conn, $query2);

if ($stmt2) {
    // Bind parameters
    mysqli_stmt_bind_param($stmt2, "iiid", $tenant_id, $room_id, $landlord_id, $payment);

    // Execute the statement
    mysqli_stmt_execute($stmt2);

    // Close the statement
    mysqli_stmt_close($stmt2);
} else {
    echo "Error: " . mysqli_error($conn);
}

// Decrement room capacity by 1
$query3 = "UPDATE room SET capacity = capacity - 1 WHERE room_id = ?";
$stmt3 = mysqli_prepare($conn, $query3);
if ($stmt3) {
    mysqli_stmt_bind_param($stmt3, "i", $room_id);
    mysqli_stmt_execute($stmt3);
    mysqli_stmt_close($stmt3);
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);

// Redirect to landlord dashboard after successful renting
header("Location: /iBalay/landlord/dashboard/home.php");
exit;
?>
