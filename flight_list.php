<?php include_once 'helpers/helper.php'; ?>
<?php require 'sub-views/header.php'; ?>
<?php require 'helpers/init_conn_db.php'; ?> 	
<style>

footer {
  /* position: absolute; */
  bottom: 0;
  width: 100%;
  height: 2.5rem;            /* Footer height */
}
form.logout_form {
	background: transparent;  
	padding: 10px !important;
}
body {
	/* background:url('assets/images/bg2.jpg') no-repeat 0px 0px;
	background-size: cover;
	font-family: 'Open Sans', sans-serif;
	background-attachment: fixed;
    background-position: center; */
	/* background: #bdc3c7;  fallback for old browsers */
 /* background: -webkit-linear-gradient(to right, #2c3e50, #bdc3c7); Chrome 10-25, Safari 5.1-6 */
/* background: linear-gradient(to right, #2c3e50, #bdc3c7);  W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

background-color: #EBF9FF; 
	height: 100%;
	width: 100%; 

}


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
    background-color: #EBF9FF; 
	height: 100%;
	width: 100%; 
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

    <div class="container-md mt-2">
      <h1 class="text-center">FLIGHT LIST</h1>
      <table class="table table-hover">
        <thead class="table-dark">
          <tr>
            <th scope="col">Departure</th>
            <th scope="col">Arrival</th>
            <th scope="col">From</th>
            <th scope="col">To</th>
            <th scope="col">Airline</th>
            <th scope="col">Price</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $sql = 'SELECT * FROM Flight WHERE status = "nydep" ORDER BY departure ASC;';
          $stmt = mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt, $sql);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          while ($row = mysqli_fetch_assoc($result)) {
            echo "
                  <tr>                  
                
                    <td>" . $row['departure'] . "</td>
                    <td>" . $row['arrivale'] . "</td>
                    <td>" . $row['source'] . "</td>
                    <td>" . $row['Destination'] . "</td>
                    <td>" . $row['airline'] . "</td>
                    <td>₱" . $row['Price'] . "</td>
          
                      
                  </tr>
                  ";
          }
          mysqli_close($conn);
          ?>

        </tbody>
      </table>

    </div>


</main>