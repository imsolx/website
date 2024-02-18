<?php
    session_start();

    if (!isset($_SESSION['userid'])) {
        header("Location: ../login.php");
    } else {
        include('../db/condb.php');

        if (isset($_GET['id'])) {
            $user_id = $_GET['id'];

            $query = "SELECT * FROM users WHERE id = '$user_id'";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }

            if (mysqli_num_rows($result) == 1) {
                $user_data = mysqli_fetch_assoc($result);

                if (isset($_POST['update'])) {
                    $new_username = $_POST['username'];
                    $new_password = $_POST['password'];
                    $new_firstname = $_POST['firstname'];
                    $new_lastname = $_POST['lastname'];
                    $new_phone = $_POST['phone'];
                    $new_email = $_POST['email'];
                    $new_levels = $_POST['levels'];

                    $update_query = "UPDATE users SET username = '$new_username', password = '$new_password', firstname = '$new_firstname', lastname = '$new_lastname', phone = '$new_phone', email = '$new_email', levels = '$new_levels' WHERE id = '$user_id'";
                    
                    if(mysqli_query($conn, $update_query)) {
                        echo '<script>
                                if (confirm("Update successful.")) {
                                    window.location.href = "admin_page.php";
                                } else {
                                    window.location.href = "admin_page.php";
                                }
                             </script>';
                    } else {
                        echo "Update failed: " . mysqli_error($conn);
                    }
                }
            } else {
                echo "User not found.";
            }
        } else {
            echo "User ID not provided.";
        }

        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Member</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h3>Hi, <?php echo $_SESSION['user']; ?></h3>
    <p><a href="../logout.php">Logout</a></p>
    <br>

    <div>
        <a href="admin_page.php">Admin</a> /
        <a>Edit Member</a>
    </div>

    <h2>Edit Member</h2> <br>
    <form action="" method="post">

        <input type="text" name="user_id" value="<?php echo $user_data['id']; ?>" readonly>
        <input type="text" name="username" value="<?php echo $user_data['username']; ?>" required> <br>

        <input type="text" name="password" value="<?php echo $user_data['password']; ?>" required>
        <input type="text" name="firstname" value="<?php echo $user_data['firstname']; ?>" required> <br>

        <input type="text" name="lastname" value="<?php echo $user_data['lastname']; ?>" required>
        <input type="number" name="phone" value="<?php echo $user_data['phone']; ?>" required> <br>

        <input type="email" name="email" value="<?php echo $user_data['email']; ?>" required>

        <label for="levels">User Level:</label>
        <select name="levels" required>
            <option value="m" <?php echo ($user_data['levels'] == 'm') ? 'selected' : ''; ?>>Member</option>
            <option value="a" <?php echo ($user_data['levels'] == 'a') ? 'selected' : ''; ?>>Admin</option>
        </select> <br>

        <input type="submit" name="update" value="Update">
    </form>

</body>

</html>