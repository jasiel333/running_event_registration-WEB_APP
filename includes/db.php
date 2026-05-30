<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "running_event_registration_db"
);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

?>