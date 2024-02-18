<?php 
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['userid'])) {
        header("Location: ../index.php");
    } else {
        // Include the database connection
        include('../db/condb.php');

        // Fetch all users from the database
        $query = "SELECT * FROM users";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h3>Hi, <?php echo $_SESSION['user']; ?></h3>
    <p><a href="../logout.php">Logout</a></p>
    <br>

    <!-- <h1>You are Admin</h1> <br> -->

    <div>
        <a>Admin</a>
    </div>

    <h2>User List</h2>
    <br>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Level</th>
            <th>Action</th>
        </tr>

        <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['username']}</td>";
                echo "<td>{$row['firstname']}</td>";
                echo "<td>{$row['lastname']}</td>";
                echo "<td>{$row['phone']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>" . ($row['levels'] == 'a' ? 'Admin' : 'Member') . "</td>";
                echo "<td>
                    <a href='edit_member.php?id={$row['id']}'>Edit</a> |
                    <a href='javascript:void(0);' onclick='confirmDelete({$row['id']})'>Delete</a>
                  </td>";
            echo "</tr>";
            }
        ?>
    </table>
    <br>
    <a href="add_member.php">Add Member</a>

    <script>
    function confirmDelete(userId) {
        var confirmation = confirm("Are you sure you want to delete this user?");
        if (confirmation) {
            window.location.href = "delete_member.php?id=" + userId;
        } else {
            window.location = "admin_page.php";
        }
    }
    </script>
</body>

</html>

<?php 
    // Close the database connection
    mysqli_close($conn);
    } // End of else statement
?>