<?php
    session_start();

    if (!isset($_SESSION['userid'])) {
        header("Location: ../login.php");
    } else {
        include('../db/condb.php');

        if (isset($_POST['create'])) {
            $new_username = $_POST['username'];
            $new_password = $_POST['password'];
            $new_firstname = $_POST['firstname'];
            $new_lastname = $_POST['lastname'];
            $new_phone = $_POST['phone'];
            $new_email = $_POST['email'];
            $new_levels = $_POST['levels'];

            $insert_query = "INSERT INTO users (username, password, firstname, lastname, phone, email, levels) 
                             VALUES ('$new_username', '$new_password', '$new_firstname', '$new_lastname', '$new_phone', '$new_email', '$new_levels')";
            
            if(mysqli_query($conn, $insert_query)) {
                echo '<script>
                        if (confirm("User added successfully.")) {
                            window.location.href = "admin_page.php";
                        } else {
                            window.location.href = "add_member.php";
                        }
                     </script>';
                exit();
            } else {
                echo "Add user failed: " . mysqli_error($conn);
            }
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Member</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h3>Hi, <?php echo $_SESSION['user']; ?></h3>
    <p><a href="../logout.php">Logout</a></p>
    <br>

    <div>
        <a href="admin_page.php">Admin</a> /
        <a>Add Member</a>
    </div>

    <h2>Add Member</h2>
    <form action="" method="post">

        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <br>

        <input type="text" name="firstname" placeholder="First Name" required>
        <input type="text" name="lastname" placeholder="Last Name" required>
        <br>

        <input type="number" name="phone" placeholder="Phone" required>
        <input type="email" name="email" placeholder="Email" required>
        <br>

        <label for="levels">User Level:</label>
        <select name="levels" required>
            <option value="m">Member</option>
            <option value="a">Admin</option>
        </select> <br>

        <input type="submit" name="create" value="Add User">
    </form>

</body>

</html>

<?php
        mysqli_close($conn);
    }
?>