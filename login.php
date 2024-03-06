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
        <?php
        if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
        ?>
        <div class="title_container">
            <p>You are already logged in!</p>
            <p>Welcome <?php echo $_SESSION['username']; ?>!</p>
        </div> 
        <?php
        } else {
        ?>
        
        <div class="formulario-container">
            <h2>Login</h2>
            <form action="includes/procesarLogin.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
            </form>

            <div class="create-account-link">
                <p>If you don't have an account, <a href="registro.php">create one</a>.</p>
            </div>
        </div>
        <?php 
        }
        ?>
    </div>
</body>
</html>