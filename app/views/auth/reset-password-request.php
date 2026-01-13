<!DOCTYPE html>
<html>

<head>
  <title>Reset Password Request</title>
</head>

<body>

  <h2>Reset Password Request</h2>

  <form method="post" action="<?= url('auth/reset-password') ?>">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <button type="submit">Send Reset Link</button>
  </form>

</body>

</html>