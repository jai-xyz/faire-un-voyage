<?php include_once 'helpers/helper.php'; ?>
<?php subview('header.php'); ?>
<style>
body {
  /* background: #bdc3c7;   fallback for old browsers */ 
  /* background: -webkit-linear-gradient(to right, #2c3e50, #bdc3c7);  Chrome 10-25, Safari 5.1-6 */ 
  /* background: linear-gradient(to right, #2c3e50, #bdc3c7); W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */ 
  
  background-color: #EBF9FF; 
	height: 100%;
	width: 100%; 


}
@font-face {
  font-family: 'product sans';
  src: url('assets/css/Product Sans Bold.ttf');
}
h2.brand {
    /* font-style: italic; */
    font-size: 27px !important;
}
.vl {
  border-left: 6px solid #424242;
  height: 400px;
}
p.head {
    text-transform: uppercase;
    font-family: arial;
    font-size: 17px;
    margin-bottom: 10px ;
    color: grey;  
}
p.txt {
    text-transform: uppercase;
    font-family: arial;
    font-size: 25px;
    font-weight: bolder;
}
.out {
    border-top-left-radius: 25px;
    border-bottom-left-radius: 25px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);  
    background-color: white;
    padding-left: 25px;
    padding-right: 0px;
    padding-top: 20px;
}
h2 {
    font-weight: lighter !important;
    font-size: 35px !important;
    margin-bottom: 20px;  
    font-family :'product sans' !important;
    font-weight: bolder;
}
.text-light2 {
    color: #d9d9d9;
}
h3 {
    /* font-weight: lighter !important; */
    font-size: 21px !important;
    margin-bottom: 20px;  
    font-family: Tahoma, sans-serif;
    font-weight: lighter;
}

h1 {
    margin-top: 20px;
    margin-bottom: 20px;
    font-size: 45px !important;
    font-family:Poppins;
	color:#343b41;
	font-weight:bold;
  }

</style>
<main>
  <?php if(isset($_SESSION['userId'])) {   
    require 'helpers/init_conn_db.php';   
    
    $flightId = $_SESSION['flight_id'];
    $class = $_SESSION['class'];
    $passengers = $_SESSION['passengers'];
    $price = $_SESSION['price'];
    $type = $_SESSION['type'];
    $retDate = $_SESSION['ret_date'];
    $passengerType = $_SESSION['passenger_type'];
    $passId = $_SESSION['pass_id'];
    
    $airline = $_SESSION['airline'];
    $departure = $_SESSION['departure'];
    $arrivale = $_SESSION['arrivale'];

    $dep_city = $_SESSION['dep_city'];
    $arr_city = $_SESSION['arr_city'];

    

    // $paymentStatus = $_SESSION['payment_status'];

    
    ?>     
    <div class="container mb-6"> 
    <h1 class="text-center text-dark mt-4 mb-4">FLIGHT DETAILS</h1>

                        <div class="row mb-5">                                                         
                        <div class="col-8 out">
                            <div class="row ">                                                     
                            <div class="col">
                                <h2 style="color:#416B8F;"><strong>Faire un</strong> <span style="color: #416B8F;
                                font-weight: 400;
                                font-size: 1em;
                                font-family: Poppins;
                                padding: 0;
                                margin: 0;">Voyage</span></h2>
                                </div>
                                <div class="col">
                                    <h2 class="mb-0"><?php if($class === 'E') {
                            $class_txt = 'ECONOMY';
                        } else if($class === 'B') {
                            $class_txt = 'BUSINESS'; } echo $class_txt; ?> CLASS</h2>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">  
                                <div class="col-4">
                                    <p class="head">Airline</p>
                                    <p class="txt">Core Airways</p>
                                </div>            
                                <div class="col-4">
                                    <p class="head">from</p>
                                    <p class="txt"><?php echo $dep_city ?></p>
                                </div>
                                <div class="col-4">
                                    <p class="head">to</p>
                                    <p class="txt"><?php echo $arr_city ?></p>                
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-8">
                                    <p class="head">Number of Passenger</p>
                                    <p class=" h5 text-uppercase">
                                    <?php echo $passengers ?>
                                    </p>                              
                                </div>
                                <div class="col-4">
                                    <p class="head">board time</p>
                                    <p class="txt">12:45</p>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <p class="head">departure</p>
                                    <p class="txt mb-1">  <?php echo $departure ?></p>
                                </div>            
                                <div class="col-3">
                                    <p class="head">arrival</p>
                                    <p class="txt mb-1">  <?php echo $arrivale ?></p>
                                </div>
                                <div class="col-3">
                                    <p class="head">gate</p>
                                    <p class="txt">A22</p>
                                </div>            
                                <div class="col-3">
                                    <p class="head">Total price</p>
                                    <p class="txt">₱<?php echo $price ?></p>
                                </div>                
                            </div>                    
                        </div>
                        <div class="col-4 pl-0" style="background-color:#376b8d !important;
                            padding:20px; border-top-right-radius: 25px; border-bottom-right-radius: 25px;">
                            <div class="row">  
                                <div class="col">                                    
                                <h2 class="text-light text-center brand">
                                    Online Flight Booking</h2>  
                                </div>                                      
                            </div>                             
                            <div class="row justify-content-center">
                                <div class="col-12">                                    
                                    <img src="assets/images/footer.logo.png" class="mx-auto d-block"
                                    height="180x" width="180px" alt="">
                                </div>                                
                            </div>
                            <br>
                            
                            <div class="row">
                                <h3 class="text-light2 text-center mt-2 mb-0">
                                &nbsp   &nbsp  &nbsp  &nbsp &nbsp  &nbsp Thank you for choosing us. </br> </br>
                                &nbsp  &nbsp  &nbsp  &nbsp &nbsp  &nbsp  <a href='./paymentmethod.php' class='btn btn-primary'> <i class='fa fa-lg fa-arrow-right'></i>&nbsp; Continue </a></h3>   
                            </div>                            
                        </div>   
                        
                   
                        </div>                                               
                   


                        <?php } ?>

    </div>
  </main>

  <?php subview('footer.php'); ?> 