<?php

$host = 'localhost';
$dbname = 'iBalay_System';
$username = 'root';
$password = '';

// Connect to the database using MySQLi
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check for successful connection
if (!$conn) {
    error_log("Database connection failed: " . mysqli_connect_error(), 0);
    die("Connection failed. Please try again later.");
}

// Set character set to UTF-8
mysqli_set_charset($conn, 'utf8');

// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$tenant_id = $_SESSION['TenantID'];

// Query to fetch room details
$query = "SELECT r.*, bh.BH_address, bh.BH_name, t.FirstName, t.LastName, rr.room_id, rr.landlord_id, rr.start_date, rr.end_date
          FROM rented_rooms rr
          INNER JOIN room r ON rr.room_id = r.room_id
          INNER JOIN tenant t ON rr.TenantID = t.TenantID
          INNER JOIN bh_information bh ON r.landlord_id = bh.landlord_id
          WHERE rr.TenantID = $tenant_id";

$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $room = mysqli_fetch_assoc($result); // Fetch room details
    // Construct the relative path to the room photos directory
    $room_directory = "/iBalay/uploads/roomphotos/room{$room['room_number']}_landlord{$room['landlord_id']}/";
    // Construct the image paths relative to the document root
    $image_path1 = $room_directory . htmlspecialchars($room['room_photo1']); 
    $image_path2 = $room_directory . htmlspecialchars($room['room_photo2']);
} else {
    // Handle error if no room is found for the tenant
    echo "Error: No room found for the tenant.";
    exit; // Stop execution
}

// Close the result set
mysqli_free_result($result);
?>

<!-- HTML Structure for Displaying Room Information -->
<div class="hero page-inner overlay" style="background-image: url('../../Resources/images/hero_bg_1_copy.jpg')">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5">
                <h1 class="heading" data-aos="fade-up"><?= htmlspecialchars($room['BH_name']) ?></h1>
                <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                    <ol class="breadcrumb text-center justify-content-center">
                        <li class="breadcrumb-item"><a href="/iBalay/tenant/public/home.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">My Room</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page"><?= htmlspecialchars($room['BH_address']) ?></li>
                    </ol>
                </nav>
            </div> 
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-7">
                <div class="img-property-slide-wrap">
                    <div class="img-property-slide">
                        <img src="<?= $image_path1 ?>" alt="Room Photo 1" class="img-fluid" />
                        <img src="<?= $image_path2 ?>" alt="Room Photo 2" class="img-fluid" />
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <h2 class="heading text-primary">Price: ₱ <?= htmlspecialchars($room['room_price']) ?></h2>
                <p class="meta">Payment Date: <?= htmlspecialchars($room['start_date']) ?></p>
                <p class="meta">Room Due Date: <?= htmlspecialchars($room['end_date']) ?></p>
                
                <hr>

            <!-- Add buttons for sending report and adding review -->
            <div class="buttons">
                        <!-- Send Report Button -->
                        <form id="reportForm" action="../includes/config/report-action.php" method="post" style="display: inline-block;">
                            <input type="hidden" name="room_id" value="<?= $room['room_id'] ?>" />
                            <button id="reportButton" type="submit" class="btn btn-outline-danger" title="Send report">
                                <i class="fa fa-flag"></i> Send Report
                            </button>
                        </form>
<!-- Add Review Button -->
<button id="reviewButton" type="button" class="btn btn-primary" onclick="$('#addReviewModal').modal('show');" title="Add review">
    <i class="fa fa-calendar"></i> Add Review
</button>

             </div


            </div>
        </div>
    </div>
</div>


<!-- Add Review Modal -->
<div class="modal fade" id="addReviewModal" tabindex="-1" role="dialog" aria-labelledby="addReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addReviewModalLabel">Add Review</h5>
            </div>
            <form id="addReviewForm" action="../includes/config/add-review-action.php" method="post">
                <div class="modal-body">
                    <!-- Room ID -->
                    <input type="hidden" name="room_id" value="<?= $room['room_id'] ?>" />
                    
                    <!-- Review Comment -->
                    <div class="form-group">
                        <label for="reviewComment">Review Comment</label>
                        <textarea class="form-control" id="reviewComment" name="review_comment" rows="3" required></textarea>
                    </div>
                    
                    <!-- Room Rating -->
                    <div class="form-group">
                        <label for="roomRating">Room Rating</label>
                        <input type="number" class="form-control" id="roomRating" name="room_rating" min="1" max="5" required>
                    </div>
                    
                    <!-- BH Rating -->
                    <div class="form-group">
                        <label for="bhRating">Bathroom Rating</label>
                        <input type="number" class="form-control" id="bhRating" name="bh_rating" min="1" max="5" required>
                    </div>
                    
                    <!-- CR Rating -->
                    <div class="form-group">
                        <label for="crRating">CR Rating</label>
                        <input type="number" class="form-control" id="crRating" name="cr_rating" min="1" max="5" required>
                    </div>
                    
                    <!-- Beds Rating -->
                    <div class="form-group">
                        <label for="bedsRating">Beds Rating</label>
                        <input type="number" class="form-control" id="bedsRating" name="beds_rating" min="1" max="5" required>
                    </div>
                    
                    <!-- Kitchen Rating -->
                    <div class="form-group">
                        <label for="kitchenRating">Kitchen Rating</label>
                        <input type="number" class="form-control" id="kitchenRating" name="kitchen_rating" min="1" max="5" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </div>
            </form>
        </div>
    </div>
</div>
