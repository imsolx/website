<?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['userid'])) {
        header("Location: admin_page.php");
    } else {
        include('../db/condb.php');

        // Check if the user ID is provided
        if (isset($_GET['id'])) {
            $user_id = $_GET['id'];

            // Delete the user from the database
            $query = "DELETE FROM users WHERE id = $user_id";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo "User deleted successfully.";
                header("Location: admin_page.php");
            } else {
                echo "Error deleting user: " . mysqli_error($conn);
                header("Location: admin_page.php");
            }
        } else {
            echo "User ID not provided.";
        }

        // Close the database connection
        mysqli_close($conn);
    }
?>