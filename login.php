```php
<?php
session_start();

$error = "";
$success = "";

$adminUsername = "nihan";

$adminPasswordHash = '$2y$12$I3tq9SBJcY5401NyTVMPqOh9v2nwGvoy4io0xhzE579Rv70Ifdn.y';

// Handle logout
if (isset($_GET["logout"])) {
    $_SESSION = [];
    session_destroy();

    header("Location: login.php?logged_out=1");
    exit();
}

if (isset($_GET["logged_out"])) {
    $success = "You have logged out successfully! 💗";
}

// Handle login
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if (
        $username === $adminUsername &&
        password_verify($password, $adminPasswordHash)
    ) {
        session_regenerate_id(true);
        $_SESSION["admin"] = true;

        header("Location: admin.php");
        exit();

    } else {
        $error = "Incorrect username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | nihans's Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<section>
    <h1>Admin Login 🔐</h1>

    <p>Welcome back, Eman! 💗</p>

    <p><?php echo htmlspecialchars($success); ?></p>

    <form method="POST">

        <input type="text" name="username"
        placeholder="Username" required>

        <br><br>

        <input type="password" name="password"
        placeholder="Password" required>

        <br><br>

        <button type="submit">Login 💗</button>

    </form>

    <p><?php echo htmlspecialchars($error); ?></p>

    <a href="index.php">Back to Portfolio</a>
</section>

</body>
</html>