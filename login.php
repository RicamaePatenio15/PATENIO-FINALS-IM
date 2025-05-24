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

<div class="login-wrapper" style="background-color: #f7f7f7; padding: 50px; display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div class="login-card" style="background-color: #ffffff; padding: 40px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 100%; max-width: 400px;">
        <h1 class="text-center mb-4" style="color: #333; font-size: 2rem;">Login</h1>
        <h5 class="text-center text-danger"><?php echo isset($message) ? $message : ''; ?></h5>

        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="rememberCheck">
                <label class="form-check-label" for="rememberCheck">Remember me</label>
            </div>
            <button type="submit" name="submit" class="btn btn-orange rounded-pill" style="width: 100%;">Login</button>
            <p class="text-center mt-3">
                Don’t have an account? <a href="register.php" class="text-decoration-none" style="color: #ff7300;">Register here</a>
            </p>
        </form>
    </div>
</div>

<?php template('footer.php'); ?>