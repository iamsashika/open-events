<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>

    <h2>Sign Up</h2>

    <form method="post" action="<?= url('auth/register') ?>">
        <input type="text" name="first_name" placeholder="First Name" required><br><br>
        <input type="text" name="last_name" placeholder="Last Name" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>

        <button type="submit">Register</button>

        Do you have an account? <a href="<?= url('auth/login') ?>">Login</a>
    </form>

</body>

</html>