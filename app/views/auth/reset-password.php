<!DOCTYPE html>
<html>

<head>
  <title>Reset Password</title>
</head>

<body>

  <h2>Reset Password</h2>

  <form method="post" action="<?= url('auth/reset-password') ?>">

    <!-- TOKEN FROM URL -->
    <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token'] ?? '') ?>">

    <input type="email" name="email" placeholder="Email" required><br><br>

    <input type="password" name="new_password" placeholder="New Password" required><br><br>

    <button type="submit">Reset Password</button>
  </form>

</body>

</html>