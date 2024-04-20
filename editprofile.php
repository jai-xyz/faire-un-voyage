<?php include_once 'helpers/helper.php'; ?>
<?php include_once 'helpers/init_conn_db.php'; ?>
<?php subview('header.php'); ?>

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

    @font-face {
        font-family: 'product sans';
        src: url('assets/css/Product Sans Bold.ttf');
    }

    h3 {
        text-align: center;
        /* font-family: 'Italianno', cursive; */
        font-family:Poppins;
        color:#343b41;
        font-weight: normal;
        font-size: 55px;
        margin-top: 20px !important;
        font-weight:bold;
    }

    

    input {
        /* background-color: #F8F9FA !important; */
        margin-bottom: 10px;
        border: 0px !important;
        border-bottom: 2px solid #838383 !important;
        color: #838383 !important;
        border-radius: 0px !important;
        font-weight: bold !important;
    }

    label {
        color: #838383 !important;
        font-size: 19px;
    }

    .register {
        margin-top: 3%;
        padding: 3%;
    }

    .register-left {
        text-align: center;
        color: #fff;
        margin-top: 4%;
    }

    .register-left input {
        border: none;
        border-radius: 1.5rem;
        padding: 2%;
        width: 60%;
        background: #f8f9fa;
        font-weight: bold;
        color: #383d41;
        margin-top: 30%;
        margin-bottom: 3%;
        cursor: pointer;
    }

    .register-right {
        background: #343b41;
        border-top-left-radius: 10% 50%;
        border-bottom-left-radius: 10% 50%;
    }

    .register-left img {
        margin-top: 15%;
        margin-bottom: 5%;
        width: 25%;
        -webkit-animation: mover 2s infinite alternate;
        animation: mover 1s infinite alternate;
    }

    @-webkit-keyframes mover {
        0% {
            transform: translateY(0);
        }

        100% {
            transform: translateY(-20px);
        }
    }

    @keyframes mover {
        0% {
            transform: translateY(0);
        }

        100% {
            transform: translateY(-20px);
        }
    }

    .register-left p {
        font-weight: lighter;
        padding: 12%;
        margin-top: -9%;
    }

    .register .register-form {
        padding: 60px;
        margin-top: 10%;
    }

    .btnRegister {
        float: right;
        margin-top: 10%;
        border: none;
        border-radius: 1.5rem;
        padding: 2%;
        background: #4e4e4e;
        color: #fff;
        font-weight: 600;
        width: 50%;
        cursor: pointer;
    }

    .register-heading {
        text-align: center;
        margin-top: 8%;
        margin-bottom: -15%;
        color: #495057;
    }

    .input-group {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .password-strength-message strong.strong {
        color: green;
    }

    .password-strength-message {
        color: #dc3545;
    }


    .password-strength-message b.strong {
        color: green;
    }

    .requirement {
        color: #dc3545;
        /* red */
    }

    .requirement.fulfilled {
        color: green;

    }
</style>
<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] === 'invalidemail') {
        echo '<script>alert("Invalid email")</script>';
    } else if ($_GET['error'] === 'pwdnotmatch') {
        echo '<script>alert("Passwords do not match")</script>';
    } else if ($_GET['error'] === 'sqlerror') {
        echo "<script>alert('Database error')</script>";
    } else if ($_GET['error'] === 'usernameexists') {
        echo "<script>alert('Username already exists')</script>";
    } else if ($_GET['error'] === 'emailexists') {
        echo "<script>alert('Email already exists')</script>";
    }
}
?>

<?php
                if (isset($_GET['userId'])) {
                    $userId = $_GET['userId'];

                    $sql = "SELECT * FROM users WHERE user_id = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, 'i', $userId);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if ($row = mysqli_fetch_assoc($result)) {
                        $first_name = $row['firstname'];
                        $middle_name = $row['middlename'];
                        $last_name = $row['lastname'];
                        $suffix = $row['suffix'];
                        $province = $row['province'];
                        $city_municipality = $row['city_municipality'];
                        $barangay = $row['barangay'];
                        $house_no = $row['house_no'];
                    } else {
                        echo '<div class="alert alert-danger">Flight not found.</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">Invalid request.</div>';
                }
                ?>


