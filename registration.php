<!DOCTYPE html>
<html>
<body>
<h1>User Registration</h1>

<form action="index.php" method="post">
<p>First Name: <input type="text" name="first_name" required></p>
<p>Last Name: <input type="text" name="last_name" required></p>
<p>Email: <input type="email" name="email" required></p>
<p>Username: <input type="text" name="username" required></p>
<p>Password: <input type="password" name="password" required></p>
<p><input type="submit" value="Register"></p>
</form>

<!-- Optional: back to login button -->
<form action="index.php" method="get">
<p><input type="submit" value="Back to Login"></p>
</form>
</body>
</html>
