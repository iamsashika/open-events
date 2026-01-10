<h2>Register</h2>
<form method="POST" action="/auth/store">
    <input name="name" placeholder="Name" required>
    <input name="email" type="email" placeholder="Email" required>
    <input name="password" type="password" placeholder="Password" required>
    <button type="submit">Register</button>
</form>
<p>Already have an account? <a href="/auth/login">Login here</a></p>