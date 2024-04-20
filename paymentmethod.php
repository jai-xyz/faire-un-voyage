<?php include_once 'helpers/helper.php'; ?>
<?php subview('header.php'); ?>
<link rel="stylesheet" href="assets/css/form.css">
<style>
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

    .input-group-addon {
        background-color: transparent;
        border-left: 0;
    }

    .card-body {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    @font-face {
        font-family: 'product sans';
        src: url('assets/css/Product Sans Bold.ttf');
    }

    h1 {
        font-size: 50px !important;
        margin-bottom: 20px;
        font-family: 'product sans' !important;
        font-weight: bolder;
    }

    .cc-number.identified {
        background-repeat: no-repeat;
        background-position-y: 3px;
        background-position-x: 99%;
    }

    .one-card>div {
        height: 150px;
        background-position: center center;
        background-repeat: no-repeat;
    }

    .two-card>div {
        height: 80px;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: contain;
        width: 48%;
    }

    .two-card div.amex-cvc-preview {
        float: right;
    }

    body {
  /*  background: #bdc3c7; fallback for old browsers */
  /* background: -webkit-linear-gradient(to right, #2c3e50, #bdc3c7);   Chrome 10-25, Safari 5.1-6 */
  /* background: linear-gradient(to right, #2c3e50, #bdc3c7);  W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  
  background-color: #EBF9FF; 
	height: 100%;
	width: 100%; 


    }

    textarea:focus,
    textarea.form-control:focus,
    input.form-control:focus,
    input[type=text]:focus,
    input[type=password]:focus,
    input[type=email]:focus,
    input[type=number]:focus,
    [type=text].form-control:focus,
    [type=password].form-control:focus,
    [type=email].form-control:focus,
    [type=tel].form-control:focus,
    [contenteditable].form-control:focus {
        box-shadow: inset 0 -1px 0 #ddd;
    }
</style>


        <?php if(isset($_SESSION['userId']) && isset($_POST['pass_but'])) {   
     $flight_id = $_POST['flight_id'];
     $class = $_POST['class'];
     $passengers = $_POST['passengers']; 
     $price = $_POST['price'];
     $type = $_POST['type'];
     $ret_date = $_POST['ret_date'];
     $passenger_type = $_POST['passenger_type'];
        }
?>    
<?php if (isset($_SESSION['userId'])) {   ?>
    <main>
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] === 'sqlerror') {
                echo "<script>alert('Database error')</script>";
            } else if ($_GET['error'] === 'noret') {
                echo "<script>alert('No return flight available')</script>";
            } else if ($_GET['error'] === 'mailerr') {
                echo "<script>alert('Mail error')</script>";
            }
        }
        ?>

        <br>
        <br>
        <div class="container-fluid py-3">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 mx-auto">
                    <h3 class="text-center text-dark">CHOOSE PAYMENT METHOD</h3>
                    <div id="paymentmethod" class="card">
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment-method" id="online-payment" value="online" checked>
                                <label class="form-check-label" for="online-payment">Online Payment</label>
                            </div>

                            <hr>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment-method" id="cash-payment" value="cash">
                                <label class="form-check-label" for="cash-payment">Cash Payment</label>
                            </div>

                            <br />

                            <div class='form-row'>
                                <div class='col-md-12 mb-2'>
                                    <a id="payment-button" href="#" class="btn btn-lg btn-primary btn-block">
                                        <i class="fa fa-lg fa-arrow-right"></i>&nbsp;
                                        <span id="payment-button-amount">Continue</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.getElementById("payment-button").addEventListener("click", function() {
            var selectedMethod = document.querySelector('input[name="payment-method"]:checked').value;
            var redirectUrl = "";
            if (selectedMethod === "online") {
                redirectUrl = "payment.php";
            } else if (selectedMethod === "cash") {
                redirectUrl = "continue-to-counter.php";
            }
            this.href = redirectUrl;
        });
    </script>
<?php } ?>