<link rel="stylesheet" href="assets/css/form.css">
<main>
    <div class="container-fluid mt-0 register">
        <div class="row">
            <!-- <div class="col-md-3 register-left">
                    
                    <h3>Welcome</h3>
                </div> -->
            <div class="col-md-1"></div>
            <div class="col-md-10 register-right">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading text-light">EDIT PROFILE </h3>
                        <div class="register-form">
                            <form method="POST" action="includes/editprofile.inc.php">
                                <div class="container-fluid">

                                    <div class="form-row">
                                        <div class="col-md-2">
                                        <label style="float: right;margin-top:20px;" class="text-light" for="first_name">First name</label>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                     
                                                <input type="text" name="first_name" id="first_name" class="text-light"  value="<?php echo $first_name; ?>" required>
                                                <div class="invalid-feedback">
                                                    Please enter a first name.
                                                </div>
                                            </div>
                                        </div>

                                           <div class="col-md-2">
                                        <label style="float: right;margin-top:20px;"  class="text-light"  for="middle_name">Middle name</label>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                
                                                <input type="text" name="middle_name"  class="text-light"  id="middle_name" value="<?php echo $middle_name; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                    <div class="col-md-2">
                                        <label style="float: right;margin-top:20px;"   class="text-light"  for="last_name">Last name</label>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                            
                                                <input type="text" name="last_name" id="last_name"  class="text-light"  value="<?php echo $last_name; ?>" required>
                                                <div class="invalid-feedback">
                                                    Please enter a last name.
                                                </div>
                                            </div>
                                        </div>
                                          <div class="col-md-2">
                                        <label style="float: right;margin-top:20px;"   class="text-light"  for="suffix">Suffix</label>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                                <input type="text" name="suffix" id="suffix"  class="text-light"  value="<?php echo $suffix; ?>">
                                            </div> 
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-row">
                                    <div class="col-md-2">
                                        <label style="float: right;margin-top:20px;"   class="text-light"  for="province">Province</label>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                                <input type="text" name="province" id="province"  class="text-light"  value="<?php echo $province; ?>" required>
                                                <div class="invalid-feedback">
                                                    Please enter Province.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        <label style="float: right;margin-top:20px;"  class="text-light"   for="city_municipality">City/Municipality</label>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                      
                                                <input type="text" name="city_municipality"  class="text-light"  id="city_municipality" value="<?php echo $city_municipality; ?>" required>
                                                <div class="invalid-feedback">
                                                    Please enter City/Municipality.
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-row">
                                    <div class="col-md-2">
                                          <label style="float: right;margin-top:20px;"  class="text-light"  for="barangay">Barangay</label>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                        
                                                <input type="text" name="barangay" id="barangay"  class="text-light"  value="<?php echo $barangay; ?>" required>
                                                <div class="invalid-feedback">
                                                    Please enter Barangay.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                          <label style="float:right;margin-top:20px;"  class="text-light"  for="house_no">House No./Unit</label>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                
                                                <input type="text" name="house_no" id="house_no"  class="text-light"  value="<?php echo $house_no; ?>" required>
                                                <div class="invalid-feedback">
                                                    Please enter House No./Unit.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <br>

                                    <div class="text-center">
                                    <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                                        <div class="invalid-feedback" id="generalInvalidFeedback">Please review and complete all required information before proceeding.</div> <br>
                                        <button name="editbutton" type="submit" class="btn btn-success mt-0"  onclick='return confirm("Are you sure you sure with the changes?")'>
                                            <div style="font-size: 1.5rem;">
                                               Save Changes
                                            </div>
                                        </button>
                                     </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
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
            // $('#test-form').submit(function(e){
            //   e.preventDefault() ;
            //   alert("Thank you") ;
            // })
        });
    </script>




    <script>
        const firstName = document.getElementById('first_name');
        const lastName = document.getElementById('last_name');
        const province = document.getElementById('province');
        const cityMunicipality = document.getElementById('city_municipality');
        const barangay = document.getElementById('barangay');
        const houseNo = document.getElementById('house_no');

        const inputs = [firstName, lastName, province, cityMunicipality, barangay, houseNo];

        inputs.forEach(input => {
            input.addEventListener('blur', () => {
                if (!input.checkValidity()) {
                    input.classList.add('is-invalid');
                    input.nextElementSibling.style.display = 'block';
                } else {
                    input.classList.remove('is-invalid');
                    input.nextElementSibling.style.display = 'none';
                }
            })
        })
    </script>

</main>




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
