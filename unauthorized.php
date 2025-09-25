<?php
session_start();

// Redirect based on user role
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: index.php");
        exit;
    } else {
        header("Location: homepage.php");
        exit;
    }
}

// If no role is set, you can optionally redirect to a default page or show the unauthorized message
?>