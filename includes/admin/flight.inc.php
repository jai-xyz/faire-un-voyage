<?php
session_start();

if(isset($_POST['flight_but']) && isset($_SESSION['adminId'])) {
    require '../../helpers/init_conn_db.php';
    $source_date = $_POST['source_date'];
    $source_time = $_POST['source_time'];
    $dest_date = $_POST['dest_date'];
    $dest_time = $_POST['dest_time'];
    $dep_city = $_POST['dep_city'];
    $arr_city = $_POST['arr_city'];
    $price = $_POST['price'];
    $air_id = $_POST['airline_name'];
    $status = $_POST['status'];

    if($dep_city===$arr_city || $arr_city==='To' || $arr_city==='From') {
      header('Location: ../../admin/flight.php?error=same');
      exit();
    }
    $dest_date_len = strlen($dest_date);
    $dest_time_len = strlen($dest_time);
    $source_date_len = strlen($source_date);
    $source_time_len = strlen($source_time);

    $dest_date_str = '';
    for($i=$dest_date_len-2;$i<$dest_date_len;$i++) {
      $dest_date_str .= $dest_date[$i];
    }
    $source_date_str = '';
    for($i=$source_date_len-2;$i<$source_date_len;$i++) {
      $source_date_str .= $source_date[$i];
    }
    $dest_time_str = '';
    for($i=0;$i<$dest_time_len-3;$i++) {
      $dest_time_str .= $dest_time[$i];
    }
    $source_time_str = '';
    for($i=0;$i<$source_time_len-3;$i++) {
      $source_time_str .= $source_time[$i];
    }
    $dest_date_str = (int)$dest_date_str;
    $source_date_str = (int)$source_date_str;
    $dest_time_str = (int)$dest_time_str;
    $source_time_str = (int)$source_time_str;

    $time_source = $source_time.':00';
    $time_dest = $dest_time.':00';
    $arrival = $dest_date.' '.$time_dest;
    $departure = $source_date.' '.$time_source;

    $dest_mnth = (int)substr($dest_date,5,2);
    $src_mnth = (int)substr($source_date,5,2);
    $flag = false;


      $sql = "SELECT * FROM Airline WHERE airline_id =?";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$sql);
      mysqli_stmt_bind_param($stmt,'i',$air_id);            
      mysqli_stmt_execute($stmt);      
      $result = mysqli_stmt_get_result($stmt);    
      mysqli_stmt_close($stmt);
      if($row = mysqli_fetch_assoc($result)) {
        $seats = $row['seats'];
        $airline_name = $row['name'];
        $sql = "INSERT INTO Flight(admin_id,arrivale,departure,Destination,source,
          airline,Seats,status,Price) VALUES (?,?,?,?,?,?,?,?,?)";
          
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)) {
          header('Location: ../../admin/flight.php?error=sqlerr1');
          exit();          
        } else {      
          $admin_id = $_SESSION['adminId'];  
          mysqli_stmt_bind_param($stmt,'isssssisi',$admin_id,$arrival,$departure,$arr_city,$dep_city,$airline_name,$seats,$status,$price);            
          mysqli_stmt_execute($stmt); 
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);  
        header('Location: ../../admin/all_flights.php?flight=added');
        exit();
      } else {
        header('Location: ../../admin/flight.php?error=sqlerr');
        exit();
      }
}