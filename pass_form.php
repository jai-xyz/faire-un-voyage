<?php include_once 'helpers/helper.php'; ?>
<?php subview('header.php'); ?>
<link rel="stylesheet" href="assets/css/form.css">
<style>
    .main-col {
        padding: 30px;
        background-color:#fff;
        box-shado   : 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        margin-top: 50px;
    }

    .pass-form {
        background-color: #fff;
        border: 5px #607d8b;
        padding: 20px;
        margin-top: 30px;
    }

    body {
  
        background-color: #EBF9FF;
        height: 100%;
        width: 100%;


    }

    @font-face {
        font-family: 'product sans';
        src: url('assets/css/Product Sans Bold.ttf');
    }

    h1 {
        font-size: 42px !important;
        margin-bottom: 20px;
        font-family: 'product sans' !important;
        font-weight: bolder;
    }

    input {
        border: 0px !important;
        border-bottom: 2px solid #424242 !important;
        color: #424242 !important;
        border-radius: 0px !important;
        font-weight: bold !important;
        margin-bottom: 10px;
    }

    label {
        color: #828282 !important;
        font-size: 19px;
    }

    @media screen and (max-width: 900px) {
        body {
            /*  background: #bdc3c7; fallback for old browsers */
            /* background: -webkit-linear-gradient(to right, #2c3e50, #bdc3c7);   Chrome 10-25, Safari 5.1-6 */
            /* background: linear-gradient(to right, #2c3e50, #bdc3c7);  W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

            background-color: #EBF9FF;
            height: 100%;
            width: 100%;

        }
    }
</style>
<?php
if (isset($_GET['success'])) {
    if ($_GET['success'] === 'details') {
        echo "<script>alert('Passenger details added successfully');</script>";
    }
}

if (isset($_GET['error'])) {
    if ($_GET['error'] === 'errdetails') {
        echo "<script>alert('Failed to add passenger details');</script>";
    }
}

?>

<?php
if (isset($_GET['error'])) {
    $errorMessage = '';
    if ($_GET['error'] === 'invdate') {
        $errorMessage = "Invalid date of birth. Please enter a valid date. <a href='./index.php?login=success'>Click here to book and fill up form.</a> ";
    } else if ($_GET['error'] === 'moblen') {
        $errorMessage = "Invalid mobile number. Please enter an 11-digit mobile number. <a href='./index.php?login=success'>Click here to book and fill up form.</a> ";
    } else if ($_GET['error'] === 'sqlerror') {
        $errorMessage = "Database error. Please try again later.";
    }

    if (!empty($errorMessage)) {
        echo '<div class="alert alert-danger">' . $errorMessage . '</div>';
    }
}
?>
<?php if (isset($_SESSION['userId']) && isset($_POST['book_but'])) {
    $flight_id = $_POST['flight_id'];
    $passengers = $_POST['passengers'];
    $price = $_POST['price'];
    $class = $_POST['class'];
    $type = $_POST['type'];
    $ret_date = $_POST['ret_date'];

    $airline = $_POST['airline'];
    $departure = $_POST['departure'];
    $arrivale = $_POST['arrivale'];

    $dep_city = $_POST['dep_city'];
    $arr_city = $_POST['arr_city'];
?>
    <main>
        <div class="container mb-5">
            <div class="col-md-12 main-col" style="background-color: #425560;">
                <h1 class="text-center  text-light">PASSENGER DETAILS</h1>
                <form action="includes/pass_detail.inc.php" class="needs-validation mt-4" method="POST" >

                    <input type="hidden" name="type" value=<?php echo $type; ?>>
                    <input type="hidden" name="ret_date" value=<?php echo $ret_date; ?>>
                    <input type="hidden" name="class" value=<?php echo $class; ?>>
                    <input type="hidden" name="passengers" value=<?php echo $passengers; ?>>
                    <input type="hidden" name="price" value=<?php echo $price; ?>>
                    <input type="hidden" name="flight_id" value=<?php echo $flight_id; ?>>

                    <input type="hidden" name="airline" value=<?php echo $airline; ?>>
                    <input type="hidden" name="departure" value=<?php echo $departure; ?>>
                    <input type="hidden" name="arrivale" value=<?php echo $arrivale; ?>>

                    <input type="hidden" name="dep_city" value=<?php echo $dep_city; ?>>
                    <input type="hidden" name="arr_city" value=<?php echo $arr_city; ?>>


                    <?php for ($i = 0; $i < $passengers; $i++) {
                        echo '   
            <div class="pass-form">
            <div class="form-row">
                <div class="col-md">
                    <label for="passenger_type' . $i . '">Passenger Type: </label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="passenger_type[' . $i . ']" id="passenger_type_child' . $i . '" value="child" required>
                        <label class="form-check-label" for="passenger_type_child' . $i . '">Child</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="passenger_type[' . $i . ']" id="passenger_type_adult' . $i . '" value="adult" required>
                        <label class="form-check-label" for="passenger_type_adult' . $i . '">Adult</label>
                    </div>
                </div>
            </div>

             <div class="form-row">
                <div class="col-md">
                    <div class="input-group">
                        <label for="firstname' . $i . '">First name</label>
                        <input type="text" name="firstname[]" id="firstname' . $i . '" class="pl-0 pr-0" required style="width: 100%;" autocomplete="off">
                        <span class="invalid-feedback"></span>
                    </div>
                </div>
        
                <div class="col-md">
                    <div class="input-group">
                        <label for="midname' . $i . '">Middle name</label>
                        <input type="text" name="midname[]" id="midname' . $i . '" class="pl-0 pr-0" required style="width: 100%;" autocomplete="off">
                        <span class="invalid-feedback"></span>
                    </div>
                </div>
        
                <div class="col-md">
                    <div class="input-group">
                        <label for="lastname' . $i . '">Last name</label>
                        <input type="text" name="lastname[]" id="lastname' . $i . '" class="pl-0 pr-0" required style="width: 100%;" autocomplete="off">
                        <span class="invalid-feedback"></span>
                    </div>
                </div>
            </div>
        
            <div class="form-row">
                <div class="col-md">
                    <div class="input-group">
                        <label for="mobile' . $i . '">Contact No</label>
                        <input type="tel" name="mobile[]" maxlength="11" id="mobile' . $i . '" required autocomplete="off">
                        <span class="invalid-feedback"></span>
                    </div>
                </div>
        
                <div class="col-md">
                    <div class="form-group mt-3">
                        <label for="date">Date of Birth</label>
                        <input type="date" id="date" name="date[]" required> <br>
                        <span class="invalid-feedback"></span>
                    </div>
                </div>
            </div>
        </div>';
                    }  ?>
                    <div class="col text-center">
                        <button name="pass_but" type="submit" class="btn btn-success mt-4">
                            <div style="font-size: 1.5rem;">
                                <i class="fa fa-lg fa-arrow-right"></i> Proceed
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <?php subview('footer.php'); ?>
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


            $(document).ready(function() {
                $('input[name="mobile[]"]').on('change', function() {
                    var mobileNumber = $(this).val();
                    if (mobileNumber.length < 11) {
                        $(this).siblings('.invalid-feedback').text('Please enter a valid 11-digit mobile number.').show();
                    } else {
                        $(this).siblings('.invalid-feedback').hide();
                    }
                });
            });

            $(document).ready(function() {
                $('.pass-form input').on('invalid', function() {
                    var field = $(this).attr('name');
                    var message = '';

                    switch (field) {
                        case 'firstname[]':
                            message = 'Please enter a valid first name.';
                            break;
                        case 'midname[]':
                            message = 'Please enter a valid middle name.';
                            break;
                        case 'lastname[]':
                            message = 'Please enter a valid last name.';
                            break;
                        case 'mobile[]':
                            message = 'Please enter a valid 11-digit mobile number.';
                            break;
                        case 'date[]':
                            message = 'Please enter a valid date of birth.';
                            break;
                            // Add more cases for other fields as needed
                        default:
                            message = 'Invalid input.';
                    }

                    $(this).siblings('.invalid-feedback').text(message).show();
                });
            });


            $(document).ready(function() {
                $('#date').on('change', function() {
                    var enteredDate = new Date($(this).val());
                    var today = new Date();

                    if (enteredDate >= today) {
                        $(this).siblings('.invalid-feedback').text('Date of birth cannot be in the future.').show();
                    } else {
                        $(this).siblings('.invalid-feedback').hide();
                    }
                });
            });
        </script>
    </main>
<?php } ?>