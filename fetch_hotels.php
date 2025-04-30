<?php
$conn = new mysqli('localhost', 'root', '', 'umrah2');
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

$locationID = isset($_POST['locationID']) ? intval($_POST['locationID']) : 0;

// Debugging: Check if locationID is received
error_log("Received locationID: " . $locationID);

if ($locationID <= 0) {
    echo "<option value=''>No hotels available</option>";
    exit;
}

$stmt = $conn->prepare("SELECT id, hotelName, price_per_night FROM hotels WHERE location_id = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $locationID);
$stmt->execute();
$result = $stmt->get_result();






$options = "<option value=''>Choose Hotel</option>";
while ($hotel = $result->fetch_assoc()) {
    $options .= "<option value='{$hotel['id']}' data-price='{$hotel['price_per_night']}'>{$hotel['hotelName']}</option>";
}

echo $options;
$stmt->close();
$conn->close();




?>
