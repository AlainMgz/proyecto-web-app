<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Login</title>
</head>
<body>
    <div class="content">
        <div class="login-container">
            <h2>Create account</h2>
            <form action="includes/procesarRegistro.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Submit</button>
            </form>

            <div class="create-account-link">
                <p>If you already have an account, <a href="login.php">login</a>.</p>
            </div>
        </div>
    </div>
</body>
</html>