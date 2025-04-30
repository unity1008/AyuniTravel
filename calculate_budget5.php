<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'umrah2');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit();
}

// Safely retrieve POST values
$name = htmlspecialchars($_POST['name'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$phone = htmlspecialchars($_POST['phone'] ?? '');
$location_id = intval($_POST['location'] ?? 0);
$hotel_id = intval($_POST['hotel'] ?? 0);
$checkin = $_POST['checkin'] ?? '';
$checkout = $_POST['checkout'] ?? '';
$rooms = json_decode($_POST['rooms'] ?? '[]', true);
$sector_id = isset($_POST['travel']) ? intval($_POST['sector'] ?? 0) : 0;
$vehicle_id = isset($_POST['travel']) ? intval($_POST['vehicle'] ?? 0) : 0;
$total_travelers = intval($_POST['total_travelers'] ?? 1);
$visa = isset($_POST['visa']) ? 1 : 0;

// Handle dates
$checkin_date = new DateTime($checkin);
$checkout_date = new DateTime($checkout);
$days = $checkin_date->diff($checkout_date)->days;
$nights = $days > 0 ? $days : 1; // Ensure at least 1 night

// Calculate room cost
$total_room_cost = 0;
$room_count = 0;
$room_details = [];
foreach ($rooms as $room) {
    $quantity = $room['quantity'];
    if ($quantity > 0) {
        $room_id = $room['room_id'];
        $price = $room['price'];
        $total_room_cost += $quantity * $price * $nights;
        $room_count += $quantity;
        $room_type = $conn->query("SELECT type FROM rooms WHERE id = $room_id")->fetch_assoc()['type'] ?? 'Unknown';
        $room_details[$room_type] = $quantity;
    }
}

// Current code
$sector_id = isset($_POST['travel']) ? intval($_POST['sector'] ?? 0) : 0;
$vehicle_id = isset($_POST['travel']) ? intval($_POST['vehicle'] ?? 0) : 0;

// To this:
$sector_id = isset($_POST['travel']) && !empty($_POST['sector']) ? intval($_POST['sector']) : NULL;
$vehicle_id = isset($_POST['travel']) && !empty($_POST['vehicle']) ? intval($_POST['vehicle']) : NULL;

// Fetch hotel details
$hotel_query = "SELECT hotelName, hotel_type, basic_food FROM hotels WHERE id = $hotel_id";
$hotel_result = $conn->query($hotel_query)->fetch_assoc();
$hotel_name = $hotel_result['hotelName'] ?? 'Unknown Hotel';
$hotel_type = $hotel_result['hotel_type'] ?? 'N/A';
$hotel_food = $hotel_result['basic_food'] ?? 'N/A';
$hotel_location_name = $location_id == 1 ? 'Makkah Hotel' : 'Madina Hotel';

// Calculate visa cost
$visa_cost = $visa ? 536 * $total_travelers : 0; // Using $536 as per your code
$visa_text = $visa ? "Umrah Visa and Insurance Of $total_travelers Person(s)" : "Umrah Visa and Insurance not Included";

// Calculate travel costs
$travel_cost = 0;
$sector_name = "Transport Not Included in the Package";
$vehicle_name = "Transport Not Included in the Package";
if ($sector_id && $vehicle_id) {
    $sector_query = "SELECT sector_name, cost FROM travel_sectors WHERE id = $sector_id";
    $sector_result = $conn->query($sector_query)->fetch_assoc();
    $sector_name = $sector_result['sector_name'] ?? 'Unknown Sector';
    $sector_cost = $sector_result['cost'] ?? 0;

    $vehicle_query = "SELECT type_name, cost_per_day FROM vehicle_types WHERE id = $vehicle_id";
    $vehicle_result = $conn->query($vehicle_query)->fetch_assoc();
    $vehicle_name = $vehicle_result['type_name'] ?? 'Unknown Vehicle';
    $vehicle_cost = ($vehicle_result['cost_per_day'] ?? 0) * $nights;

    $travel_cost = $sector_cost + $vehicle_cost;
}

// Total cost
$total_cost = $total_room_cost + $visa_cost + $travel_cost;
$price_per_person = $total_travelers > 1 ? "SR: " . ceil($total_cost / $total_travelers) : "N/A";
$ppp_label = $total_travelers > 1 ? "Price Per Person" : "";

// // Insert into bookings table
// $stmt = $conn->prepare("INSERT INTO bookings (user_name, location_id, hotel_id, checkin_date, checkout_date, rooms, sector_id, vehicle_id, total_cost) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
// $stmt->bind_param("siisssiid", $name, $location_id, $hotel_id, $checkin, $checkout, $room_count, $sector_id, $vehicle_id, $total_cost);
$stmt = $conn->prepare("INSERT INTO bookings (user_name, location_id, hotel_id, checkin_date, checkout_date, rooms, sector_id, vehicle_id, total_cost) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("siisssiid", $name, $location_id, $hotel_id, $checkin, $checkout, $room_count, $sector_id, $vehicle_id, $total_cost);
$stmt->execute();
$stmt->close();

// Format dates for display
$new_date_in = $checkin_date->format("d-m-Y");
$new_date_out = $checkout_date->format("d-m-Y");

// Generate output
$oMessage = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Estimated Budget</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    <style>
        .table-responsive { margin: 20px; }
        .bg-info { background-color: #17a2b8 !important; color: white; }
        .table th, .table td { vertical-align: middle; }
    </style>
</head>
<body>
<div class='table-responsive'>
    <img src='Assets/img/AyuniTravels.png' alt='Ayuni Travels Logo' class='w-100' >
    <table class='table text-center table-bordered table-striped table-hover'>
        <thead class='table-primary'>
            <tr>
                <th class='bg-info'>User-Name</th>
                <th class='bg-info'>E-Mail</th>
                <th class='bg-info'>Mobile</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>$name</td>
                <td>$email</td>
                <td>$phone</td>
            </tr>
        </tbody>
    </table>
    <table class='table text-center table-bordered table-striped table-hover'>
        <thead>
            <tr><th class='bg-info text-white'>$hotel_location_name</th></tr>
        </thead>
    </table>
    <table class='table text-center table-bordered table-striped table-hover'>
        <thead class='table-primary'>
            <tr>
                <th class='bg-info'>Hotel Name</th>
                <th class='bg-info'>Type</th>
                <th class='bg-info'>Basis</th>
                <th class='bg-info'>Check In</th>
                <th class='bg-info'>Check Out</th>
                <th class='bg-info'>Double</th>
                <th class='bg-info'>Triple</th>
                <th class='bg-info'>Quad</th>
                <th class='bg-info'>Quint</th>
                <th class='bg-info'>Nights</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>$hotel_name</td>
                <td>$hotel_type</td>
                <td>$hotel_food</td>
                <td>$new_date_in</td>
                <td>$new_date_out</td>
                <td>" . ($room_details['Double'] ?? 0) . "</td>
                <td>" . ($room_details['Triple'] ?? 0) . "</td>
                <td>" . ($room_details['Quad'] ?? 0) . "</td>
                <td>" . ($room_details['Quint'] ?? 0) . "</td>
                <td>$nights</td>
            </tr>
        </tbody>
    </table>
    <table class='table text-center table-bordered table-striped table-hover'>
        <thead class='table-primary'>
            <tr>
                <th class='bg-info'>Transport</th>
                <th class='bg-info'>Umrah Visa</th>
                <th class='bg-info'>Total Nights</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>$vehicle_name</td>
                <td>$visa_text</td>
                <td>$nights Nights / $days Days</td>
            </tr>
        </tbody>
    </table>
    <table class='table text-center table-bordered table-striped table-hover'>
        <thead class='table-primary'>
            <tr><th class='bg-info'>Sector</th></tr>
        </thead>
        <tbody>
            <tr><td>$sector_name</td></tr>
        </tbody>
    </table>
    <table class='table text-center table-bordered table-striped table-hover'>
        <thead>
            <tr>
                <th>Cost Breakdown</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Room Cost</td><td>SR: " . number_format($total_room_cost, 2) . "</td></tr>";
if ($visa) {
    $oMessage .= "<tr><td>Umrah Visa Cost</td><td>SR: " . number_format($visa_cost, 2) . "</td></tr>";
}
if ($travel_cost > 0) {
    $oMessage .= "<tr><td>Sector Cost</td><td>SR: " . number_format($sector_cost, 2) . "</td></tr>";
    $oMessage .= "<tr><td>Vehicle Cost ($nights nights)</td><td>SR: " . number_format($vehicle_cost, 2) . "</td></tr>";
}
$oMessage .= "
            <tr><td><strong>Grand Total</strong></td><td><strong>SR: " . number_format($total_cost, 2) . "</strong></td></tr>
            <tr><td>All Taxes are included Till Date</td><td>$ppp_label</td></tr>";
if ($total_travelers > 1) {
    $oMessage .= "<tr><td></td><td>$price_per_person</td></tr>";
}
$oMessage .= "
        </tbody>
    </table>
    <table class='table table-bordered table-striped table-hover'>
        <thead class='table-primary'>
            <tr>
                <th class='bg-primary'>Requirements</th>
                <th class='bg-danger'>Note</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <ol>
                        <li>Passport valid for 8 months</li>
                        <li>Copy of C.N.I.C/ POC</li>
                        <li>1 passport-size photograph with Blue background</li>
                    </ol>
                </td>
                <td class='table-warning'>
                    <ol>
                        <li>This Quotation is valid for 2 days Only.</li>
                        <li>No booking(s) made yet.</li>
                        <li>Availability and rates are subject to change at the time of confirmation.</li>
                        <li>For Makkah and Madinah standard check-in time is 5 PM and check-out time is 12 NOON.</li>
                    </ol>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div id='message-box' style='padding:10px; text-align:center;'>
    <button class='btn btn-primary' onclick='window.location.href=\"calculator.php\";'>Close</button>
</div>
</body>
</html>
";
?>

<!-- Add this where you display the cost breakdown -->


<script>
document.getElementById('bookingForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    
    fetch('calculate_budget4.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const breakdownDiv = document.getElementById('costBreakdown');
        breakdownDiv.innerHTML = '<h3>Cost Breakdown</h3><ul>' + 
            data.breakdown.map(item => `<li>${item}</li>`).join('') + 
            `</ul><p>Total Cost: $${data.total_cost}</p>`;
        
        // Show WhatsApp button and prepare message
        const whatsappButton = document.getElementById('whatsappButton');
        whatsappButton.style.display = 'block';
        
        // Construct WhatsApp message
        const message = `Umrah Booking Details:\n${data.breakdown.join('\n')}\nTotal Cost: $${data.total_cost}`;
        const encodedMessage = encodeURIComponent(message);
        const whatsappUrl = `https://wa.me/?text=${encodedMessage}`; // No specific number, opens WhatsApp
        
        whatsappButton.onclick = function() {
            window.open(whatsappUrl, '_blank');
        };
    })
    .catch(error => console.error('Error:', error));
});
</script>
<?php

// Set cookie for WhatsApp message
setcookie("whatsapp_message", urlencode($oMessage), time() + 3600, "/");
echo $oMessage;

$conn->close();
?>


