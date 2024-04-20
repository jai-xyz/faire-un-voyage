<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>




    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic" rel="stylesheet" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/44f557ccce.js"></script>
    <!-- Bootstrap CSS -->
 
    <link rel="shortcut icon"  type="x-icon" href="assets/images/logo.2.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Faire un Voyage</title>
 
</head>
<style>
    .astext {
        background: none;
        border: none;
        margin: 0;
        padding: 0;
        cursor: pointer;
    }

    @font-face {
        font-family: 'product sans';
        src: url('../assets/css/Product Sans Bold.ttf');
    }

    h5:hover {
        color: #E8E8E8;
    }

    h6 {
        color: white;
        font-weight: bold;
        font-size: 20px;
        font-family: Poppins;
        padding: 0;
        margin: 0;
    }

    .profile {
        color: white;
        font-weight: bold;
        font-size: 15px;
        font-family: Poppins;
        padding: 0;
        margin: 0;
    }

    .btn-login-nav {
        /* font-size: 22px ; */
        font-weight: bold;
        font-family: Poppins;
        background-color: #343b41;
        border-radius: .25em;
        margin-right: 15px;
    }

    .profile {
        text-decoration: none;
        color: white;
    }

    .profile:hover {
        color: lightslategray;
        text-decoration: none;
    }

    .item:hover {
        color: white;
        background-color: #8295a1;
    }


    .logo {
        margin-right: 1.2em;

    }

    .logo:hover {
        text-decoration: none;

    }

    .lightfont {
        color: #416B8F;
        font-weight: 400;
        font-size: 20px;
        font-family: Poppins;
        padding: 0;
        margin: 0;
    }

    @media (max-width:1024px) {
        .logo {
            margin-right: 0.5em;
        }
    }

    @media (max-width: 768px) {
        .navbar-toggler {
            display: none;
            /* Hide the toggler icon */
        }



        .btn-login-nav {
            margin-left: 300px;
            /* Adjust spacing from the left edge */
        }



        .navbar {
            justify-content: flex-start;
        }

    }
</style>

<body>
    <div class="conatiner-fluid p-1" style="background-color: #EBF9FF;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent ">

            <a href="http://localhost/faire-un-voyage/index.php"><img src="assets/images/logo.2.png" alt="logo" width="35em" class="navbar-link-item"></a>
            <a href="http://localhost/faire-un-voyage/index.php" class="logo navbar-brand ml-1">
                <h6 style="color:#416B8F;"><strong>Faire un</strong> <span class="lightfont">Voyage</span></h6>
            </a>

            <a class="navbar-brand" href="index.php">
                <h6 class="text-dark navbar-link-item">Home</h6>
            </a>



            <ul class="navbar-nav mr-auto">
                <?php if (isset($_SESSION['userId'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="my_flights.php">
                            <h6 class="text-dark"> My Flights</h6>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ticket.php">
                            <h6 class="text-dark"> Tickets</h6>
                        </a>
                    </li>


                <?php } ?>
            </ul>


            <?php

            if (isset($_SESSION['userId'])) {
                echo '
                <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                  <div>
                  <a class="nav-link" href="flight_list.php">
                  <h6 class="text-dark profile"><i class="fa fa-list-alt"></i> Flights List </h6>
                  </a>
                      
                  <li class="nav-item">
                  <div>
                  <a class="nav-link" href="search_flight.php">
                  <h6 class="text-dark profile"> <i class="fa fa-plus"></i> Book flight </h6>
                  </a>
                      

                    </ul>   
                <li class="nav navbar-nav dropdown">
                    <h6 class="nav-link dropdown-toggle text-dark profile" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <i class="ml-1 fa fa-user"></i>   ' . $_SESSION['userUid'] . '
                  </h6> 

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        <form action="./editprofile.php"  method="get">
                          <input name="userId" type="hidden" value=' . $_SESSION["userId"] . '>
                          <button class="dropdown-item item" type="submit">Edit Profile</button>
                        </form>

                        <form action="includes/logout.inc.php" method="POST">
                            <button class="dropdown-item item" type="submit">Logout</button>
                        </form>

                    </div>
                </li>';
            } else {
                echo '
                <a href=./login.php class="btn btn-login-nav btn-secondary" type="button">
                    Login                            
                </a>
                </div>';
            }
            ?>
            <!-- <form action='flight.edit.php' method='get'>
                      <input name='flight_id' type='hidden' value='" . $row['flight_id'] . "'>
                        <button class='btn' type='submit'>
                          <i class='text-success fa fa-pencil'></i>
                        </button>
                      </form> -->
    </div>
    </div>
    </nav>