<?php
session_start();
?>
<!doctype html>
<html lang="en">
    <head>
      
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic" rel="stylesheet" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@200&display=swap" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/44f557ccce.js"></script>
        <title>Admin | Faire un Voyage</title>     
        <link rel = "icon" href ="../assets/images/logo.2.png" type = "image/x-icon">          
    </head>
<style>

button.btn-outline-light:hover {
  color: cornflowerblue !important;
}
  .navbar-custom {
    /* background-color: #6495ED; */
    background-color: #343b41;
    /* font-family: 'Bangers', cursive; */
    font-family: Poppins;    
  }
  h4 {
    font-size: 23px !important;
    font-weight: bold;
  }
</style>
    <body>

        <nav class="navbar navbar-custom navbar-expand-lg navbar-dark">
        <img src="../assets/images/footer.logo.png" alt="" width="35em">
          <a class="navbar-brand text-light mt-2" href="index.php"><h4>ADMIN PANEL</h4></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <?php
              if(isset($_SESSION['adminId'])) { ?>
                <ul class="navbar-nav mr-auto mt-2">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                      <h5 class="ml-2"> Dashboard</h5>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="flight.php">
                      <h5 class="ml-2"> Add Flight</h5>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="all_flights.php">
                      <h5>List Flights</h5>
                    </a>
                  </li>   
                  <li class="nav-item">
                    <a class="nav-link" href="list_airlines.php">
                      <h5>Manage Airlines</h5>
                    </a>
                  </li>              
                  <!-- <li class="nav-item">
                    <a class="nav-link" href="review.php">
                      <h4>Reviews</h4>
                    </a>
                  </li>                      -->
                </ul>
                
                <ul class="nav navbar-nav navbar-right">
                  <li class="nav-item">
                    <div class="dropdown"  style="padding-top:9px;" >
                      <button class="btn bg-transparent dropdown-toggle text-light" style="font-family: Poppins;" type="button" 
                        id="dropdownMenuButton" data-toggle="dropdown" 
                          aria-haspopup="true" aria-expanded="false">
                        
                        <i class="fa fa-plus text-white"></i> Airlines </td>
                      </button>  
                      <div class="dropdown-menu">
                        <form class="px-2 py-2"  action="../includes/admin/airline.inc.php" method="post">
                          <div class="form-group">
                            <input type="text" class="form-control" name="airline" 
                              placeholder="Airlines Name">
                            <input type="number" class="form-control mt-3" name="seats" 
                              placeholder="Total Seats">                              
                          </div>  
                          <button type="submit" name="air_but" 
                            class="btn btn-success w-100">Submit</button>
                        </form>
                      </div>
                    </div>  
                  </li>
                  <li class="nav-item"  style="padding-top:7px;">
                      <a class="nav-link" href="register.moderator.php">
                          <span class="nav_link text-light"
                            style="font-size: 1rem; font-family: Poppins;">
                            <i class="fa fa-plus text-white"></i> Moderator </td>
                          </span>
                      </a>
                  </li>            
                </ul>                 
                <form action="../includes/admin/logout.inc.php" method="POST">
                <button class="btn btn-outline-light m-2" type="submit">
                    Logout </button>
                </form> 
            </div>
            <?php } ?>

        </nav>
        <ul class="nav navbar-nav navbar-right">
            