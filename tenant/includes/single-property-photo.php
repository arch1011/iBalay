       <?php 
         include('config/single-photo.php');
       ?>

<!-- HTML Structure for Displaying Room Information -->
<div
  class="hero page-inner overlay"
  style="background-image: url('../../Resources/images/hero_bg_1_copy.jpg')"
>
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-9 text-center mt-5">
        <h1 class="heading" data-aos="fade-up">
          <?= $room ? htmlspecialchars($room['BH_address']) : "Property Not Found" ?>
        </h1>

        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
          <ol class="breadcrumb text-center justify-content-center">
            <li class="breadcrumb-item"><a href="/iBalay/tenant/public/home.php">Home</a></li>
            <li class="breadcrumb-item"><a href="/iBalay/tenant/public/properties.php">Properties</a></li>
            <li class="breadcrumb-item active text-white-50" aria-current="page">
              <?= $room ? htmlspecialchars($room['BH_address']) : "Property Not Found" ?>
            </li>
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
            <img src="<?= htmlspecialchars($image_path1) ?>" alt="Room Photo 1" class="img-fluid" />
            <img src="<?= htmlspecialchars($image_path2) ?>" alt="Room Photo 2" class="img-fluid" />
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <h2 class="heading text-primary">Price: ₱ <?= htmlspecialchars($room['room_price']) ?></h2>
        <p class="meta">Location: <?= htmlspecialchars($room['BH_address']) ?></p>

        <!-- Room description -->
        <p class="text-black-50"><?= htmlspecialchars($room['room_description']) ?></p>

        <div class="specs d-flex mb-4">
          <span class="d-block d-flex align-items-center me-3">
            <span class="icon-bed me-2"></span>
            <span class="caption"><?= $room['capacity'] ?> beds available</span>
          </span>
          <span class="d-block d-flex align-items-center">
            <span class="icon-kitchen me-2"></span>
            <span class="caption"><?= $room['number_of_kitchen'] ?> kitchen(s)</span>
          </span>
        </div>


<!-- Add buttons for bookmarking and reserving -->
<div class="buttons">
    <!-- Bookmark Button -->
    <?php if (isset($room) && isset($room['room_id'])): ?>
        <form id="bookmarkForm" action="../includes/config/bookmark-process.php" method="post" style="display: inline-block;">
            <input type="hidden" name="room_id" value="<?= $room['room_id'] ?>" />
            <button id="bookmarkButton" type="submit" class="btn btn-outline-primary" title="Bookmark this room">
                <i class="fa fa-bookmark"></i> Bookmark
            </button>
        </form>
    <?php endif; ?>

    <!-- Reserve Button -->
    <form action="reserve_action.php" method="post" style="display: inline-block;">
        <?php if (isset($room) && isset($room['room_id'])): ?>
            <input type="hidden" name="room_id" value="<?= $room['room_id'] ?>" />
        <?php endif; ?>
        <button type="submit" class="btn btn-primary" title="Reserve this room">
            <i class="fa fa-calendar-check"></i> Reserve
        </button>
    </form>
</div>


<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success!</h5>
            </div>
            <div class="modal-body">
                <p id="successMessage"></p>
            </div>
        </div>
    </div>
</div>

<!-- Already Reserved Modal -->
<div class="modal fade" id="bookmarkedModal" tabindex="-1" role="dialog" aria-labelledby="bookmakredModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookmakredModalLabel">Room Already bookmakred!</h5>
            </div>
            <div class="modal-body">
                <p>You Already bookmarked this Room.</p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add an event listener to the form submission
    document.getElementById('bookmarkForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission
        document.getElementById('bookmarkButton').disabled = true; // Disable the button to prevent rapid clicks
        var formData = new FormData(this);
        fetch('../includes/config/bookmark-process.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // If bookmarking was successful, display success message in modal
                document.getElementById('successMessage').textContent = data.message;
                $('#successModal').modal('show'); // Show the success modal using jQuery
            } else {
                // If bookmarking failed, check if the room is already reserved
                if (data.message === 'Room already reserved') {
                    $('#bookmarkedModal').modal('show'); // Show the reserved modal using jQuery
                } else {
                  $('#bookmarkedModal').modal('show'); 
                }
            }
            document.getElementById('bookmarkButton').disabled = false; // Re-enable the button
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('bookmarkButton').disabled = false; // Re-enable the button in case of error
        });
    });
});
</script>