<?php
// index.php (Merged code using umrah3 and db_config.php)
require 'db_config.php';

// Ensure JSON response for AJAX requests
header('Content-Type: application/json');

// Handle AJAX request for locations
if (isset($_GET['get_locations'])) {
    $res = selectAll('locations');
    if (!$res) {
        echo json_encode(['error' => 'Failed to fetch locations: ' . mysqli_error($GLOBALS['con'])]);
        exit;
    }
    $locations = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $locations[] = [
            'id' => $row['id'],
            'name' => $row['locationName']
        ];
    }
    echo json_encode($locations);
    exit;
}

// Fetch hotels based on location_id
if (isset($_POST['action']) && $_POST['action'] == 'fetch_hotels') {
    $location_id = filteration(['location_id' => $_POST['locationID']])['location_id'];
    $sql = "SELECT id, hotelName FROM hotels WHERE location_id=?";
    $res = select($sql, [$location_id], 'i');
    if (!$res) {
        echo json_encode(['error' => 'Failed to fetch hotels: ' . mysqli_error($GLOBALS['con'])]);
        exit;
    }
    $hotels = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $hotels[] = [
            'id' => $row['id'],
            'name' => $row['hotelName']
        ];
    }
    echo json_encode($hotels);
    exit;
}

// Fetch rooms based on hotel_id
if (isset($_POST['action']) && $_POST['action'] == 'fetch_rooms') {
    $hotel_id = filteration(['hotel_id' => $_POST['hotelID']])['hotel_id'];
    $sql = "SELECT id, type, capacity, price FROM rooms WHERE hotel_id=?";
    $res = select($sql, [$hotel_id], 'i');
    if (!$res) {
        echo json_encode(['error' => 'Failed to fetch rooms: ' . mysqli_error($GLOBALS['con'])]);
        exit;
    }
    $rooms = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $rooms[] = [
            'id' => $row['id'],
            'type' => $row['type'],
            'capacity' => $row['capacity'],
            'price' => $row['price']
        ];
    }
    echo json_encode($rooms);
    exit;
}

