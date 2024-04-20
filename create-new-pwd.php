<?php
require 'helpers/init_conn_db.php';
$token =  $_GET["token"];

$token_hash = hash("sha256", $token);

$sql = "SELECT * FROM users 
        WHERE reset_token_hash = ?";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header('Location: ../reset-pwd.php?err=sqlerr');
    exit();
} else {
    mysqli_stmt_bind_param($stmt, 's', $token_hash);
    mysqli_stmt_execute($stmt);

    $result = $stmt->get_result();

    $user = $result->fetch_assoc();


    if ($user === null) {
        die("token not found");
    }

    if (strtotime($user["reset_token_expires_at"]) <= time()) {
        die("token has expired");
    }
    //  echo "token is valid and hasn't expired";  
}
?>
<?php include_once 'helpers/helper.php'; ?>
<?php subview('header.php'); ?>


<link rel="stylesheet" href="assets/css/login.css">
<style>
    @font-face {
        font-family: 'product sans';
        src: url('assets/css/Product Sans Bold.ttf');
    }

    h1 {
        font-family: 'product sans' !important;
        font-size: 48px !important;
        margin-top: 20px;
        text-align: center;
    }

    body {
        background-color: #EBF9FF;
        height: 100%;
        width: 100%;

    }

    .login-form {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 0px;
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
// if (isset($_GET['err']) || isset($_GET['pwd'])) {
//     if ($_GET['err'] === 'pwdnotmatch') {
//         echo '<script>alert("Passwords do not match");</script>';
//     } else if ($_GET['err'] === 'sqlerr') {
//         echo '<script>alert("An error occured");</script>';
//     } else if ($_GET['pwd'] === 'updated') {
//         echo '<script>alert("Your password has been updated");</script>';
//     }
//     exit();
// }
?>
<div class="flex-container">
    <div class="login-form mt-4" style="height: 420px;">
        <h1 class="text-dark mb-3 text-center">Reset Password</h1>
        <form method="POST" action="includes/create-new-pwd-inc.php" id="registrationForm">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
            <div class="flex-container">
                <div>
                    <i class="fa fa-lock text-primary"></i>
                </div>
                <div>
                    <input type="password" name="password" class="form-input" id="password" placeholder="Enter password" required>
                    <div class="password-strength-message" style="margin-top: 0.25rem; font-size: 80%; color: #dc3545;">
                                                    <span class="strength-feedback" style="margin-top: 0.25rem; color: #dc3545;"><strong></strong> </span><br>
                                                    <span class="requirement header"><strong>Password must:</strong></span><br>
                                                    <span class="requirement capital">Have at least one capital letter.</span><br>
                                                    <span class="requirement number">Have at least one number.</span><br>
                                                    <span class="requirement length">Be at least 8 characters.</span>
                                                </div>
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <i class="fa fa-lock text-primary"></i>
                </div>
                <div>
                    <input type="password" name="password_repeat" class="form-input" id="password_repeat" placeholder="Confirm password" required>
                    <span class="invalid-feedback">Passwords do not match</span>
                </div>
            </div><br>
                <div class="submit">
            <button name="new-pwd-submit" type="submit" class="button">Submit</button>
            </div>
        </form>
    </div>
</div>

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

            const strengthFeedback = document.querySelector('.strength-feedback strong');
    if (password.match(/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/)) {
        strengthFeedback.textContent = 'Password strength: Strong';
        strengthFeedback.classList.add('strong');
    } else {
        strengthFeedback.textContent = 'Password strength: Weak';
        strengthFeedback.classList.remove('strong');
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
