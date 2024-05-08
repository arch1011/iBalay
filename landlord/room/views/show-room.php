<?php
// Database configuration
include('../../database/config.php');

// Start the session and get the landlord_id
session_start();

if (!isset($_SESSION['landlord_id'])) {
    header('Location: /iBalay/landlord/authlog/login.php');
    exit;
}

$landlord_id = $_SESSION['landlord_id'];

// Fetch room data for the current landlord
$query = "SELECT room_id, room_number, description, capacity, room_price, room_photo1, room_photo2, landlord_id FROM room WHERE landlord_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $landlord_id);

$rooms = [];

if ($stmt->execute()) {
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }
} else {
    echo "Error retrieving rooms: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Your Boarding House!</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Room List</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Room List</h5>

            <table class="datatable">
                <thead>
                    <tr>
                        <th>Room Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($rooms)): ?>
                        <?php foreach ($rooms as $room): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($room['room_number']); ?></td>
                                <td>
                                    <button class="btn btn-primary" data-bs-toggle="modal" 
                                            data-bs-target="#roomDetailsModal" 
                                            data-room-details='<?php echo json_encode($room); ?>'>
                                        View
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2">No rooms available. Add some rooms!</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div><!-- End card -->


                    <?php
                    include('views/modal-room.php');
                    ?>

</main><!-- End #main -->

<!-- JavaScript to Populate the Modal -->
<script src="views/tasks/fetch-room.js"></script>
