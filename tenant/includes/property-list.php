<div class="section">
      <div class="container">
        <div class="row mb-5 align-items-center">
          <div class="col-lg-6">
            <h2 class="font-weight-bold text-primary heading">
              Popular Properties
            </h2>
          </div>
          <div class="col-lg-6 text-lg-end">
            <p>
              <a
                href="#"
                target="_blank"
                class="btn btn-primary text-white py-3 px-4"
                style="margin-bottom: -10px;"
                >View all properties</a
              >
            </p>
          </div>
        </div>

        <?php
$host = 'localhost';
$dbname = 'iBalay_System';
$username = 'root';
$password = '';

// Create a connection using MySQLi
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check for successful connection
if (!$conn) {
    error_log("Database connection failed: " . mysqli_connect_error(), 0);
    die("Connection failed. Please try again later.");
}

// Set character set to UTF-8
mysqli_set_charset($conn, 'utf8');

// Fetch rooms with their associated building information
$query = "
    SELECT 
        r.room_id,
        r.room_photo1,
        r.room_price,
        r.capacity,
        r.landlord_id,
        r.room_number,
        b.BH_address,
        b.number_of_kitchen,
        r.description
    FROM 
        room r
    JOIN 
        bh_information b
    ON 
        r.landlord_id = b.landlord_id
";

// Prepare and execute the query
$result = mysqli_query($conn, $query);

// Check for query errors
if (!$result) {
    error_log("Query failed: " . mysqli_error($conn), 0);
    die("Error fetching data. Please try again later.");
}

// Fetch all results
$rooms = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result); // Free the result set
mysqli_close($conn); // Close the connection
?>

<!-- CSS to set consistent image size -->
<style>
.property-item .img {
    margin-top: -125px;
    height: 400px; /* Adjust as needed */
    overflow: hidden; /* Hide overflow to ensure consistency */
    display: flex;
    justify-content: center;
    align-items: center;
}

.property-item .img img {
    max-height: 100%; /* Keep images within the defined height */
    max-width: 100%; /* Ensure images don't exceed the container */
    object-fit: cover; /* Maintain aspect ratio while filling the container */
}
</style>

<div class="row">
  <div class="col-12">
    <div class="property-slider-wrap">
      <div class="property-slider">
        <?php foreach ($rooms as $room): ?>
          <div class="property-item">
            <a href="property-single.php?room_id=<?= $room['room_id'] ?>" class="img">
              <img src="<?= "/iBalay/uploads/roomphotos/room{$room['room_number']}_landlord{$room['landlord_id']}/{$room['room_photo1']}" ?>" alt="Image" class="img-fluid" />
            </a>

            <div class="property-content">
              <div class="price mb-2">
                <span><?= "Room price: ₱ " . number_format($room['room_price'], 2) ?></span> <!-- Displaying the room price -->
              </div>
              <div>
                <span class="d-block mb-2 text-black-50"><?= $room['BH_address'] ?></span> <!-- Displaying the building address -->
                <div class="specs d-flex mb-4">
                  <span class="d-block d-flex align-items-center me-3">
                    <span class="icon-bed me-2"></span>
                    <span class="caption"><?= $room['capacity'] ?> beds availabe</span>
                  </span>
                  <span class="d-block d-flex align-items-center">
                    <span class="icon-kitchen me-2"></span>
                    <span class="caption"><?= $room['number_of_kitchen'] ?> kitchen(s)</span>
                  </span>
                </div>

                <a href="property-single.php?room_id=<?= $room['room_id'] ?>" class="btn btn-primary py-2 px-3">See details</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div
        id="property-nav"
        class="controls"
        tabindex="0"
        aria-label="Carousel Navigation"
      >
        <span
          class="prev"
          data-controls="prev"
          aria-controls="property"
          tabindex="-1"
          >Prev</span>
        
        <span
          class="next"
          data-controls="next"
          aria-controls="property"
          tabindex="-1"
          >Next</span>
        
      </div>
    </div>
  </div>
</div>



</div>
    </div>




<!--
<div class="section">
      <div class="container">
        <div class="row mb-5 align-items-center">
          <div class="col-lg-6">
            <h2 class="font-weight-bold text-primary heading">
              Popular Properties
            </h2>
          </div>
          <div class="col-lg-6 text-lg-end">
            <p>
              <a
                href="#"
                target="_blank"
                class="btn btn-primary text-white py-3 px-4"
                >View all properties</a
              >
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="property-slider-wrap">
              <div class="property-slider">
                <div class="property-item">
                  <a href="property-single.html" class="img">
                    <img src="../Resources/images/img_1.jpg" alt="Image" class="img-fluid" />
                  </a>

                  <div class="property-content">
                    <div class="price mb-2"><span>$1,291,000</span></div>
                    <div>
                      <span class="d-block mb-2 text-black-50"
                        >5232 California Fake, Ave. 21BC</span
                      >
                      <span class="city d-block mb-3">California, USA</span>

                      <div class="specs d-flex mb-4">
                        <span class="d-block d-flex align-items-center me-3">
                          <span class="icon-bed me-2"></span>
                          <span class="caption">2 beds</span>
                        </span>
                        <span class="d-block d-flex align-items-center">
                          <span class="icon-bath me-2"></span>
                          <span class="caption">2 baths</span>
                        </span>
                      </div>

                      <a
                        href="property-single.html"
                        class="btn btn-primary py-2 px-3"
                        >See details</a
                      >
                    </div>
                  </div>
                </div>
          

                <div class="property-item">
                  <a href="property-single.html" class="img">
                    <img src="../Resources/images/img_2.jpg" alt="Image" class="img-fluid" />
                  </a>

                  <div class="property-content">
                    <div class="price mb-2"><span>$1,291,000</span></div>
                    <div>
                      <span class="d-block mb-2 text-black-50"
                        >5232 California Fake, Ave. 21BC</span
                      >
                      <span class="city d-block mb-3">California, USA</span>

                      <div class="specs d-flex mb-4">
                        <span class="d-block d-flex align-items-center me-3">
                          <span class="icon-bed me-2"></span>
                          <span class="caption">2 beds</span>
                        </span>
                        <span class="d-block d-flex align-items-center">
                          <span class="icon-bath me-2"></span>
                          <span class="caption">2 baths</span>
                        </span>
                      </div>

                      <a
                        href="property-single.html"
                        class="btn btn-primary py-2 px-3"
                        >See details</a
                      >
                    </div>
                  </div>
                </div>
          

              </div>

              <div
                id="property-nav"
                class="controls"
                tabindex="0"
                aria-label="Carousel Navigation"
              >
                <span
                  class="prev"
                  data-controls="prev"
                  aria-controls="property"
                  tabindex="-1"
                  >Prev</span
                >
                <span
                  class="next"
                  data-controls="next"
                  aria-controls="property"
                  tabindex="-1"
                  >Next</span
                >
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
-->