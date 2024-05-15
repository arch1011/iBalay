TODO

<?php
session_start(); // Start the session if not already started

// Check if LandlordID is set in the session
if (!isset($_SESSION['landlord_id'])) {
    // Redirect or handle the case where LandlordID is not set
    exit('landlord_id not set in session');
}

$host = 'localhost';
$dbname = 'iBalay_System';
$username = 'root';
$password = '';

// Create a connection using MySQLi
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check for successful connection
if (!$conn) {
    error_log("Database connection failed: " . mysqli_connect_error(), 0);
    die("Database connection failed. Please try again later.");
}

// Set character set to UTF-8
mysqli_set_charset($conn, 'utf8');

// Get the landlord ID from the session
$landlord_id = $_SESSION['landlord_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input data
    $tenant_id = isset($_POST['tenant_id']) ? intval($_POST['tenant_id']) : null;
    $payment_date = isset($_POST['payment_date']) ? $_POST['payment_date'] : null;
    $new_due_date = isset($_POST['new_due_date']) ? $_POST['new_due_date'] : null;
    $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : null;

    if ($tenant_id && $payment_date && $new_due_date && $amount) {
        // Insert new payment data into tenant_payments table
        $stmt = $conn->prepare("INSERT INTO tenant_payments (TenantID, payment_date, amount) VALUES (?, ?, ?)");
        $stmt->bind_param("issd", $tenant_id, $payment_date, $amount);

        if ($stmt->execute()) {
            // Update the end_date in the rented_rooms table
            $stmt_update = $conn->prepare("UPDATE rented_rooms SET end_date = ? WHERE TenantID = ?");
            $stmt_update->bind_param("si", $new_due_date, $tenant_id);

            if ($stmt_update->execute()) {
                echo "Payment recorded and due date updated successfully.";
            } else {
                echo "Error updating due date: " . $stmt_update->error;
            }

            $stmt_update->close();
        } else {
            echo "Error recording payment: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid input data.";
    }
}

// Close the database connection
$conn->close();
?>
