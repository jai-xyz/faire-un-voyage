<?php include_once 'helpers/helper.php'; ?>
<?php subview('header.php');
require 'helpers/init_conn_db.php';
?>
<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@200&display=swap" rel="stylesheet">
<style>
  table {
    background-color: white;
  }

  @font-face {
    font-family: 'product sans';
    src: url('assets/css/Product Sans Bold.ttf');
  }

  h1 {
    font-family: 'product sans' !important;
    color: #424242;
    font-size: 40px !important;
    margin-top: 20px;
    text-align: center;
  }

  body {
    /* background: #bdc3c7;   fallback for old browsers */
    /* background: -webkit-linear-gradient(to right, #2c3e50, #bdc3c7);   Chrome 10-25, Safari 5.1-6/
  /* background: linear-gradient(to right, #2c3e50, #bdc3c7); W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

	background-color: #EBF9FF; 
	height: 100%;
	width: 100%; 

  }

  th {
    font-size: 22px;
    /* font-family: 'Courier New', Courier, monospace; */
  }

  td {
    margin-top: 10px !important;
    font-size: 16px;
    font-weight: bold;
    /* color: #3931af; */
    color: #424242;
  }
</style>
<main>
  <?php if (isset($_POST['search_but']) && isset($_SESSION['userId'])) {
    $type = $_POST['type'];
    $dep_date = $_POST['dep_date'];
    $ret_date = '';
    if ($type === 'round') {
      $ret_date = $_POST['ret_date'];
    }
    $dep_city = $_POST['dep_city'];
    $arr_city = $_POST['arr_city'];
    $f_class = $_POST['f_class'];
    $passengers = $_POST['passengers'];
    if ($dep_city === $arr_city) {
      header('Location: index.php?error=sameval');
      exit();
    }
    if ($dep_city === '0') {
      header('Location: index.php?error=seldep');
      exit();
    }
    if ($arr_city === '0') {
      header('Location: index.php?error=selarr');
      exit();
    }
  ?>
    <div class="container-md mt-2">
      <h1 class="display-4 text-center text-dark">FLIGHTS FROM: <br> <?php echo $dep_city; ?>
        to <?php echo $arr_city; ?> </h1>
        <table class="table">
        <thead class="table-dark">
          <tr class="text-center">
            <th scope="col">Airline</th>
            <th scope="col">Departure</th>
            <th scope="col">Arrival</th>
            <!-- <th scope="col">Status</th> -->
            <th scope="col">Fare</th>
            <th scope="col">Buy</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = 'SELECT * FROM Flight WHERE source=? AND Destination =? AND 
                    DATE(departure)=? ORDER BY Price';
          $stmt = mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt, $sql);
          mysqli_stmt_bind_param($stmt, 'sss', $dep_city, $arr_city, $dep_date);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          while ($row = mysqli_fetch_assoc($result)) {
            $price = (int)$row['Price'] * (int)$passengers;
            if ($type === 'round') {
              $price = $price * 2;
            }
            if ($f_class == 'B') {
              $price += 0.5 * $price;
            }
            if (isset($_SESSION['userId'])) {
            if ($row['status'] === 'nydep') {
              $status = "Not yet departed";
              $alert = 'alert-success';
            } else if ($row['status'] === 'dep') {
              $status = "Departed";
              $alert = 'alert-info';
            } else if ($row['status'] === 'delayed') {
              $status = "Delayed";
              $alert = 'alert-danger';
            } else if ($row['status'] === 'arr') {
              $status = "Arrived";
              $alert = 'alert-secondary';
            }
            echo "  
                  <tr class='text-center'>                  
                    <td>" . $row['airline'] . "</td>
                    <td>" . $row['departure'] . "</td>
                    <td>" . $row['arrivale'] . "</td>
                                  
                    <td>₱" . $price . "</td>
                    ";
            if (isset($_SESSION['userId']) && $row['status'] === 'nydep') {
              echo " <td>
                    <form action='pass_form.php' method='post'>
                    <input name='flight_id' type='hidden' value=" . $row['flight_id'] . ">
                      <input name='type' type='hidden' value=" . $type . ">
                      <input name='passengers' type='hidden' value=" . $passengers . ">
                      <input name='price' type='hidden' value=" . $price . ">
                      <input name='ret_date' type='hidden' value=" . $ret_date . ">
                      <input name='class' type='hidden' value=" . $f_class . ">
       
                      <input name='dep_city' type='hidden' value=" . $dep_city . ">
                      <input name='arr_city' type='hidden' value=" . $arr_city . ">
                      
                      <input name='airline' type='hidden' value=" . $row['airline']. ">
                      <input name='departure' type='hidden' value=" . $row['departure'] . ">
                      <input name='arrivale' type='hidden' value=" . $row['arrivale'] . ">

                      <button name='book_but' type='submit' 
                      class='btn btn-success'>
                      <div style=''>
                      <i class='fa fa-lg fa-check'></i>  
                      </div>
                    </button>
                    </form>
                    </td>                                                       
                    ";
            } elseif (isset($_SESSION['userId']) && $row['status'] === 'dep') {
              echo "<td><a href='#' class='btn btn-light' disabled></i>&nbsp; Unable to  book flight </a></td>";
    
            } elseif (isset($_SESSION['userId']) && $row['status'] === 'arr') {
              echo "<td><a href='#' class='btn btn-light' disabled></i>&nbsp; Unable to  book flight </a></td>";
            } else {
              echo "<td><a href='./login.php' class='btn btn-success'> <i class='fa fa-lg fa-arrow-right'></i>&nbsp; Login first </a></td>";
          
            }
            }

            
            echo '</tr> ';
          }
          ?>

        </tbody>
      </table>

    </div>
  <?php } ?>


</main>
<?php subview('footer.php'); ?>

<script>
  document.querySelector('.btn-light').disabled = true;
</script>