<?php include_once 'helpers/helper.php'; ?>

<?php subview('header.php'); ?>
<link rel="stylesheet" href="assets/css/form.css">



<?php
// if(isset($_GET['update'])) {
//     if($_GET['update'] === 'success') {
//         echo '<script>alert("Update successful! You\'re all set to explore.");</script>';
//     }
// }    
?>


<?php

?>

<?php

if(isset($_COOKIE['Uname']) && isset($_COOKIE['Upwd'])) {
  require 'helpers/init_conn_db.php';   
  $email_id = $_POST['user_id'];
  $password = $_POST['user_pass'];
  $sql = 'SELECT * FROM Users WHERE username=? OR email=?;';
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt,$sql)) {
      header('Location: views/login.php?error=sqlerror');
      exit();            
  } else {
      mysqli_stmt_bind_param($stmt,'ss',$_COOKIE['Uname'],$_COOKIE['Uname']);            
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($row = mysqli_fetch_assoc($result)) {
          $pwd_check = password_verify($_COOKIE['Upwd'],$row['password']);
          if($pwd_check == false) {
              setcookie('Uname', '',time() - 3600);
              setcookie('Upwd', '',time() - 3600);              
              header('Location: views/login.php?error=wrongpwd');
              exit();    
          }
          else if($pwd_check == true) {
              session_start();
              $_SESSION['userId'] = $row['user_id'];
              $_SESSION['userUid'] = $row['username'];
              $_SESSION['userMail'] = $row['email'];                            
              header('Location: views/index.php?login=success');
              exit();                  
          } else {
              header('Location: views/login.php?error=invalidcred');
              exit();                    
          }
      }
      header('Location: views/login.php?error=invalidcred');
      exit();         
  }
  header('Location: views/login.php?error=invalidcred');
  exit();      
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
?>
<style>
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
  input {
    border :0px !important;
    border-bottom: 2px solid #838383 !important;
    color :#838383 !important;
    border-radius: 0px !important;
    font-weight: bold !important;
    background-color: white !important;  
    border: none;
    border-bottom: 2px solid #838383;      
  }
  *:focus {
    outline: none !important;
  }
  label {
    color : #838383 !important;
    font-size: 19px;
  }
  h5.form-name {
    color: #838383;
    font-family: 'Courier New', Courier, monospace;
    font-weight: 50;
    margin-bottom: 0px !important;
    margin-top: 10px;
  }
  h5 {
    color: #ffffff;
    font-weight: bold;
    font-size: 22px ;
	  font-family: 'Montserrat', sans-serif;    
  }
  a:hover {
    text-decoration: none;
  }
  /* .btn-outline-light {
    color :#0275d8;
    border-color: #0275d8 !important;
  }
  .btn-outline-light:hover {
    color: white !important;
    background-color: #0275d8 !important;
  } */
  @font-face {
  font-family: 'product sans';
  src: url('assets/css/Product Sans Bold.ttf');
  }
  h1 {
    font-size: 46px !important;
    margin-bottom: 20px;  
    font-family :'product sans' !important;
    font-weight: bolder;
  }
  div.form-out {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);  
    background-color: white !important;
    padding: 40px;
    margin-top: 35px;
  }
  .input-group {
  position: relative;
  display: inline-block;
  width: 100%;
}
  select {
    float: right;
    font-weight: bold !important;
    color :#838383 !important;
  }
  @media screen and (max-width: 768px){
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
<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
      <div class="bg-light form-out col-md-6">
        
      <h1 class="text-dark text-center">LOG IN PANEL</h1>
      <?php
    if(isset($_GET['error'])) {
        if($_GET['error'] === 'invalidcred') {
            echo '<div class="danger alert-danger" style="text-align: center;">Invalid username or password</div>';  
        } else if($_GET['error'] === 'wrongpwd') {
          echo '<div class="danger alert-danger" style="text-align: center;">Invalid username or password</div>';  
        } else if($_GET['error'] === 'sqlerror') {
          echo '<div class="danger alert-danger" style="text-align: center;">Database error</div>';  
        }
    }
    
if(isset($_GET['register'])) {
    if($_GET['register'] === 'success') {
      echo '<div class="success alert-success" style="text-align: center;">High five! Your account is good to go. </div>';  
      }
}    

if(isset($_GET['password'])) {
  if($_GET['password'] === 'updated') {
      echo '<div class="success alert-success" style="text-align: center;">Password updated, you can now login.</div>';  
  }
}    
?>
      <form method="POST" class=" text-center" 
        action="includes/login.inc.php">

        <div class="form-row">  
            <div class="col-1 p-0 mr-1">
                <i class="fa fa-user text-dark" 
                    style="float: right;margin-top:35px;"></i>
            </div> 
          <div class="col-10 mb-2">              
            <div class="input-group">
                <label for="user_id" class="text-dark" >Username/ Email</label>
                <input type="text" class="text-dark" name="user_id" id="user_id" autocomplete="off" required>
              </div>              
          </div>       
          <div class="col-1 p-0 mr-1">
                <i class="fa fa-lock text-dark" 
                    style="float: right;margin-top:35px;"></i>
          </div>                
          <div class="col-10">
            <div class="input-group">
                <label  class="text-dark" for="user_pass">Password</label>
                <input class="text-dark" type="password" name="user_pass" id="user_pass"
                      required>
              </div>            
          </div> 

        </div>         
 
        <div class="row">
          <div class="col">
          <a id="reset-pass" class="mr-5" href="reset-pwd.php"
              style="float: right !important; text-decoration:underline;">Reset Password</a>        
          </div>         
        </div>   
           <br>
        <div class="row mt-3">
          <div class="col">
            <a href="register.php">
              <button type="button" class="btn btn-info mt-3">
                <div style="font-size: 1.5rem;">
                <i class="fa fa-user-plus text-light"></i> Register
                </div>
              </button>
            </a> 
          </div> 
          <div class="col">
            <button name="login_but" type="submit" 
              class="btn btn-success mt-3">
              <div style="font-size: 1.5rem;">
              <i class="fa fa-lg fa-arrow-right"></i> Login
              </div>
            </button>
          </div>       
        </div>       
        
      
      </form>
    </div>
    <div class="col-md-3"></div>
    </div>
</div>  

<?php subview('footer.php'); ?> 
<script>
$(document).ready(function(){
  $('.input-group input').focus(function(){
    me = $(this) ;
    $("label[for='"+me.attr('id')+"']").addClass("animate-label");
  }) ;
  $('.input-group input').blur(function(){
    me = $(this) ;
    if ( me.val() == ""){
      $("label[for='"+me.attr('id')+"']").removeClass("animate-label");
    }
  }) ;
  // $('#test-form').submit(function(e){
  //   e.preventDefault() ;
  //   alert("Thank you") ;
  // })
});
</script>
</main>
<br>

<footer class="mt-4">
			<div style="background-color: #343b41;">

	           <h6 class="text-light text-center" style="padding: .3em 0 0 0"><img src="assets/images/footer.logo.png" 
					height="30px" width="30px" alt=""><strong>Faire un</strong> <span class="text-light" style="
        font-weight: 400;
        font-size: 20px;
        font-family: Poppins;
        padding: 0;
        margin: 0;">Voyage</span></h6>
            
	<div class="text-light text-center" style="padding: 0 0 .3em 0">&copy; <?php echo date('Y')?></div>
	</div>
	</footer>	
