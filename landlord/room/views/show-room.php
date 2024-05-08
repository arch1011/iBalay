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

            <table class="datatable table table-striped table-bordered">
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

    <div class="modal fade" id="roomDetailsModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Room Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="roomDetailsContent">
                    <!-- Content to be loaded dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div><!-- End Room Details Modal -->

</main><!-- End #main -->

<!-- JavaScript to Populate the Modal -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("roomDetailsModal");

    modal.addEventListener("show.bs.modal", function(event) {
        const button = event.relatedTarget;
        const roomDetails = JSON.parse(button.getAttribute("data-room-details"));

        const roomNumber = roomDetails.room_number;
        const landlordId = roomDetails.landlord_id;

        const photo1 = `/iBalay/uploads/roomphotos/room${roomNumber}_landlord${landlordId}/${roomDetails.room_photo1}`;
        const photo2 = `/iBalay/uploads/roomphotos/room${roomNumber}_landlord${landlordId}/${roomDetails.room_photo2}`;

        const carousel = `
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="${photo1}" class="d-block w-100" alt="Room Photo 1">
                    </div>
                    <div class="carousel-item">
                        <img src="${photo2}" class="d-block w-100" alt="Room Photo 2">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        `;

        const roomInfo = `
            <h5>Room ${roomNumber}</h5>
            <p>Description: ${roomDetails.description}</p>
            <p>Capacity: ${roomDetails.capacity}</p>
            <p>Price: $${roomDetails.room_price}</p>
        `;

        document.getElementById("roomDetailsContent").innerHTML = carousel + roomInfo;
    });

    new simpleDatatables.DataTable(".datatable");
});
</script>
