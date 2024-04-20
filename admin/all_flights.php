
<?php
include_once 'header.php';
include_once 'footer.php';
require '../helpers/init_conn_db.php';



if (mysqli_ping($conn) !== true) {
  die("Error: Database connection failed.");
}

    //  if (isset($_GET['success'])) {
    //      if ($_GET['success'] === 'flightupdated') { 
    //        echo '<script>alert("Flight details successfully updated.");</script>';
    //             }}


                // if (isset($_GET['flight'])) {
                //   if ($_GET['flight'] === 'added') { 
                //     echo '<script>alert("A new flight has successfully addded.");</script>';
                //          }}
              
if (isset($_POST['del_flight']) && isset($_SESSION['adminId'])) {
  $flight_id = $_POST['flight_id'];

  // Check for passengers
  $passenger_check_sql = "SELECT COUNT(*) AS passenger_count FROM passenger_profile WHERE flight_id = ?";
  $passenger_stmt = mysqli_prepare($conn, $passenger_check_sql);
  if ($passenger_stmt) {
    mysqli_stmt_bind_param($passenger_stmt, 'i', $flight_id);
    mysqli_stmt_execute($passenger_stmt);
    mysqli_stmt_bind_result($passenger_stmt, $passenger_count);
    mysqli_stmt_fetch($passenger_stmt);
    mysqli_stmt_close($passenger_stmt);

    if ($passenger_count > 0) {
      echo '<div class="alert alert-danger" style="text-align: center;">Cannot delete flight with passengers assigned.</div>';
    }
  } else {
    echo '<div class="alert alert-danger" style="text-align: center;">Error checking passenger count. Please try again.</div>';
    error_log("MySQLi prepare error: " . mysqli_error($conn));
  }

  // Delete flight
  $sql = 'DELETE FROM flight WHERE flight_id=?';
  $stmt = mysqli_prepare($conn, $sql);
  if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'i', $flight_id);
    mysqli_stmt_execute($stmt);

    if (mysqli_affected_rows($conn) > 0) {
      echo '<div class="success alert-success" style="text-align: center;">Flight successfully deleted.</div>';
      // } else {
      //     echo '<div class="alert alert-danger">Failed to delete flight. Please check error logs for details.</div>';
      //     error_log("Failed to delete flight with ID: $flight_id");
    }
    mysqli_stmt_close($stmt);
  } else {
    echo '<div class="alert alert-danger">Error preparing deletion query. Please try again.</div>';
    error_log("MySQLi prepare error: " . mysqli_error($conn));
  }
}

if (isset($_GET['flight'])) {
  if ($_GET['flight'] === 'added') {
    echo '<div class="success alert-success" style="text-align:center;" >Flight successfully added.</div>';
  }
  if ($_GET['flight'] === 'updated') {
    echo '<div class="success alert-success" style="text-align:center;" >Flight successfully updated.</div>';
  }
}

?>

<?php
if(!isset($_SESSION['adminId'])) { 
  header('location: login.php');
} ?>


<style>
  table {
    background-color: white;
  }

 h1 {
    margin-top: 20px;
    margin-bottom: 20px;
    font-size: 45px !important;
    font-family:Poppins;
    color:#343b41;
    font-weight:bold;
  }


  a:hover {
    text-decoration: none;
  }

  body {
    /* background-color: #B0E2FF; */
    background-color: #efefef;
  }

  th {
    font-size: 22px;
    /* font-weight: lighter; */
    /* font-family: 'Courier New', Courier, monospace; */
  }

  td {
    margin-top: 10px !important;
    font-size: 16px;
    font-weight: bold;
    font-family: 'Assistant', sans-serif !important;
  }

  .button-container{
    display: flex;
  justify-content:center;

  }

</style>
<main>
  <?php if (isset($_SESSION['adminId'])) { ?>
    <div class="container-md mt-2">
      <h1 class=" text-center text-dark">FLIGHT LIST</h1>
      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Departure</th>
            <th scope="col">Arrival</th>
            <th scope="col">From</th>
            <th scope="col">To</th>
            <th scope="col">Airline</th>
            <th scope="col">Seats</th>
            <th scope="col">Price</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $sql = 'SELECT * FROM Flight ORDER BY flight_id DESC';
          $stmt = mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt, $sql);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          while ($row = mysqli_fetch_assoc($result)) {
            echo "
                  <tr class='text-center'>                  
                    <td scope='row'>
                      <a href='pass_list.php?flight_id=" . $row['flight_id'] . "'>
                      " . $row['flight_id'] . " </a> </td>
                    <td>" . $row['departure'] . "</td>
                    <td>" . $row['arrivale'] . "</td>
                    <td>" . $row['source'] . "</td>
                    <td>" . $row['Destination'] . "</td>
                    <td>" . $row['airline'] . "</td>
                    <td>" . $row['Seats'] . "</td>
                    <td>₱" . $row['Price'] . "</td>
                    <td>" . $row['status'] . "</td>
                    <td>
                    <div class='button-container'>
                      <form action='all_flights.php' method='post'>
                      <input name='flight_id' type='hidden' value=" . $row['flight_id'] . ">
                        <button class='btn' type='submit' name='del_flight' onclick='return confirm(\"Are you sure you want to delete this flight?\")'>
                          <i class='text-danger fa fa-trash'></i>
                        </button>
                      </form>
                      <form action='flight.edit.php' method='get'>
                      <input name='flight_id' type='hidden' value='" . $row['flight_id'] . "'>
                        <button class='btn' type='submit'>
                          <i class='text-success fa fa-pencil'></i>
                        </button>
                      </form>
                    </div>
                  </td>             
                  </tr>
                  ";
          }
          mysqli_close($conn);
          ?>

        </tbody>
      </table>

    </div>
  <?php } ?>

</main>