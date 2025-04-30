<?php
$conn = new mysqli('localhost', 'root', '', 'umrah2');
if ($conn->connect_error)
{
    die("Connection failed!" . $conn->connect_error);
}

// $roomID = $_POST['roomID'];
// $query = "SELECT * FROM room WHERE room_id = $roomID";
// $result = $conn->query($query);

// Check if both locationID and hotelID are set
if (isset($_POST['locationID']) && isset($_POST['hotelID'])) {
    $locationID = intval($_POST['locationID']);
    $hotelID = intval($_POST['hotelID']);

    // Fetch rooms based on selected hotel
    $sql = "SELECT id, type, price FROM rooms WHERE hotel_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $hotelID);
    $stmt->execute();
    $result = $stmt->get_result();

    $rooms = [];
    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }


$options = "<option value=''>Choose Room</option>";
while ($hotel = $result->fetch_assoc()) {
     $options .= "<option value='{$room['id']}' data-price='{$room['price']}'>{$room['type']}</option>";
    }
}

echo $options;
$conn->close();
?>

