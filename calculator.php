<!DOCTYPE html>
<?php
session_start();

// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'umrah2';
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle AJAX Requests
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');

    if ($_POST['action'] == 'fetch_hotels') {
        $locationID = intval($_POST['locationID']);
        $stmt = $conn->prepare("SELECT id, hotelName FROM hotels WHERE location_id = ?");
        $stmt->bind_param("i", $locationID);
        $stmt->execute();
        $result = $stmt->get_result();
        $hotels = [];
        while ($row = $result->fetch_assoc()) {
            $hotels[] = ['id' => $row['id'], 'name' => $row['hotelName']];
        }
        $stmt->close();
        echo json_encode($hotels);
        exit;
    }

    if ($_POST['action'] == 'fetch_rooms') {
        $hotelID = intval($_POST['hotelID']);
        $stmt = $conn->prepare("SELECT id, type, price FROM rooms WHERE hotel_id = ?");
        $stmt->bind_param("i", $hotelID);
        $stmt->execute();
        $result = $stmt->get_result();
        $rooms = [];
        while ($row = $result->fetch_assoc()) {
            $rooms[] = ['id' => $row['id'], 'type' => $row['type'], 'price' => $row['price']];
        }
        $stmt->close();
        echo json_encode($rooms);
        exit;
    }

    if ($_POST['action'] == 'fetch_sector_cost') {
        $sectorID = intval($_POST['sectorID']);
        $stmt = $conn->prepare("SELECT cost FROM travel_sectors WHERE id = ?");
        $stmt->bind_param("i", $sectorID);
        $stmt->execute();
        $result = $stmt->get_result();
        $cost = $result->fetch_assoc()['cost'] ?? 0;
        $stmt->close();
        echo json_encode(['cost' => $cost]);
        exit;
    }

    if ($_POST['action'] == 'fetch_vehicle_cost') {
        $vehicleID = intval($_POST['vehicleID']);
        $stmt = $conn->prepare("SELECT cost_per_day FROM vehicle_types WHERE id = ?");
        $stmt->bind_param("i", $vehicleID);
        $stmt->execute();
        $result = $stmt->get_result();
        $cost = $result->fetch_assoc()['cost_per_day'] ?? 0;
        $stmt->close();
        echo json_encode(['cost' => $cost]);
        exit;
    }
}

