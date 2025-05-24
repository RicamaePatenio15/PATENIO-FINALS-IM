<?php include 'helpers/functions.php'; ?>
<?php template('header.php'); ?>

<?php
use Aries\MiniFrameworkStore\Models\User;

$user = new User();

if (isset($_POST['submit'])) {
    $user_info = $user->login([
        'email' => $_POST['email'],
    ]);

    if ($user_info && password_verify($_POST['password'], $user_info['password'])) {
        $_SESSION['user'] = $user_info;
        header('Location: my-account.php');
        exit;
    } else {
        $message = 'Invalid username or password';
    }
}

if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    header('Location: my-account.php');
    exit;
}
?>

<!-- External CSS -->
<link rel="stylesheet" href="assets/css/styles.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

<div class="login-wrapper" style="background-color: #f0f4f8; padding: 50px; border-radius: 15px; display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div class="login-card" style="background-color: #ffffff; padding: 60px; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); width: 100%; max-width: 600px;">
        <h1 class="text-center mb-4" style="color: #333; font-size: 2.5rem;"><i class="fas fa-user-circle me-2"></i>Login</h1>
        <h5 class="text-center text-danger"><?php echo isset($message) ? $message : ''; ?></h5>

        <form action="login.php" method="POST">
            <div class="mb-4 input-group" style="justify-content: center;">
                <span class="input-group-text" style="background-color: #007bff; color: white; font-size: 1.5rem;"><i class="fas fa-envelope"></i></span>
                <input name="email" type="email" class="form-control" placeholder="Email address" required style="max-width: 350px; font-size: 1.2rem;">
            </div>
            <div class="form-text mb-3 ms-1 text-center" style="font-size: 1rem;">We'll never share your email with anyone else.</div>

            <div class="mb-4 input-group" style="justify-content: center;">
                <span class="input-group-text" style="background-color: #007bff; color: white; font-size: 1.5rem;"><i class="fas fa-lock"></i></span>
                <input name="password" type="password" class="form-control" placeholder="Password" required style="max-width: 350px; font-size: 1.2rem;">
            </div>

            <div class="mb-4 form-check text-center">
                <input type="checkbox" class="form-check-input" id="rememberCheck" style="width: 1.5rem; height: 1.5rem;">
                <label class="form-check-label" for="rememberCheck" style="font-size: 1.2rem;">Remember me</label>
            </div>

            <button type="submit" name="submit" class="btn btn-primary mb-4 d-flex align-items-center justify-content-center gap-2" style="width: 100%; font-size: 1.5rem; padding: 15px;">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>

            <p class="text-center mt-3" style="font-size: 1.2rem;">
                Don’t have an account? <a href="register.php" class="text-decoration-none" style="color: #007bff;">Register here</a>
            </p>
        </form>
    </div>
</div>

<?php template('footer.php'); ?>
