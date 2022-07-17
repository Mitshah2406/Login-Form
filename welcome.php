<?php
session_start();

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] != true) {
    header('location:login.php');
    exit;
}

?>
<?php
require 'includes/header.php';
?>
<h1>Welcome page</h1>
<?php
require 'includes/footer.php';
?>