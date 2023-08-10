<?php
session_start();

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "kadalstore";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        // Proses login di sini
        $email = $_POST['email'];
        $password = $_POST['pswd'];

        // ... kode validasi dan proses login ...
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Login berhasil
                $_SESSION['username'] = $row['username'];
                header("Location: home.php");
                exit;
            } else {
                // Password salah
                echo "Login failed. Please check your credentials.";
            }
        } else {
            // User tidak ditemukan
            echo "User not found.";
        }
    } elseif (isset($_POST['signup'])) {
        // Proses sign-up di sini
        $username = $_POST['text'];
        $email = $_POST['email'];
        $password = $_POST['pswd'];

        // ... kode validasi dan proses sign-up ...
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Simpan data ke database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home Page</title>
    <link rel="stylesheet" href="./css/login.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" />
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="./js/script.js"></script>
</head>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true" />

        <!-- Form sign-up -->
        <div class="signup">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="text" name="text" placeholder="Username" required="" />
                <input type="email" name="email" placeholder="Email" required="" />
                <div class="password-container">
                    <input type="password" name="pswd" placeholder="Password" id="password" required="" />
                    <div class="password-signup" onclick="togglePasswordVisibility()">
                        <i class="eye" data-feather="eye"></i>
                        <i class="eye-off" data-feather="eye-off"></i>
                    </div>
                </div>
                <button type="submit" name="signup">Sign Up</button>
            </form>
        </div>

        <!-- Form login -->
        <div class="login">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="login">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" placeholder="Email" required="" />
                <div class="password-container">
                    <input type="password" name="pswd" placeholder="Password" id="passwordlog" required="" />
                    <div class="password-login" onclick="togglePasswordVisibility()">
                        <i class="eye" data-feather="eye"></i>
                        <i class="eye-off" data-feather="eye-off"></i>
                    </div>
                </div>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>

    <script>
    feather.replace();
    </script>
</body>

</html>