// Fetch sectors and vehicle types for dropdowns
$sectors = selectAll('travel_sectors');
$vehicle_types = selectAll('vehicle_types');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Umrah Booking - Umrah3</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- jQuery UI JS -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        label { margin: 10px 0; }
        .ui-datepicker { font-size: 14px; }
        .ui-datepicker-range { background: #e6f3ff; }

        /* Custom Dropdown Styles */
        .custom-select-wrapper { position: relative; width: 100%; }
        .custom-select { 
            border: 1px solid #ccc; 
            padding: 5px; 
            cursor: pointer; 
            background: #fff; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        }
        .custom-select::after { 
            content: '▼'; 
            font-size: 12px; 
        }
        .custom-options { 
            display: none; 
            position: absolute; 
            top: 100%; 
            left: 0; 
            width: 100%; 
            border: 1px solid #ccc; 
            background: #fff; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.2); 
            z-index: 10; 
        }
        .room-option { 
            display: flex; 
            align-items: center; 
            padding: 5px; 
            justify-content: space-between; 
            border-bottom: 1px solid #eee; 
        }
        .room-option:last-child { border-bottom: none; }
        .room-option button { 
            width: 25px; 
            height: 25px; 
            border-radius: 50%; 
            background: #007bff; 
            color: #fff; 
            border: none; 
            cursor: pointer; 
            font-size: 16px; 
        }
        .room-option button:hover { background: #0056b3; }
        .room-option span { width: 30px; text-align: center; }
        .done-btn { 
            display: block; 
            width: 100%; 
            padding: 8px; 
            background: #28a745; 
            color: #fff; 
            border: none; 
            cursor: pointer; 
            text-align: center; 
            font-weight: bold; 
        }
        .done-btn:hover { background: #218838; }
        .total-input { width: 50px; display: inline-block; margin-right: 10px; }
    </style>
</head>
<body>

<div class="container mt-5">
    <h3>Select Your Umrah Booking (Umrah3)</h3>
    <form id="booking-form" class="p-4 border rounded bg-light" method="POST">
        <div class="row bg-info border shadow">
            <div class="col-lg-2">
                <label for="location" class="form-label">Select Location</label>
                <select id="location" class="form-select" required>
                    <option value="">Loading...</option>
                </select>
            </div>
            <div class="col-lg-2">
                <label for="hotel" class="form-label" id="hotelLabel">Select Hotel</label>
                <select id="hotel" name="hotel" class="form-select" required>
                    <option value="">Select Location First</option>
                </select>
            </div>
            <div class="col-lg-2">
                <label for="date-range" class="form-label">Check-in & Check-out</label>
                <input type="text" id="date-range" name="date-range" class="form-control" readonly style="cursor: pointer; background-color: #fff;" />
                <input type="hidden" id="checkin" name="checkin">
                <input type="hidden" id="checkout" name="checkout">
            </div>
            <div class="col-lg-3">
                <!-- Rooms Dropdown -->
                <div class="dropdown">
                    <label for="rooms">Rooms</label><br>
                    <input id="roomlabledropdown" name="room" class="total-input" value="0" readonly>
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownRooms" data-bs-toggle="dropdown">
                        Select Rooms
                    </button>
                    <ul class="dropdown-menu p-3 rooms-dropdown" id="rooms-container">
                        <!-- Room options will be populated here -->
                    </ul>
                    <!-- Hidden Inputs for Form Submission -->
                    <input type="hidden" name="total_rooms" id="total_rooms" value="0">
                    <input type="hidden" name="double_rooms" id="double_rooms" value="0">
                    <input type="hidden" name="triple_rooms" id="triple_rooms" value="0">
                    <input type="hidden" name="quad_rooms" id="quad_rooms" value="0">
                    <input type="hidden" name="quint_rooms" id="quint_rooms" value="0">
                </div>
            </div>
            <div class="col-lg-3">
                <!-- Travelers Dropdown -->
                <div class="dropdown">
                    <label for="travelers">Traveler</label><br>
                    <input id="travelerlabledropdown" class="total-input" value="1" readonly>
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownTravelers" data-bs-toggle="dropdown">
                        Select Travelers
                    </button>
                    <ul class="dropdown-menu p-3 travelers-dropdown">
                        <li class="wrapper">
                            <span>Adults</span>
                            <div class="counter">
                                <span class="minus" data-type="adults" data-group="travelers">-</span>
                                <span class="num" id="adults">1</span>
                                <span class="plus" data-type="adults" data-group="travelers">+</span>
                            </div>
                        </li>
                        <li class="wrapper">
                            <span>Children</span>
                            <div class="counter">
                                <span class="minus" data-type="children" data-group="travelers">-</span>
                                <span class="num" id="children">0</span>
                                <span class="plus" data-type="children" data-group="travelers">+</span>
                            </div>
                        </li>
                        <li class="wrapper">
                            <span>Infants</span>
                            <div class="counter">
                                <span class="minus" data-type="infants" data-group="travelers">-</span>
                                <span class="num" id="infants">0</span>
                                <span class="plus" data-type="infants" data-group="travelers">+</span>
                            </div>
                        </li>
                        <li>
                            <button type="button" class="done-btn" data-group="travelers">Done</button>
                        </li>
                        <!-- Hidden Inputs for Form Submission -->
                        <input type="hidden" name="total_travelers" id="total_travelers" value="1">
                        <input type="hidden" name="adults" id="input_adults" value="1">
                        <input type="hidden" name="children" id="input_children" value="0">
                        <input type="hidden" name="infants" id="input_infants" value="0">
                    </ul>
                </div>
            </div>
        </div>
        <div class="row bg-info border shadow mt-3">
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
                            <?php while ($row = mysqli_fetch_assoc($sectors)) { ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['sector_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="vehicle" class="form-label">Vehicle Type</label>
                        <select id="vehicle" name="vehicle" class="form-select">
                            <option value="">Choose Vehicle</option>
                            <?php while ($row = mysqli_fetch_assoc($vehicle_types)) { ?>
                                <option value="<?php echo $row['id']; ?>" data-cost="<?php echo $row['type_name']; ?>">
                                    <?php echo $row['type_name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 pb-4 bg-dark mb-5 shadow">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Full Name">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email">
                <label>Contact *</label>
                <input type="text" class="form-control" name="phone" placeholder="Phone Number" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <label>Total Cost:</label>
                <span id="total-cost">0.00</span>
            </div>
        </div>
        <button type="reset" class="btn btn-secondary mt-3">Reset</button>
        <button type="submit" name="btnSubmit" class="btn btn-primary bg-success mt-3">Calculate Budget</button>
    </form>
</div>

<div class="modal fade text-center" id="resultModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog text-center" style="width: 95%; min-width:95%;">
        <div class="modal-content">
            <div class="modal-header text-center bg-success text-white">
                <h5 class="modal-title text-justify text-center">Umrah Quotation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="budgetResult"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.print();">Print</button>
                <button type="button" class="btn btn-success" onclick="openWhatsApp()">WhatsApp</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    // Load locations on page load
    $.ajax({
        url: 'merger.php',
        type: 'GET',
        data: { get_locations: true },
        dataType: 'json',
        success: function (data) {
            if (data.error) {
                $('#location').html('<option value="">Error: ' + data.error + '</option>');
                return;
            }
            $('#location').empty();
            $('#location').append('<option value="">Select Location</option>');
            $.each(data, function (index, item) {
                $('#location').append('<option value="' + item.id + '">' + item.name + '</option>');
            });
        },
        error: function (xhr, status, error) {
            $('#location').html('<option value="">AJAX Error: ' + error + '</option>');
            console.error('AJAX Error (Locations):', status, error);
            console.log('Response:', xhr.responseText);
        }
    });

    // Load hotels when a location is selected
    $('#location').on('change', function () {
        var locationId = $(this).val();
        if (locationId) {
            $.ajax({
                url: 'merger.php',
                type: 'POST',
                data: { action: 'fetch_hotels', locationID: locationId },
                dataType: 'json',
                success: function (data) {
                    if (data.error) {
                        $('#hotel').html('<option value="">Error: ' + data.error + '</option>');
                        return;
                    }
                    $('#hotel').empty();
                    $('#hotel').append('<option value="">Select Hotel</option>');
                    $.each(data, function (index, item) {
                        $('#hotel').append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                    // Update hotel label based on location
                    if (locationId == 1) {
                        $('#hotelLabel').text('Hotel in Makkah');
                    } else if (locationId == 2) {
                        $('#hotelLabel').text('Hotel in Madina');
                    } else {
                        $('#hotelLabel').text('Select Hotel');
                    }
                },
                error: function (xhr, status, error) {
                    $('#hotel').html('<option value="">AJAX Error: ' + error + '</option>');
                    console.error('AJAX Error (Hotels):', status, error);
                    console.log('Response:', xhr.responseText);
                }
            });
        } else {
            $('#hotel').html('<option value="">Select location first</option>');
            $('#rooms-container').empty();
            $('#roomlabledropdown').val('0');
        }
    });

    // Load rooms when a hotel is selected
    $('#hotel').on('change', function () {
        var hotelId = $(this).val();
        if (hotelId) {
            $.ajax({
                url: 'merger.php',
                type: 'POST',
                data: { action: 'fetch_rooms', hotelID: hotelId },
                dataType: 'json',
                success: function (data) {
                    if (data.error) {
                        $('#rooms-container').html('<p>Error: ' + data.error + '</p>');
                        return;
                    }
                    $('#rooms-container').empty();
                    if (data.length === 0) {
                        $('#rooms-container').html('<p>No rooms available</p>');
                        return;
                    }
                    $.each(data, function (index, item) {
                        var roomDiv = $('<li>').addClass('wrapper');
                        roomDiv.append(
                            '<span>' + item.type + '</span>' +
                            '<div class="counter">' +
                            '<span class="minus" data-type="' + item.type.toLowerCase() + '" data-group="rooms" data-price="' + item.price + '">-</span>' +
                            '<span class="num" id="' + item.type.toLowerCase() + '">0</span>' +
                            '<span class="plus" data-type="' + item.type.toLowerCase() + '" data-group="rooms" data-price="' + item.price + '">+</span>' +
                            '</div>'
                        );
                        $('#rooms-container').append(roomDiv);
                    });
                    $('#rooms-container').append('<li><button type="button" class="done-btn" data-group="rooms">Done</button></li>');
                },
                error: function (xhr, status, error) {
                    $('#rooms-container').html('<p>AJAX Error: ' + error + '</p>');
                    console.error('AJAX Error (Rooms):', status, error);
                    console.log('Response:', xhr.responseText);
                }
            });
        } else {
            $('#rooms-container').empty();
            $('#roomlabledropdown').val('0');
        }
    });

    // Date Range Picker
    $("#date-range").datepicker({
        dateFormat: 'yy-mm-dd',
        minDate: new Date(), // Today is April 10, 2025
        numberOfMonths: 2,
        beforeShowDay: function(date) {
            var checkin = $("#checkin").val() ? $.datepicker.parseDate('yy-mm-dd', $("#checkin").val()) : null;
            var checkout = $("#checkout").val() ? $.datepicker.parseDate('yy-mm-dd', $("#checkout").val()) : null;
            if (checkin && checkout && date >= checkin && date <= checkout) {
                return [true, "ui-datepicker-range", ""];
            }
            return [true, "", ""];
        },
        onSelect: function(dateText) {
            var checkin = $("#checkin").val();
            var checkout = $("#checkout").val();
            if (!checkin) {
                $("#checkin").val(dateText);
                $("#date-range").val(dateText);
            } else if (!checkout && $.datepicker.parseDate('yy-mm-dd', dateText) > $.datepicker.parseDate('yy-mm-dd', checkin)) {
                $("#checkout").val(dateText);
                $("#date-range").val(checkin + " - " + dateText);
            } else {
                $("#checkin").val(dateText);
                $("#checkout").val("");
                $("#date-range").val(dateText);
            }
            console.log('Check-in:', $("#checkin").val(), 'Check-out:', $("#checkout").val());
        }
    });

    // Room and Traveler Selection Logic
    let roomCounts = { double: 0, triple: 0, quad: 0, quint: 0 };
    let travelerCounts = { adults: 1, children: 0, infants: 0 };

    function updateTotalRooms() {
        let total = roomCounts.double + roomCounts.triple + roomCounts.quad + roomCounts.quint;
        $('#roomlabledropdown').val(total);
        $('#total_rooms').val(total);
        updateTotalCost();
    }

    function updateRoomInputs() {
        $('#double_rooms').val(roomCounts.double);
        $('#triple_rooms').val(roomCounts.triple);
        $('#quad_rooms').val(roomCounts.quad);
        $('#quint_rooms').val(roomCounts.quint);
    }

    function updateTotalTravelers() {
        let total = travelerCounts.adults + travelerCounts.children + travelerCounts.infants;
        $('#travelerlabledropdown').val(total);
        $('#total_travelers').val(total);
    }

    function updateTravelerInputs() {
        $('#input_adults').val(travelerCounts.adults);
        $('#input_children').val(travelerCounts.children);
        $('#input_infants').val(travelerCounts.infants);
    }

    $(document).on('click', '.plus, .minus', function () {
        let type = $(this).data('type');
        let group = $(this).data('group');
        if (group === 'rooms') {
            if ($(this).hasClass('plus')) {
                roomCounts[type]++;
            } else if ($(this).hasClass('minus') && roomCounts[type] > 0) {
                roomCounts[type]--;
            }
            $('#' + type).text(roomCounts[type]);
            updateTotalRooms();
            updateRoomInputs();
        } else if (group === 'travelers') {
            if ($(this).hasClass('plus')) {
                travelerCounts[type]++;
            } else if ($(this).hasClass('minus') && travelerCounts[type] > (type === 'adults' ? 1 : 0)) {
                travelerCounts[type]--;
            }
            $('#' + type).text(travelerCounts[type]);
            updateTotalTravelers();
            updateTravelerInputs();
        }
    });

    $(document).on('click', '.done-btn', function () {
        let group = $(this).data('group');
        if (group === 'rooms') {
            updateTotalRooms();
            updateRoomInputs();
        } else if (group === 'travelers') {
            updateTotalTravelers();
            updateTravelerInputs();
        }
        $(this).closest('.dropdown-menu').removeClass('show');
    });

    // Calculate total cost (placeholder)
    function updateTotalCost() {
        var total = 0;
        $('.num').each(function () {
            var type = $(this).attr('id');
            var qty = parseInt($(this).text());
            var price = parseFloat($(this).prevAll('.plus').data('price'));
            if (price) {
                total += qty * price;
            }
        });
        $('#total-cost').text(total.toFixed(2));
    }

    // Show/hide travel options
    $('#travel').change(function () {
        $('#travelOptions').toggle(this.checked);
    });

    // Form submission
    $('#booking-form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: 'calculate_budget.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                $('#budgetResult').html(response);
                var resultModal = new bootstrap.Modal(document.getElementById('resultModal'));
                resultModal.show();
            },
            error: function (xhr, status, error) {
                console.error("Budget Form Error: " + status + " - " + error);
            }
        });
    });

    // WhatsApp function
    function openWhatsApp() {
        let phone = $('input[name="phone"]').val();
        let message = "Umrah Booking Quotation";
        let url = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
        window.open(url, '_blank');
    }
});
</script>

</body>
</html>