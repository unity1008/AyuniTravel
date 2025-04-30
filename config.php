<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//session_start();

// Set default language to English if not selected
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
}

// Load the selected language file
$langFile = __DIR__ . '/lang/' . $_SESSION['lang'] . '.php';
$translations = file_exists($langFile) ? include($langFile) : include(__DIR__ . '/lang/en.php');
?>
