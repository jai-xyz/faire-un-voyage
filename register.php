<?php include_once 'helpers/helper.php'; ?>

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



    h3 {
        text-align: center;
        font-family: Poppins;
        font-weight: bold;
        font-size: 55px;
        margin-top: 20px !important;
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
                        <h3 class="register-heading text-light">PASSENGER REGISTRATION</h3>
                        <div class="register-form">
                            <form method="POST" action="includes/register.inc.php" id="registrationForm">
                                <div class="container-fluid">

                                    <div class="form-row">
                                        <div class="col-1 p-0">
                                            <i style="float: right;margin-top:35px;"></i>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                                <label for="first_name" class="text-light">First Name</label>
                                                <input type="text" name="first_name" id="first_name" class="text-light"  autocomplete="off" required>
                                                <div class="invalid-feedback">
                                                    Please enter first name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1 p-0">
                                            <i style="float: right;margin-top:35px;"></i>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                                <label for="middle_name" class="text-light" >Middle Name</label>
                                                <input type="text" name="middle_name" id="middle_name" class="text-light" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-1 p-0">
                                            <i style="float: right;margin-top:35px;"></i>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                                <label for="last_name" class="text-light">Last Name</label>
                                                <input type="text" name="last_name" id="last_name" class="text-light" autocomplete="off" required>
                                                <div class="invalid-feedback">
                                                    Please enter last name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1 p-0">
                                            <i style="float: right;margin-top:35px;"></i>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                                <label for="suffix" class="text-light" >Suffix</label>
                                                <input type="text" name="suffix" id="suffix" class="text-light" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-row">
                                        <div class="col-md-2">
                                            <label style="float: right;margin-top:30px;" class="text-light" for="birthdate">Birthdate</label>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group" >
                                                <input type="date" class="text-light" name="birthdate" id="birthdate" required>
                                                <div class="invalid-feedback">
                                                    Please enter birthdate.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <label style="float: right;margin-top:30px;" class="text-light" for="gender"> Gender</label>
                                        </div>
                                        <div class="col-md" style="float: right;margin-top:5px;">
                                            <br>
                                            <div class="input-group">
                                                <select name="gender" id="gender"  required title="Please choose gender.">
                                                    <option value="">Select Gender</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="other">Other</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please choose gender.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-row">
                                        <div class="col-1 p-0">
                                            <i  style="float: right;margin-top:35px;"></i>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                                <label for="province" class="text-light" >Province</label>
                                                <input type="text" name="province" id="province" class="text-light"  autocomplete="off" required>
                                                <div class="invalid-feedback">
                                                    Please enter Province.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1 p-0">
                                            <i  style="float: right;margin-top:35px;"></i>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                                <label for="city_municipality" class="text-light">City/Municipality</label>
                                                <input type="text" name="city_municipality" id="city_municipality" class="text-light" autocomplete="off" required>
                                                <div class="invalid-feedback">
                                                    Please enter City/Municipality.
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="col-1 p-0">
                                            <i  style="float: right;margin-top:35px;"></i>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                                <label for="barangay" class="text-light">Barangay</label>
                                                <input type="text" name="barangay" id="barangay" class="text-light" autocomplete="off" required>
                                                <div class="invalid-feedback">
                                                    Please enter Barangay.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-1 p-0">
                                            <i style="float: right;margin-top:35px;"></i>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                                <label for="house_no" class="text-light">House No./Unit</label>
                                                <input type="text" class="text-light" name="house_no" id="house_no" autocomplete="off" required>
                                                <div class="invalid-feedback">
                                                    Please enter House No./Unit.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-row">
                                        <div class="col-1 p-0">
                                            <i class="fa fa-envelope text-light" style="float: right;margin-top:35px;"></i>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                                <label class="text-light" for="username">Username</label>
                                                <input type="text" name="username" id="username" class="text-light" autocomplete="off" required>
                                                <div class="invalid-feedback">
                                                    Please enter a username.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-1 p-0">
                                            <i class="fa fa-envelope text-light" style="float: right;margin-top:35px;"></i>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                                <label for="email_id" class="text-light" >Email</label>
                                                <input type="email" name="email_id" id="email_id" class="text-light" autocomplete="off" required>
                                                <div class="invalid-feedback">
                                                    Please enter a email. (example@mail.com)
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-row">
                                        <div class="col-1 p-0">
                                            <i class="fa fa-lock text-light" style="float: right;margin-top:35px;"></i>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                                <label class="text-light" for="password">Password</label>
                                                <input type="password" name="password" id="password" class="text-light" required>
                                                <div class="password-strength-message" style="margin-top: 0.25rem; font-size: 80%; color: #dc3545;">
                                                    <span style="margin-top: 0.25rem; color: #dc3545;"><strong></strong> </span><br>
                                                    <span class="requirement header"><strong>Password must:</strong></span><br>
                                                    <span class="requirement capital">Have at least one capital letter.</span><br>
                                                    <span class="requirement number">Have at least one number.</span><br>
                                                    <span class="requirement length">Be at least 8 characters.</span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-1 p-0">
                                            <i class="fa fa-lock text-light" style="float: right;margin-top:35px;"></i>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group">
                                                <label for="password_repeat" class="text-light">Confirm password</label>
                                                <input type="password" name="password_repeat" class="text-light" id="password_repeat" required>
                                                <div class="invalid-feedback">Passwords do not match</div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="text-center">
                                        <div class="invalid-feedback" id="generalInvalidFeedback">Please review and complete all required information before proceeding.</div> <br>
                                        <button name="signup_submit" type="submit" class="btn btn-success mt-0">
                                            <div style="font-size: 1.5rem;">
                                                <i class="fa fa-lg fa-arrow-right"></i> Complete
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
        const birthdate = document.getElementById('birthdate');
        const gender = document.getElementById('gender');
        const province = document.getElementById('province');
        const cityMunicipality = document.getElementById('city_municipality');
        const barangay = document.getElementById('barangay');
        const houseNo = document.getElementById('house_no');
        const usernameInput = document.getElementById('username');
        const emailInput = document.getElementById('email_id');

        const inputs = [usernameInput, emailInput, firstName, lastName, birthdate, gender, province, cityMunicipality, barangay, houseNo];

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

    <script>
        const passwordInput = document.getElementById('password');
        const requirements = document.querySelectorAll('.password-strength-message .requirement');
        const registrationForm = document.getElementById('registrationForm');
        const confirmPasswordInput = document.getElementById('password_repeat');
        const passwordInvalidFeedback = document.querySelector('#password_repeat ~ .invalid-feedback');

        passwordInput.addEventListener('input', checkPasswordStrength);

        function checkPasswordStrength() {
            const password = passwordInput.value;


            registrationForm.addEventListener('submit', (event) => {
                if (!arePasswordRequirementsFulfilled() || // Check for password requirements
                    !areOtherFormRequirementsMet()) { // Check for other form requirements
                    event.preventDefault(); // Prevent form submission
                    document.getElementById('generalInvalidFeedback').classList.add('is-invalid');
                    document.getElementById('generalInvalidFeedback').style.display = 'block';
                    // Show the general invalid feedback
                    // ... optional: hide specific invalid feedback messages ...
                }
            });


            function arePasswordRequirementsFulfilled() {
                const password = passwordInput.value;
                return password.match(/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/);
            }


            requirements.forEach(requirement => {
                const requirementType = requirement.classList[0]; // Get the first class name (e.g., "capital")
                const regex = new RegExp(`[${requirementType}]`, 'i'); // Create a regex for the specific requirement character
                if (regex.test(password) && password.match(/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/)) {
                    requirement.classList.add('fulfilled'); // Remove "not-fulfilled" class for green color (default)
                } else {
                    requirement.classList.remove('fulfilled'); // Add "not-fulfilled" class for red color
                }
            });

            const passwordStrengthMessage = document.querySelector('.password-strength-message');
            // Check overall password strength and update main message
            if (password.match(/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/)) {
                passwordStrengthMessage.querySelector('strong').textContent = 'Password strength: Strong';
                passwordStrengthMessage.querySelector('strong').classList.add('strong');
            } else {
                passwordStrengthMessage.querySelector('strong').textContent = 'Password strength: Weak';
                passwordStrengthMessage.querySelector('strong').classList.remove('strong');
            }
        }


        confirmPasswordInput.addEventListener('input', () => {
            const passwordInvalidFeedback = document.querySelector('#password_repeat ~ .invalid-feedback');
            if (passwordInput.value === confirmPasswordInput.value) {
                passwordInvalidFeedback.style.display = 'none';
            } else {
                passwordInvalidFeedback.style.display = 'block';
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#birthdate').on('change', function() {
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
