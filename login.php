<?php
    session_start();

    if (isset($_POST['login'])) {
        include('db/condb.php');
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1 ) {
            $row = mysqli_fetch_array($result);

            $_SESSION['userid'] = $row['id'];
            $_SESSION['user'] = $row['firstname'] . '' . $row['lastname'];
            $_SESSION['levels'] = $row['levels'];

            if ($_SESSION['levels'] == 'a') {
                header("Location: admin/admin_page.php");
            }
            if ($_SESSION['levels'] == 'm') {
                header("Location: f-index.html");
            }
        } else {
            echo "<script>alert('Username หรือ Password ไม่ถูกต้อง!'); </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>


<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            color: #333;
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px;
            width: 100%;

        }

        form {
            background-color: #fff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 0 auto;
        }

        .profile-image {
            text-align: center;
            margin-bottom: 50px;
        }

        .profile-image img {
            width: 70px; /* Adjust the size of the profile image */
            border-radius: 50%; /* Make it a circular image */
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        button {
            background-color: transparent;
            border: none;
            color: #007bff;
            text-decoration: underline;
            cursor: pointer;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }

    </style>


<body>
    <h1>Login</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    <div class="profile-image">
            <img src="image/7136522.png" alt="Profile Image">
        </div>

        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" name="login" value="Login">

        <div style="text-align: center; margin-top: 10px;">
        <button type="button" onclick="forgotPassword()">ลืมรหัสผ่าน</button>
        </div>
        <div style="text-align: center; margin-top: 10px;">
            <h5>เพิ่งเคยเข้ามาใน HappyTree ใช่หรือไม่<a href="register.php">สมัครใหม่</a></h5>
        </div>

    </form>

    <script>
    function forgotPassword() {
        var username = prompt("กรุณากรอกชื่อผู้ใช้ของคุณเพื่อเปลี่ยนรหัสผ่าน");

        if (username !== null) {
            window.location.href = "reset_password.php?username=" + encodeURIComponent(username);
        }
    }
    </script>
</body>

</html>