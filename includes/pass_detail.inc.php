<?php
session_start();

if (isset($_POST['pass_but']) && isset($_SESSION['userId'])) {
    require '../helpers/init_conn_db.php';

    $passenger_types = $_POST['passenger_type'];
    $firstnames = $_POST['firstname'];
    $midnames = $_POST['midname'];
    $lastnames = $_POST['lastname'];
    $mobiles = $_POST['mobile'];
    $dates = $_POST['date'];
    $passengers = $_POST['passengers'];
    $flight_id = $_POST['flight_id'];


    $price = $_POST['price'];
    $class = $_POST['class'];
    $type = $_POST['type'];
    $ret_date = $_POST['ret_date'];

    $airline = $_POST['airline'];
    $departure = $_POST['departure'];
    $arrivale = $_POST['arrivale'];

    $dep_city = $_POST['dep_city'];
    $arr_city = $_POST['arr_city'];


    // Validate mobile numbers
    $passengers = $_POST['passengers'];
    $hasInvalidMobile = false;
    foreach ($_POST['mobile'] as $mobileNumber) {
        if (strlen($mobileNumber) !== 11) {
            $hasInvalidMobile = true;
            header('Location: ../pass_form.php?error=moblen');
            exit();
        }
    }

    // Validate dates
    foreach ($_POST['date'] as $submittedDate) {
        // Use strtotime() to parse the date and create a DateTime object
        $submittedDateObj = DateTime::createFromFormat('Y-m-d', $submittedDate);

        if ($submittedDateObj >= new DateTime()) {
            header('Location: ../pass_form.php?error=invdate');
            exit();
        }
    }

    $pass_id = null;
    $stmt = mysqli_stmt_init($conn);
    $sql = 'SELECT * FROM Passenger_profile';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)) {
        header('Location: ../pass_form.php?error=sqlerror');
        exit();            
    } else { 
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $pass_id=$row['passenger_id'];
        }
    } 

    if(is_null($pass_id)) {
        $pass_id = 0;
        $stmt = mysqli_stmt_init($conn);
        $sql = 'ALTER TABLE Passenger_profile AUTO_INCREMENT = 1 ';
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)) {
            header('Location: ../pass_form.php?error=sqlerror');
            exit();            
        } else {         
            mysqli_stmt_execute($stmt);
        }        
    }


    // Insert passenger information
    mysqli_begin_transaction($conn); 
   for ($i = 0; $i < $passengers; $i++) {
        $stmt = mysqli_stmt_init($conn);
        $sql = 'INSERT INTO Passenger_profile (user_id, flight_id, mobile, dob, f_name, m_name, l_name, passenger_type)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header('Location: ../passform.php?error=errdetails');
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, 'iiisssss', $_SESSION['userId'],
            $flight_id, $_POST['mobile'][$i], $_POST['date'][$i], $_POST['firstname'][$i],
            $_POST['midname'][$i], $_POST['lastname'][$i], $_POST['passenger_type'][$i]);
             mysqli_stmt_execute($stmt);
            
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_commit($conn);

    // Set session variables and redirect to payment
    $_SESSION['flight_id'] = $_POST['flight_id'];
    $_SESSION['class'] = $_POST['class'];
    $_SESSION['passengers'] = $passengers;
    $_SESSION['price'] = $_POST['price'];
    $_SESSION['type'] = $_POST['type'];
    $_SESSION['ret_date'] = $_POST['ret_date'];
    $_SESSION['passenger_type'] = $_POST['passenger_type'];
    $_SESSION['pass_id'] = $pass_id + 1;

    
    $_SESSION['airline'] = $_POST['airline'];
    $_SESSION['departure'] = $_POST['departure'];
    $_SESSION['arrivale'] = $_POST['arrivale'];

    $_SESSION['dep_city'] = $_POST['dep_city'];
    $_SESSION['arr_city'] = $_POST['arr_city'];

    header('Location: ../flightdetails.php?success=details');
    exit();
    mysqli_close($conn);
} else {
    header('Location: ../paymentmethod.php?error=errdetails');
    exit();
}
mysqli_stmt_close($stmt);
