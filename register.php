<?php 
    session_start();

    if (isset($_POST['register'])) {
        include('db/condb.php');

        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        $user_check = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($conn, $user_check);
        $user = mysqli_fetch_assoc($result);

        if ($user['username'] === $username) {
            echo "<script>alert('Username already exists');</script>";
        } else {
            $query = "INSERT INTO users (username, password, firstname, lastname, phone, email, levels)
                        VALUE ('$username', '$password', '$firstname', '$lastname', '$phone', '$email', 'm')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $_SESSION['success'] = "Insert user successfully";
                header("Location: login.php");
            } else {
                $_SESSION['error'] = "Something went wrong";
                header("Location: register.php");
            }
        }

    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <style>
        /* นำ CSS ที่ได้มาวางที่นี่ */
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

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px; /* ปรับขนาดของกล่องลงทะเบียน */
            width: 100%;
        }

        .profile-image {
            text-align: center;
            margin-bottom: 50px;
        }

        .profile-image img {
            width: 70px; /* Adjust the size of the profile image */
            border-radius: 50%; /* Make it a circular image */
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

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* ปรับให้ขนาด input เหมือนกันทุกแถว */
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <!-- ต่อไปเป็นส่วน HTML ของคุณ -->
    <h1>Register</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    <div class="profile-image">
            <img src="image/7136522.png" alt="Profile Image">
        </div>


        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <br>

        <input type="text" name="firstname" placeholder="First Name" required>
        <input type="text" name="lastname" placeholder="Last Name" required>
        <br>

        <input type="number" name="phone" placeholder="Phone" required>
        <input type="email" name="email" placeholder="Email" required>
        <br>
        <input type="submit" name="register" value="Register">
        <br>


        <div style="text-align: center; margin-top: 10px;">
            <h5>หากมีบัญชีผู้ใช้แล้ว คุณสามารถ <a href="login.php">เข้าสู่ระบบ</a></h5>
        </div>

    </form>
</body>

</html>