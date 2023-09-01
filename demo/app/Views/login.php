<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (session('error')) : ?>
        <div>
            <p><?= session('error') ?></p>
        </div>
    <?php endif; ?>

    <?= form_open('login') ?>
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <input type="submit" name="submit" value="Login">
        
    <?= form_close() ?>
</body>
</html>