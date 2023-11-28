<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Instagram</title>
    <link rel="icon" href="../instagram.ico">
    <link rel="stylesheet" href="auth-styles.css">
</head>
<body>
<div class="container">
    <img class="auth-gif" src="../images/auth-vid.gif" alt="usage">
    <div>
        <div class="block-auth">
            <img src="../images/auth-instagram.png" alt="instagram">
            <form action="registration_process.php" method="post">
                <input type="text" name="email" placeholder="Email">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">

                <button type="submit" class="auth-button">Register</button>
            </form>
        </div>
        <div class="block-auth">

            <p class="auth-text">Have an account?</p>
            <div class="switch">
                <a href="login.php" class="auth-remove">Login</a> </div>
        </div>
        <div class='block-apps'>
            <a class="auth-get">Get the app.</a>
            <a href="https://apps.apple.com/us/app/instagram/id389801252"><img src="../images/apps.png" alt="apps"></a>
        </div>
    </div>
</div>
<footer>
    <div>
        <p>Meta</p>
        <p>About</p>
        <p>Blog</p>
        <p>Jobs</p>
        <p>Help</p>
        <p>API</p>
        <p>Privacy</p>
        <p>Terms</p>
        <p>Locations</p>
        <p>Instagram Lite</p>
        <p>Threads</p>
        <p>Contact Uploading & Non-Users</p>
        <p>Meta Verified</p>
    </div>
    <div>
        <p>English</p>
        <p>&copy; 2023 Instagram from Meta </p>
    </div>
</footer>
</body>
</html>