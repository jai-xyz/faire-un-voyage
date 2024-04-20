<?php
session_start();


if (isset($_POST['editbutton'])) {
    require '../helpers/init_conn_db.php';

    // Check for necessary variables and session data
    if (!isset($_POST['userId'])) {
        echo '<div class="alert alert-danger">Update conditions not met. Check session and form data.</div>';
        exit();
    }

    // Fetch user data from the form
    $user_id = $_POST['userId'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $suffix = $_POST['suffix'];
    $province = $_POST['province'];
    $city_municipality = $_POST['city_municipality'];
    $barangay = $_POST['barangay'];
    $house_no = $_POST['house_no'];

    // Check if the user exists in the database
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo '<div class="alert alert-danger">Error preparing select statement</div>';
    } else {
        mysqli_stmt_bind_param($stmt, 'i', $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Update user information
            $sql = "UPDATE users
                    SET firstname = ?,
                        middlename = ?,
                        lastname = ?,
                        suffix = ?,
                        province = ?,
                        city_municipality = ?,
                        barangay = ?,
                        house_no = ?
                    WHERE user_id = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo '<div class="alert alert-danger">Error preparing update statement</div>';
            } else {
                mysqli_stmt_bind_param($stmt, 'ssssssssi', $first_name, $middle_name, $last_name, $suffix, $province, $city_municipality, $barangay, $house_no, $user_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header('Location: ../index.php?update=success');
                exit();
            }
        } else {
            echo '<div class="alert alert-danger">User not found in the database.</div>';
        }
    }
} else {
    echo '<div class="alert alert-danger">"Update conditions not met. Check session and form data.</div>';
}