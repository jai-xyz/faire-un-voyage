  <?php
  session_start();

  if (isset($_POST['update_flight_but'])) {
    require '../../helpers/init_conn_db.php';

      
    // Check for necessary variables and session data
    if (!isset($_POST['flight_id']) || !isset($_SESSION['modId'])) {
      echo '<div class="alert alert-danger">Update conditions not met. Check session and form data.</div>';
      exit();
    }

    $flight_id = $_POST['flight_id'];
    $source_date = $_POST['source_date'];
    $source_time = $_POST['source_time'];
    $dest_date = $_POST['dest_date'];
    $dest_time = $_POST['dest_time'];
    $dep_city = $_POST['dep_city'];
    $arr_city = $_POST['arr_city'];
    $price = $_POST['price'];
    $airline_id = $_POST['airline_id'];
    $status = $_POST['status'];
    $mod_id = $_SESSION['modId'];

    if ($dep_city == $arr_city) {
    header('Location: ../../moderator/flight.edit.php?error=same'); 
              exit();
    }

    // $originalValues = [
    //   'source_date' => $source_date,
    //   'source_time' => $source_time,
    //   'dest_date' => $dest_date,
    //   'dest_time' => $dest_time,
    //   'dep_city' => $dep_city,
    //   'arr_city' => $arr_city,
    //   'price' => $price,
    //   'airline_id' => $airline_id,
    //   'status' => $status,
    // ];
    
    
    // if (isset($_POST['update_flight_but'])) {
    //   foreach ($originalValues as $field => $originalValue) {
    //       $submittedValue = $_POST[$field];
    //       if ($submittedValue != $originalValue) {
    //           // Prompt for confirmation
    //           echo '<script>
    //                   if (!confirm("Changes detected. Are you sure you want to save?")) {
    //                       return false; // Prevent form submission
    //                   } else {
    //                     Location: ../../admin/all_flights.php;
    //                   }

    //               </script>';
    //           break; // Exit the loop if any change is found
    //       }
    //   }}

    $dest_date_len = strlen($dest_date);
    $dest_time_len = strlen($dest_time);
    $source_date_len = strlen($source_date);
    $source_time_len = strlen($source_time);

    $dest_date_str = '';
    for ($i = $dest_date_len - 2; $i < $dest_date_len; $i++) {
      $dest_date_str .= $dest_date[$i];
    }
    $source_date_str = '';
    for ($i = $source_date_len - 2; $i < $source_date_len; $i++) {
      $source_date_str .= $source_date[$i];
    }
    $dest_time_str = '';
    for ($i = 0; $i < $dest_time_len - 3; $i++) {
      $dest_time_str .= $dest_time[$i];
    }
    $source_time_str = '';
    for ($i = 0; $i < $source_time_len - 3; $i++) {
      $source_time_str .= $source_time[$i];
    }
    $dest_date_str = (int)$dest_date_str;
    $source_date_str = (int)$source_date_str;
    $dest_time_str = (int)$dest_time_str;
    $source_time_str = (int)$source_time_str;

    $time_source = $source_time . ':00';
    $time_dest = $dest_time . ':00';
    $arrival = $dest_date . ' ' . $time_dest;
    $departure = $source_date . ' ' . $time_source;

    $dest_mnth = (int)substr($dest_date, 5, 2);
    $src_mnth = (int)substr($source_date, 5, 2);
    $flag = false;
    if ($dest_mnth > $src_mnth) {
      $flag = true;
    } else if ($dest_mnth == $src_mnth) {
      if ($dest_date_str > $source_date_str) {
        $flag = true;
      } else if ($dest_date_str == $source_date_str) {
        if ($dest_time_str > $source_time_str) {
          $flag = true;
        }
      }
    }

    if ($flag == false) {
      header('Location: ../../moderator/flight.edit.php?error=destless');
      exit();
    } else {
      $sql = "SELECT * FROM Airline WHERE airline_id =?";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_bind_param($stmt, 'i', $airline_id);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      mysqli_stmt_close($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $airline_name = $row['name'];
        $sql = "UPDATE Flight
        SET moderator_id = ?,
            arrivale = ?,
            departure = ?,
            Destination = ?,
            source = ?,
            airline = ?,
            Price = ?,
            status = ?
        WHERE flight_id = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          echo '<div class="alert alert-danger">Error preparing update statement</div>';
        } else {
          $mod_id = $_SESSION['modId'];
          mysqli_stmt_bind_param($stmt, 'isssssisi', $mod_id, $arrival, $departure, $arr_city, $dep_city, $airline_name, $price, $status, $flight_id);
          mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header('Location: ../../moderator/all_flights.php?flight=updated'); 
        exit();

      } else {
        echo '<div class="alert alert-danger">Error sql statement.</div>';
      }
    }
  } else {
    echo '<div class="alert alert-danger">"Update conditions not met. Check session and form data.</div>';
  }




