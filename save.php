<?php

include 'includes/db.php';

$fullname           = trim(mysqli_real_escape_string($conn, $_POST['fullname']));
$email              = trim(mysqli_real_escape_string($conn, $_POST['email']));
$contact            = trim(mysqli_real_escape_string($conn, $_POST['contact']));
$gender             = mysqli_real_escape_string($conn, $_POST['gender']);
$birthdate          = mysqli_real_escape_string($conn, $_POST['birthdate']);
$nationality        = trim(mysqli_real_escape_string($conn, $_POST['nationality']));
$address            = trim(mysqli_real_escape_string($conn, $_POST['address']));
$team_name          = trim(mysqli_real_escape_string($conn, $_POST['team_name']));
$medical_conditions = trim(mysqli_real_escape_string($conn, $_POST['medical_conditions']));
$medications        = trim(mysqli_real_escape_string($conn, $_POST['medications']));
$blood_type         = mysqli_real_escape_string($conn, $_POST['blood_type']);
$emergency_name     = trim(mysqli_real_escape_string($conn, $_POST['emergency_name']));
$emergency_contact  = trim(mysqli_real_escape_string($conn, $_POST['emergency_contact']));
$relationship_name  = trim(mysqli_real_escape_string($conn, $_POST['relationship_name']));
$category           = mysqli_real_escape_string($conn, $_POST['category']);
$waiver_accepted    = isset($_POST['waiver']) ? 1 : 0;

// Store NULL if blank — not the word "none"
$medical_val = $medical_conditions !== '' ? "'$medical_conditions'" : 'NULL';
$medic_val   = $medications        !== '' ? "'$medications'"        : 'NULL';

// ── 1. INSERT PARTICIPANT ────────────────────────────────────────────────────
mysqli_query($conn, "INSERT INTO participants
    (fullname, email, contact, gender, birthdate, nationality, address,
     team_name, medical_conditions, medications, blood_type)
    VALUES
    ('$fullname','$email','$contact','$gender','$birthdate','$nationality',
     '$address','$team_name',$medical_val,$medic_val,'$blood_type')");

$participant_id = mysqli_insert_id($conn);

// ── 2. GET CATEGORY ──────────────────────────────────────────────────────────
$catRow     = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT category_id FROM categories WHERE category_name='$category' LIMIT 1")
);
$category_id = $catRow['category_id'];

// ── 3. GENERATE BIB NUMBER ───────────────────────────────────────────────────
// Count existing registrations in this category BEFORE inserting
$bib_count  = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) as cnt FROM registrations WHERE category_id = $category_id")
)['cnt'];

$prefix_map = ['21KM' => '21', '10KM' => '10', '5KM' => '5'];
$prefix     = $prefix_map[$category] ?? '00';
$bib_number = $prefix . '-' . str_pad($bib_count + 1, 3, '0', STR_PAD_LEFT);
// e.g. 21-001, 10-004, 5-002

// ── 4. INSERT REGISTRATION (with bib_number, payment_status = Pending) ───────
$bib_escaped = mysqli_real_escape_string($conn, $bib_number);
mysqli_query($conn, "INSERT INTO registrations
    (participant_id, category_id, waiver_accepted, bib_number, payment_status)
    VALUES ('$participant_id','$category_id','$waiver_accepted','$bib_escaped','Pending')");

$registration_id = mysqli_insert_id($conn);

// ── 5. INSERT EMERGENCY CONTACT ──────────────────────────────────────────────
mysqli_query($conn, "INSERT INTO emergency_contacts
    (participant_id, emergency_name, emergency_contact, relationship_name)
    VALUES ('$participant_id','$emergency_name','$emergency_contact','$relationship_name')");

// ── 6. REDIRECT TO SUCCESS ───────────────────────────────────────────────────
header("Location: success.php?rid=$registration_id&pid=$participant_id&name=" 
    . urlencode($fullname) . "&cat=" . urlencode($category) . "&bib=" . urlencode($bib_number));
exit;
?>