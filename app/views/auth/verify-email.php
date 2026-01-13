<!DOCTYPE html>
<html>

<head>
  <title>Email Verification</title>
</head>

<body>

  <h2>Verify Email</h2>

  <form method="post" action="<?= url('auth/verify-email?email=' . urlencode($_GET['email'])) ?>">
    <input type="text" name="code" placeholder="Enter verification code" required><br><br>
    <button type="submit">Verify</button>
  </form>

  <?php
  if (flash_has('verification-success')): ?>
    <div class="flash-success">
      <?= flash_get('verification-success') ?>
    </div>
  <?php elseif (flash_has('verification-error')): ?>
    <div class="flash-error">
      <?= flash_get('verification-error') ?>
    </div>
  <?php endif; ?>

</body>

</html>