<?php
include 'config.php';

if (!isset($_GET['appointmentID']) || !isset($_GET['appointmentType'])) {
    header("Location: admin-bookinghistory.php");
    exit;
}

$appointmentID = $_GET['appointmentID'];
$appointmentType = $_GET['appointmentType'];

if ($appointmentType === "Pet Grooming") {
    $tableName = "groomingAppt";
    $idColumn = "GAppt_ID";
} elseif ($appointmentType === "Pet Boarding") {
    $tableName = "boardingAppt";
    $idColumn = "BAppt_ID";
} else {
    header("Location: admin-bookinghistory.php");
    exit;
}

$deleteQuery = "DELETE FROM $tableName WHERE $idColumn = '$appointmentID'";

if (mysqli_query($con, $deleteQuery)) {
    $_SESSION['success_message'] = "Appointment deleted successfully!";
} else {
    $_SESSION['error_message'] = "Failed to delete the appointment. Please try again later.";
}

mysqli_close($con);

header("Location: admin-bookinghistory.php");
exit;
?>
