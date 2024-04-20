<?php include_once 'header.php'; ?>
<?php require '../helpers/init_conn_db.php'; ?>

<link rel="stylesheet" href="../assets/css/flight_form.css">
<link rel="stylesheet" href="../assets/css/form.css">

<?php if (isset($_SESSION['modId'])) { ?>
   

    <style>
        input {
            border: 0px !important;
            border-bottom: 2px solid #5c5c5c !important;
            /* color :cornflowerblue !important; */
            border-radius: 0px !important;
            font-weight: bold !important;
            background-color: whitesmoke !important;
        }

        *:focus {
            outline: none !important;
        }

        label {
            /* color : #79BAEC !important; */
            color: #5c5c5c !important;
            font-size: 19px;
        }

        h5.form-name {
            /* color: cornflowerblue; */
            /* font-family: 'Courier New', Courier, monospace; */
            font-weight: 50;
            margin-bottom: 0px !important;
            margin-top: 10px;
        }

        h1 {
      
            font-size: 45px !important;
            font-family:Poppins;
            color:#343b41;
            font-weight:bold;
        }

        body {
            /* padding-top: 20px; */
            /* background-image: url('../assets/images/bg5.jpg'); */
            background-color: #efefef;
            /* background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;     */
        }

        div.form-out {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            background-color: whitesmoke !important;
            padding: 40px;
            margin-top: 30px;
        }

        select.airline {
            float: right;
            font-weight: bold !important;
            /* color :cornflowerblue !important; */
        }

        @media screen and (max-width: 900px) {
            body {
                background-color: lightblue;
                background-image: none;
            }

            div.form-out {
                padding: 20px;
                background-color: none !important;
                margin-top: 20px;
            }
        }
    </style>
    <main>
        <div class="container mt-0">
            <div class="row">
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] === 'destless') {
                        echo "<script>alert('Dest. date/time is less than src.');</script>";
                    } else if ($_GET['error'] === 'sqlerr') {
                        echo "<script>alert('Database error');</script>";
                    } else if ($_GET['error'] === 'same') {
                        echo "<script>alert('Same city specified in source and destination');</script>";
                    }
                }
                ?>
                 

                <!-- RETRIEVE DATA  -->

                <?php
                if (isset($_GET['flight_id'])) {
                    $flight_id = $_GET['flight_id'];

                    $sql = "SELECT * FROM Flight WHERE flight_id = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, 'i', $flight_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if ($row = mysqli_fetch_assoc($result)) {
                        $arrival_date = substr($row['arrivale'], 0, 10); // Extract date part
                        $arrival_time = substr($row['arrivale'], 11);     // Extract time part
                        $departure_date = substr($row['departure'], 0, 10);
                        $departure_time = substr($row['departure'], 11);
                        $source = $row['source'];
                        $destination = $row['Destination'];
                        $airline = $row['airline'];
                        $seats = $row['Seats'];
                        $status = $row['status'];
                        $price = $row['Price'];
                    } else {
                        echo '<div class="alert alert-danger">Flight not found.</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">Invalid request.</div>';
                }
                ?>
                <div class="bg-light form-out col-md-12">
                    <h1 class="text-dark text-center">EDIT FLIGHT DETAILS</h1>

                    <form method="POST" class=" text-center" action="../includes/moderator/flight.edit.inc.php">

                        <div class="form-row mb-4">
                            <div class="col-md-3 p-0">
                                <h5 class="mb-0 form-name">DEPARTURE</h5>
                            </div>
                            <div class="col">
                                <input type="date" name="source_date" class="form-control" value="<?php echo $departure_date; ?>" required>
                            </div>
                            <div class="col">
                                <input type="time" name="source_time" class="form-control" value="<?php echo $departure_time; ?>" required>
                            </div>
                        </div>


                        <div class="form-row mb-4">
                            <div class="col-md-3 ">
                                <h5 class="form-name mb-0">ARRIVAL</h5>
                            </div>
                            <div class="col">
                                <input type="date" name="dest_date" class="form-control" value="<?php echo $arrival_date; ?>" required>
                            </div>
                            <div class="col">
                                <input type="time" name="dest_time" class="form-control" value="<?php echo $arrival_time; ?>" required>
                            </div>
                        </div>

                        <div class="form-row mb-4">
                            <div class="col">
                                <?php
                                $sql = "SELECT c.city FROM Cities As c JOIN Flight AS f ON c.city = f.source WHERE f.flight_id = ?";
                                $stmt = mysqli_stmt_init($conn);
                                mysqli_stmt_prepare($stmt, $sql);
                                mysqli_stmt_bind_param($stmt, "i", $flight_id);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                $row = mysqli_fetch_assoc($result);
                                $arr_city = $row['city'];  ?>

                                <label for="Airline">Airline</label>
                                <div class="input-group">
                                    <input type="text" class="mt-4" name="dep_city" id="dep_city" value="<?php echo $arr_city; ?>" style="border: 0px; border-bottom: 
                                        2px solid #5c5c5c; background-color: whitesmoke !important;
                                        font-weight: bold !important;
                                        width:80%" required>
                                </div>
                            </div>

                            <div class="col">
                                <?php
                                $sql = "SELECT c.city FROM Cities As c JOIN Flight AS f ON c.city = f.destination WHERE f.flight_id = ?";
                                $stmt = mysqli_stmt_init($conn);
                                mysqli_stmt_prepare($stmt, $sql);
                                mysqli_stmt_bind_param($stmt, "i", $flight_id);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                $row = mysqli_fetch_assoc($result);
                                $arr_city = $row['city'];  ?>

                                <label for="Airline">Airline</label>
                                <div class="input-group">
                                    <input type="text" class="mt-4" name="arr_city" id="arr_city" value="<?php echo $arr_city; ?>" style="border: 0px; border-bottom: 
                                        2px solid #5c5c5c; background-color: whitesmoke !important;
                                        font-weight: bold !important;
                                        width:80%" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row mb-4">
                            <div class="col">
                                <div class="input-group">
                                    <select class="mt-4" name="status" id="status" style="border: 0px; border-bottom: 
                                        2px solid #5c5c5c; background-color: whitesmoke !important;
                                        font-weight: bold !important;
                                        width:80%" required>
                                        <option value="">Status</option>
                                        <option value="nydep" <?php if ($status == 'nydep') echo 'selected'; ?>>Not Yet Departed</option>
                                        <option value="dep" <?php if ($status == 'dep') echo 'selected'; ?>>Departed</option>
                                        <option value="delayed" <?php if ($status == 'delayed') echo 'selected'; ?>>Delayed</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col">
                                <label for="price">Price</label>
                                <div class="input-group">
                                    <input type="number" value="<?php echo $price; ?>" style="border: 0px; border-bottom: 2px solid #5c5c5c;" name="price" id="price" required />
                                </div>
                            </div>

                            <div class="col">
                                <?php
                                $sql = "SELECT a.airline_id AS airline_id, a.name AS airline_name FROM Airline a JOIN Flight f ON a.name = f.airline WHERE f.flight_id = ?";
                                $stmt = mysqli_stmt_init($conn);    
                                mysqli_stmt_prepare($stmt, $sql);
                                mysqli_stmt_bind_param($stmt, "i", $flight_id);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                $row = mysqli_fetch_assoc($result);
                                $airline_id = $row['airline_id']; 
                                $airline_name = $row['airline_name']; 
                                 ?>

                                <label for="Airline">Airline</label>
                                <div class="input-group">
                                  <input type="hidden" name="airline_id" value="<?php echo $airline_id; ?>">
                                    <input type="text" name="airline_name" id="airline_name" value="<?php echo $airline_name; ?>" style="border: 0px; border-bottom: 2px solid #5c5c5c;" required />
                                </div>

                            </div>


                        </div>
                        <input type="hidden" name="flight_id" value="<?php echo $flight_id; ?>">
                        <button name="update_flight_but" type="submit" class="btn btn-success mt-5 col-3"  onclick='return confirm("Are you sure you sure with the changes?")'>
                            <div style="font-size: 1.5rem;">
                                <i class=' fa fa-pencil'></i> Update
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('.input-group input').focus(function() {
                me = $(this);
                $("label[for='" + me.attr('id') + "']").addClass("animate-label");
            });
            $('.input-group input').blur(function() {
                me = $(this);
                if (me.val() == "") {
                    $("label[for='" + me.attr('id') + "']").removeClass("animate-label");
                }
            });
        });
    </script>
<?php } ?>