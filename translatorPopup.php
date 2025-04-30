<?php

// Start session at the top

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Set session timeout (e.g., 30 minutes)
$session_lifetime = 18; // 1800 seconds = 30 minutes

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $session_lifetime)) {
    session_unset();  // Unset all session variables
    session_destroy(); // Destroy the session
}
$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity time

// Reset language selection when the session expires
if (!isset($_SESSION['lang'])) {
    $showPopup = true;
} else {
    $showPopup = false;
}

// Check if language is selected and store it in session
if (isset($_POST['language'])) {
    $_SESSION['lang'] = $_POST['language'];
    header("Location: " . $_SERVER['PHP_SELF']); // Reload to apply changes
    exit();
}

// Determine if the popup should be shown (only if session is NOT set)
$showPopup = !isset($_SESSION['lang']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Language Selection Popup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<!-- Language Selection Modal -->
<div class="modal fade" id="languageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Your Language</h5>
            </div>
            <div class="modal-body text-center">
                <form method="post">
                    <button type="submit" name="language" value="en" class="btn btn-primary m-2">English</button>
                    <button type="submit" name="language" value="ur" class="btn btn-success m-2">اردو</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php if ($showPopup): ?>
            let langModal = new bootstrap.Modal(document.getElementById('languageModal'), { keyboard: false });
            langModal.show();
        <?php endif; ?>
    });
</script>

</body>
</html>
