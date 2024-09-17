Berikut Kode untuk Function Registrasi login dan config untuk Menyambungkan di DataBase

### Database Structure (MySQL)
membuat database seperti ini

```sql
CREATE DATABASE user_system;

USE user_system;

CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);
```

### Configuration File (config.php)
Source Code untuk Menyambungkan ke Database

```php
<?php
// Database configuration
$host = 'localhost';
$db   = 'user_system';
$user = 'root'; // Change to your MySQL username
$pass = '';     // Change to your MySQL password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

### Registrati (register.php)

```php
<?php
include 'config.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Email already exists";
    } else {
        // Insert user into the database
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            header('Location: login.php');
        } else {
            $error = "Registration failed";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="post">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Register</button>
    </form>
    <?php echo $error; ?>
</body>
</html>
```

### Login (login.php)

```php
<?php
session_start();
include 'config.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve user from database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['user'] = $user['username'];
            header('Location: dashboard.php');
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "User not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
    <?php echo $error; ?>
</body>
</html>
```

### Penjelasan Untuk Source Code
1. **Database** untuk menyimpan users yang telah registrasi di form Regristrasi
2. **Config.php** untuk menyambungkan ke databse
3. **login.php** untuk login menggunakan akun yang telah dibuat di form regristrasi
4. **register.php** untuk membuat akun