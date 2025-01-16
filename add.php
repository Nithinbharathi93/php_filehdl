
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datum = $_POST['inpt'] ?? '';
    if isset($_POST['adding']) {
        file_put_contents('data.txt', $datum);
        echo "content added successfully";
    } elseif isset($_POST['peeking']) {
        file_get_contents('data.txt')
    }
} 
?>


<?php
// Database connection settings
$dsn = "mysql:host=localhost;dbname=curd_app";
$username = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['uname'] ?? '';
    $email = $_POST['umail'] ?? '';
    $passwd = $_POST['pswd'] ?? '';
    $about = $_POST['abt'] ?? '';

    if (isset($_POST['add'])) {
        // Add a new user
        $sql = "INSERT INTO users (name, email, password, about) VALUES (:name, :email, :password, :about)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $passwd, 'about' => $about]);

        echo "User added successfully.";

    } elseif (isset($_POST['update'])) {
        // Update user information
        $sql = "UPDATE users SET name = :name, password = :password, about = :about WHERE email = :email";

        $stmt = $pdo->prepare($sql);

        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $passwd, 'about' => $about]);

        echo "User updated successfully.";

    } elseif (isset($_POST['know'])) {
        // Retrieve user message based on email and password
        $sql = "SELECT about FROM users WHERE email = :email AND password = :password";

        $stmt = $pdo->prepare($sql);

        $stmt->execute(['email' => $email, 'password' => $passwd]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo "Your message: " . htmlspecialchars($user['about']);
        } else {
            echo "No matching user found or incorrect credentials.";
        }

    } elseif (isset($_POST['delete'])) {
        // Delete a user
        $sql = "DELETE FROM users WHERE email = :email AND password = :password";

        $stmt = $pdo->prepare($sql);

        $stmt->execute(['email' => $email, 'password' => $passwd]);

        echo "User deleted successfully.";
    }
} 
?>
