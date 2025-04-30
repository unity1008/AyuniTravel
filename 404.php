<?php
// Set the 404 status code
http_response_code(404);

// Redirect to index.php
header("Location: /index.php");
exit;
?>
