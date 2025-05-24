<?php include 'helpers/functions.php'; ?>
<?php template('header.php'); ?>

<?php

use Aries\MiniFrameworkStore\Models\User;
use Carbon\Carbon;

$user = new User();

if (isset($_POST['submit'])) {
    $registered = $user->register([
        'name' => $_POST['full-name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'address' => $_POST['address'],
        'phone' => $_POST['phone'],
        'birthdate' => $_POST['birthdate'],
        'created_at' => Carbon::now('Asia/Manila'),
        'updated_at' => Carbon::now('Asia/Manila')
    ]);
}

if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

?>

<!-- External CSS -->
<link rel="stylesheet" href="assets/css/styles.css">
<!-- FontAwesome (for icons) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

<div class="container register-wrapper" style="background-color: #f0f4f8; padding: 60px; border-radius: 15px; display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div class="register-card" style="background-color: #ffffff; padding: 40px; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); width: 100%; max-width: 600px;">
        <h1 class="text-center mb-4" style="color: #333; font-size: 2.5rem;"><i class="fas fa-user-plus me-2"></i>Create Account</h1>
        
        <?php if (isset($registered)): ?>
            <div class="alert alert-success text-center" role="alert">
                <i class="fas fa-check-circle me-1"></i> You have successfully registered!
                <br><a href="login.php" class="alert-link">Click here to login</a>.
            </div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <div class="mb-4 input-group" style="justify-content: center;">
                <span class="input-group-text" style="font-size: 1.5rem;"><i class="fas fa-user"></i></span>
                <input name="full-name" type="text" class="form-control" placeholder="Full Name" required style="font-size: 1.2rem;">
            </div>

            <div class="mb-4 input-group" style="justify-content: center;">
                <span class="input-group-text" style="font-size: 1.5rem;"><i class="fas fa-envelope"></i></span>
                <input name="email" type="email" class="form-control" placeholder="Email Address" required style="font-size: 1.2rem;">
            </div>
            <div class="form-text mb-3 ms-1 text-center" style="font-size: 1rem;">We’ll never share your email with anyone else.</div>

            <div class="mb-4 input-group" style="justify-content: center;">
                <span class="input-group-text" style="font-size: 1.5rem;"><i class="fas fa-lock"></i></span>
                <input name="password" type="password" class="form-control" placeholder="Password" required style="font-size: 1.2rem;">
            </div>

            <div class="mb-4 input-group" style="justify-content: center;">
                <span class="input-group-text" style="font-size: 1.5rem;"><i class="fas fa-map-marker-alt"></i></span>
                <input name="address" type="text" class="form-control" placeholder="Address" style="font-size: 1.2rem;">
            </div>

            <div class="mb-4 input-group" style="justify-content: center;">
                <span class="input-group-text" style="font-size: 1.5rem;"><i class="fas fa-phone"></i></span>
                <input name="phone" type="text" class="form-control" placeholder="Phone Number" style="font-size: 1.2rem;">
            </div>

            <div class="mb-4 input-group" style="justify-content: center;">
                <span class="input-group-text" style="font-size: 1.5rem;"><i class="fas fa-calendar-alt"></i></span>
                <input name="birthdate" type="date" class="form-control" style="font-size: 1.2rem;">
            </div>

            <button type="submit" name="submit" class="btn btn-gradient w-100 d-flex align-items-center justify-content-center gap-2" style="font-size: 1.5rem; padding: 15px;">
                <i class="fas fa-user-plus"></i> Register
            </button>
        </form>

        <div class="login-link text-center mt-3" style="font-size: 1.2rem;">
            Already have an account? <a href="login.php" style="color: #007bff;">Login here</a>
        </div>
    </div>
</div>

<?php template('footer.php'); ?>
