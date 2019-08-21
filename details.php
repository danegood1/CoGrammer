<?php

    include("config/db_connect.php");
    
    if(isset($_POST["delete"])){

        $id_to_delete = mysqli_real_escape_string($conn, $_POST["id_to_delete"]);

        $sql = "DELETE FROM user_form WHERE id = $id_to_delete";

        if(mysqli_query($conn, $sql)){
            // success
            header("Location: add.php");
        } {
            // failure
            echo "query error: " . mysqli_error($conn);
        }
    }

    // Check GET request id param
    if(isset($_GET["id"])){
 
        $id = mysqli_real_escape_string($conn, $_GET["id"]);

        // Make sql
        $sql = "SELECT * FROM user_form WHERE id= $id";

        // Get the query result
        $result = mysqli_query($conn, $sql);

        // Fetch result as array
        $user = mysqli_fetch_assoc($result);

        // Close query
        mysqli_free_result($result);
        mysqli_close($conn);

    }

?>

<!DOCTYPE html>
<html>

<?php include("templates/header.php"); ?>

<div class="container center">
    <?php if($user): ?>

    
    <br><h4 class="center grey-text">User Details</h4>


    <div class="container">
        <div class="card small">
            <div class="card-content center">
                <h4><?php echo htmlspecialchars($user["name"]); ?></h4>
                <br>
                <h6>Date: <?php echo date($user["created_at"]); ?></h6>
                <h6>Message: <?php echo htmlspecialchars($user["message"]); ?></h6>
            </div> 
        </div> 
    </div>

    <!-- DELETE FORM -->
    <form actions="details.php" method="POST">
        <input type="hidden" name="id_to_delete" value="<?php echo $user["id"]?>">
        <input type="submit" name="delete" value="Delete" class="btn grey darken-2">
    </form>

    <?php else: ?>

    <h4>No user record exists!</h4>

    <?php endif; ?>
</div>

</html>