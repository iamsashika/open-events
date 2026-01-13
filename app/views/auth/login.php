<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
</head>

<body>

  <h2>Login</h2>

  <form method="post" action="<?= url('auth/login') ?>">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>

    <button type="submit">Login</button>
  </form>

  <?php

  if (flash_has('login-success')): ?>
    <div class="flash-success">
      <?= flash_get('login-success') ?>
    </div>
  <?php elseif (flash_has('login-error')): ?>
    <div class="flash-error">
      <?= flash_get('login-error') ?>
    </div>
  <?php endif; ?>
  Don't have an account? <a href="<?= url('auth/register') ?>">Register</a><br>
  Forgot your password? <a href="<?= url('auth/reset-password-request') ?>">Reset Password</a>
</body>

</html>