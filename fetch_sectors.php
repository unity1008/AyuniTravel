<?php
$conn = new mysqli('localhost', 'root', '', 'umrah2');
if ($conn->connect_error) die("Connection failed!");

$query = "SELECT * FROM travel_sectors";
$result = $conn->query($query);

$options = "<option value=''>Choose Sector</option>";
while ($sector = $result->fetch_assoc()) {
    $options .= "<option value='{$sector['id']}' data-cost='{$sector['cost']}'>{$sector['sector_name']}</option>";
}
echo $options;
$conn->close();
?>
