S<!DOCTYPE html>
<html>
<head>
    <title>Password Hashing</title>
    <meta charset="utf-8">
</head>
<body>
    <form method="post">
        : <input type="text" name="password" required><br><br>
        <input type="submit" name="hash" value="">
        <input type="submit" name="verify" value="">
    </form>

    <?php
    session_start();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $password = $_POST['password'];
        
        if (isset($_POST['hash'])) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $_SESSION['stored_hash'] = $hash;
            echo "<h3>: $hash</h3>";
        }
        
        if (isset($_POST['verify'])) {
            if (isset($_SESSION['stored_hash'])) {
                $match = password_verify($password, $_SESSION['stored_hash']);
                echo $match ? "<h3>match</h3>" : "<h3>no match</h3>";
            }
        }
    }
    ?>
</body>
</html>