// Fetch initial data
$locations = $conn->query("SELECT id, locationName FROM locations")->fetch_all(MYSQLI_ASSOC);
$sectors = $conn->query("SELECT id, sector_name, cost FROM travel_sectors")->fetch_all(MYSQLI_ASSOC);
$vehicles = $conn->query("SELECT id, type_name, cost_per_day FROM vehicle_types")->fetch_all(MYSQLI_ASSOC);
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayuni Travel - Umrah Booking</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .room-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .room-option {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .room-option:last-child {
            border-bottom: none;
        }
        .room-counter {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .room-counter button {
            width: 30px;
            height: 30px;
            border-radius: 5px;
        }
        .total-cost {
            margin-top: 20px;
            font-weight: bold;
            font-size: 1.2em;
        }
        .error-message {
            color: red;
            margin-top: 10px;
            font-weight: bold;
        }
        .is-invalid {
            border-color: #dc3545 !important;
        }
        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
        }
        .date-error {
            color: red;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <?php
require_once 'header.php';
?>
  
<div class="container-fluid mt-5  mb-5">
    <form id="budgetForm" class="p-4 border rounded bg-light" method="POST">
        <div class="row bg-info border shadow p-3">
            <div class="col-lg-3">
                <label for="location" class="form-label">Select Location</label>
                <select id="location" name="location" class="form-select" required>
                    <option value="">Select Location</option>
                    <?php foreach ($locations as $loc) { ?>
                        <option value="<?= $loc['id'] ?>"><?= htmlspecialchars($loc['locationName']) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-lg-3">
                <label for="hotel" class="form-label">Select Hotel</label>
                <select id="hotel" name="hotel" class="form-select" required>
                    <option value="">Select Location First</option>
                </select>
            </div>
            <div class="col-lg-3">
                <label for="checkin" class="form-label">Check-in Date</label>
                <input type="text" id="checkin" name="checkin" class="form-control" required>
                <div class="invalid-feedback">Please select a valid check-in date</div>
            </div>
            <div class="col-lg-3">
                <label for="checkout" class="form-label">Check-out Date</label>
                <input type="text" id="checkout" name="checkout" class="form-control" required>
                <div class="invalid-feedback">Check-out must be after check-in date</div>
            </div>
        </div>

        <div class="room-container" id="rooms-container">
            <p>Select a hotel to view available rooms</p>
        </div>

        <div class="row bg-info border shadow p-3 mt-3">
            <div class="col-lg-2">
                <div class="form-check mb-3">
                    <input type="checkbox" id="visa" name="visa" class="form-check-input">
                    <label for="visa" class="form-check-label">Umrah Visa</label>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-check mb-3">
                    <input type="checkbox" id="travel" name="travel" class="form-check-input">
                    <label for="travel" class="form-check-label">Include Travel</label>
                </div>
            </div>
            <div class="col-lg-4">
                <div id="travelOptions" style="display: none;">
                    <div class="mb-3">
                        <label for="sector" class="form-label">Sector</label>
                        <select id="sector" name="sector" class="form-select">
                            <option value="">Choose Sector</option>
                            <?php foreach ($sectors as $sector) { ?>
                                <option value="<?= $sector['id'] ?>" data-cost="<?= $sector['cost'] ?>"><?= htmlspecialchars($sector['sector_name']) ?> 
                                <!-- ($<?= $sector['cost'] ?>) -->
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="vehicle" class="form-label">Vehicle Type</label>
                        <select id="vehicle" name="vehicle" class="form-select">
                            <option value="">Choose Vehicle</option>
                            <?php foreach ($vehicles as $vehicle) { ?>
                                <option value="<?= $vehicle['id'] ?>" data-cost="<?= $vehicle['cost_per_day'] ?>"><?= htmlspecialchars($vehicle['type_name']) ?>
                                 <!-- ($<?= $vehicle['cost_per_day'] ?>/day) -->
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 ">
                <div class="dropdown">
                    <label for="travelers">Travelers</label>
                    <input id="travelerCount" name="total_travelers" class="form-control" value="1" readonly>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">Select Travelers</button>
                    <ul class="dropdown-menu p-3">
                        <li>
                            <span>Adults</span>
                            <div class="counter">
                                <span class="minus" data-type="adults">-</span>
                                <span class="num" id="adults">1</span>
                                <span class="plus" data-type="adults">+</span>
                            </div>
                        </li>
                        <li>
                            <span>Children</span>
                            <div class="counter">
                                <span class="minus" data-type="children">-</span>
                                <span class="num" id="children">0</span>
                                <span class="plus" data-type="children">+</span>
                            </div>
                        </li>
                        <li>
                            <span>Infants</span>
                            <div class="counter">
                                <span class="minus" data-type="infants">-</span>
                                <span class="num" id="infants">0</span>
                                <span class="plus" data-type="infants">+</span>
                            </div>
                        </li>
                        <li>
                            <button type="button" class="btn btn-sm btn-primary done-btn">Done</button>
                        </li>
                        <input type="hidden" name="adults" id="input_adults" value="1">
                        <input type="hidden" name="children" id="input_children" value="0">
                        <input type="hidden" name="infants" id="input_infants" value="0">
                    </ul>
                </div>
            </div>
        </div>

        <div class="row mt-3 ">
            <div class="col-lg-4">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
                <label>Contact</label>
                <input type="text" id="phone" class="form-control" name="phone" placeholder="e.g. 03001234567" required>
                <small class="text-danger" id="phoneError" style="display:none;">Invalid Pakistani phone number</small>
            </div>
            <!-- <div class="col-lg-8">
                <div class="total-cost">
                    Total Cost: $<span id="total-cost">0.00</span>
                </div>
            </div> -->
        </div>

        <div class="mt-3">
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" class="btn btn-success">Book Now</button>
        </div>
    </form>
</div>

<div class="modal fade" id="resultModal" tabindex="-1">
    <div class="modal-dialog modal-xl" >
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Booking Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="budgetResult"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.print();">Print</button>
                <button type="button" class="btn btn-success" onclick="openWhatsApp()">WhatsApp</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize Flatpickr with date validation
    let checkinPicker = flatpickr("#checkin", {
        dateFormat: "Y-m-d",
        minDate: "today",
        onChange: function(selectedDates, dateStr) {
            // Set minDate for checkout to the day after checkin
            let nextDay = new Date(selectedDates[0]);
            nextDay.setDate(nextDay.getDate() + 1);
            checkoutPicker.set("minDate", nextDay);
            
            // If current checkout is invalid, clear it
            if (checkoutPicker.selectedDates[0] && checkoutPicker.selectedDates[0] <= selectedDates[0]) {
                checkoutPicker.clear();
                $('#checkout').addClass('is-invalid').next('.invalid-feedback').show();
            } else {
                $('#checkout').removeClass('is-invalid').next('.invalid-feedback').hide();
            }
            updateTotalCost();
        }
    });

    let checkoutPicker = flatpickr("#checkout", {
        dateFormat: "Y-m-d",
        minDate: new Date().fp_incr(1), // Tomorrow as minimum
        onChange: function(selectedDates, dateStr) {
            let checkin = $('#checkin').val();
            if (checkin) {
                let checkinDate = new Date(checkin);
                if (selectedDates[0] <= checkinDate) {
                    $('#checkout').addClass('is-invalid').next('.invalid-feedback').show();
                } else {
                    $('#checkout').removeClass('is-invalid').next('.invalid-feedback').hide();
                }
            }
            updateTotalCost();
        }
    });

    // Fetch hotels
    $('#location').change(function() {
        let locationID = $(this).val();
        $('#hotel').prop('disabled', true).html('<option value="">Loading...</option>');
        $('#rooms-container').html('<p>Select a hotel to view available rooms</p>');

        if (locationID) {
            $.ajax({
                url: '',
                type: 'POST',
                data: { locationID: locationID, action: 'fetch_hotels' },
                dataType: 'json',
                success: function(hotels) {
                    $('#hotel').html('<option value="">Choose Hotel</option>').prop('disabled', false);
                    if (hotels.length > 0) {
                        hotels.forEach(hotel => {
                            $('#hotel').append(`<option value="${hotel.id}">${hotel.name}</option>`);
                        });
                    } else {
                        $('#hotel').html('<option value="">No hotels available</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Hotel fetch error:', status, error);
                    $('#hotel').html('<option value="">Error loading hotels</option>').prop('disabled', false);
                }
            });
        } else {
            $('#hotel').html('<option value="">Select Location First</option>').prop('disabled', false);
        }
    });

    // Fetch rooms
    $('#hotel').change(function() {
        let hotelID = $(this).val();
        $('#rooms-container').html('<p>Loading rooms...</p>');

        if (hotelID) {
            $.ajax({
                url: '',
                type: 'POST',
                data: { hotelID: hotelID, action: 'fetch_rooms' },
                dataType: 'json',
                success: function(rooms) {
                    $('#rooms-container').empty();
                    if (rooms.length > 0) {
                        let roomList = $('<div>');
                        rooms.forEach(room => {
                            let roomDiv = $('<div>').addClass('room-option');
                            roomDiv.append(`
                                <span>${room.type}   </span>
                                <div class="room-counter">
                                    <button type="button" class="btn btn-sm btn-danger decrement">-</button>
                                    <span class="quantity" data-room-id="${room.id}" data-price="${room.price}">0</span>
                                    <button type="button" class="btn btn-sm btn-success increment">+</button>
                                </div>
                            `);
                            roomList.append(roomDiv);
                        });
                        $('#rooms-container').append(roomList);
                    } else {
                        $('#rooms-container').html('<p>No rooms available</p>');
                    }
                    updateTotalCost();
                },
                error: function(xhr, status, error) {
                    console.error('Room fetch error:', status, error);
                    $('#rooms-container').html('<p class="error-message">Error loading rooms</p>');
                }
            });
        }
    });

     // Fetch rooms
    //  $('#hotel').change(function() {
    //     let hotelID = $(this).val();
    //     $('#rooms-container').html('<p>Loading rooms...</p>');

    //     if (hotelID) {
    //         $.ajax({
    //             url: '',
    //             type: 'POST',
    //             data: { hotelID: hotelID, action: 'fetch_rooms' },
    //             dataType: 'json',
    //             success: function(rooms) {
    //                 $('#rooms-container').empty();
    //                 if (rooms.length > 0) {
    //                     let roomList = $('<div>');
    //                     rooms.forEach(room => {
    //                         let roomDiv = $('<div>').addClass('room-option');
    //                         roomDiv.append(`
    //                             <span>${room.type} 
    //                            /* //   - $${room.price}/night*/
    //                             </span>
    //                             <div class="room-counter">
    //                                 <button type="button" class="btn btn-sm btn-danger decrement">-</button>
    //                                 <span class="quantity" data-room-id="${room.id}" data-price="${room.price}">0</span>
    //                                 <button type="button" class="btn btn-sm btn-success increment">+</button>
    //                             </div>
    //                         `);
    //                         roomList.append(roomDiv);
    //                     });
    //                     $('#rooms-container').append(roomList);
    //                 } else {
    //                     $('#rooms-container').html('<p>No rooms available</p>');
    //                 }
    //                 updateTotalCost();
    //             },
    //             error: function(xhr, status, error) {
    //                 console.error('Room fetch error:', status, error);
    //                 $('#rooms-container').html('<p class="error-message">Error loading rooms</p>');
    //             }
    //         });
    //     }
    // });

    // Room quantity controls
    $('#rooms-container').on('click', '.increment', function() {
        let qtySpan = $(this).prev('.quantity');
        qtySpan.text(parseInt(qtySpan.text()) + 1);
        updateTotalCost();
    });

    $('#rooms-container').on('click', '.decrement', function() {
        let qtySpan = $(this).next('.quantity');
        let qty = parseInt(qtySpan.text());
        if (qty > 0) {
            qtySpan.text(qty - 1);
            updateTotalCost();
        }
    });

    // Calculate total cost with visa and travel
    function updateTotalCost() {
        let total = 0;
        let checkin = new Date($('#checkin').val());
        let checkout = new Date($('#checkout').val());
        let nights = (checkin && checkout && !isNaN(checkin) && !isNaN(checkout)) 
            ? Math.ceil((checkout - checkin) / (1000 * 60 * 60 * 24)) 
            : 1;
        let travelers = parseInt($('#travelerCount').val()) || 1;

        // Room costs
        $('.quantity').each(function() {
            let qty = parseInt($(this).text());
            let price = parseFloat($(this).data('price'));
            total += qty * price * nights;
        });

        // Visa cost ($541 per traveler) if checked
        if ($('#visa').is(':checked')) {
            total += 536 * travelers;
        }

        // Travel costs if checked
        if ($('#travel').is(':checked')) {
            let sectorCost = parseFloat($('#sector option:selected').data('cost')) || 0;
            let vehicleCostPerDay = parseFloat($('#vehicle option:selected').data('cost')) || 0;
            total += sectorCost + (vehicleCostPerDay * nights);
        }

        $('#total-cost').text(total.toFixed(2));
    }

    // Update total cost when visa or travel options change
    $('#visa, #travel, #sector, #vehicle').change(updateTotalCost);

    // Travel options toggle
    $('#travel').change(function() {
        $('#travelOptions').toggle(this.checked);
        updateTotalCost();
    });

    // Traveler counter
    let travelers = { adults: 1, children: 0, infants: 0 };
    function updateTravelerCount() {
        let total = travelers.adults + travelers.children + travelers.infants;
        $('#travelerCount').val(total);
        $('#input_adults').val(travelers.adults);
        $('#input_children').val(travelers.children);
        $('#input_infants').val(travelers.infants);
        updateTotalCost();
    }

    $('.plus').click(function() {
        let type = $(this).data('type');
        travelers[type]++;
        $('#' + type).text(travelers[type]);
        updateTravelerCount();
    });

    $('.minus').click(function() {
        let type = $(this).data('type');
        if (travelers[type] > (type === 'adults' ? 1 : 0)) {
            travelers[type]--;
            $('#' + type).text(travelers[type]);
            updateTravelerCount();
        }
    });

    $('.done-btn').click(function() {
        updateTravelerCount();
        $(this).closest('.dropdown-menu').removeClass('show');
    });

    // Form submission with date validation
    $('#budgetForm').submit(function(e) {
        e.preventDefault();
        
        // Reset validation
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').hide();
        
        // Validate dates
        let isValid = true;
        let checkin = $('#checkin').val();
        let checkout = $('#checkout').val();
        
        if (!checkin) {
            $('#checkin').addClass('is-invalid').next('.invalid-feedback').text('Please select check-in date').show();
            isValid = false;
        }
        
        if (!checkout) {
            $('#checkout').addClass('is-invalid').next('.invalid-feedback').text('Please select check-out date').show();
            isValid = false;
        }
        
        if (checkin && checkout) {
            let checkinDate = new Date(checkin);
            let checkoutDate = new Date(checkout);
            
            if (checkoutDate <= checkinDate) {
                $('#checkout').addClass('is-invalid').next('.invalid-feedback').text('Check-out must be after check-in date').show();
                isValid = false;
            }
        }
        
        if (!isValid) {
            return;
        }
        
        // Validate at least one room is selected
        let hasRooms = false;
        $('.quantity').each(function() {
            if (parseInt($(this).text()) > 0) {
                hasRooms = true;
                return false; // break loop
            }
        });
        
        // if (!hasRooms) {
        //     alert('Please select at least one room');
        //     return;
        // }
        
        // Prepare room selections
        let roomSelections = [];
        $('.quantity').each(function() {
            let qty = parseInt($(this).text());
            if (qty > 0) {
                roomSelections.push({
                    room_id: $(this).data('room-id'),
                    quantity: qty,
                    price: $(this).data('price')
                });
            }
        });

        // Submit form
        let formData = $(this).serialize() + '&rooms=' + encodeURIComponent(JSON.stringify(roomSelections));
        $.ajax({
            url: 'calculate_budget5.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#budgetResult').html(response);
                new bootstrap.Modal(document.getElementById('resultModal')).show();
            },
            error: function(xhr, status, error) {
                $('#budgetResult').html('<p class="error-message">Error: ' + status + '</p>');
                new bootstrap.Modal(document.getElementById('resultModal')).show();
            }
        });
    });

    // WhatsApp
    function openWhatsApp() {
        let phone = $('input[name="phone"]').val();
        let message = "Thank you for your Umrah booking with Ayuni Travel!";
        window.open(`https://wa.me/${phone}?text=${encodeURIComponent(message)}`, '_blank');
    }
});
</script>

<?php
    require_once 'footer.php';
?>

</body>
</html>