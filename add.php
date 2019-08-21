<?php

    include("config/db_connect.php");

    // WRITE Query for all users
    $sql = "SELECT name, phone, email, address, message, id FROM user_form ORDER BY created_at";

    // ISSUE COMMAND Make query & get result
    $result = mysqli_query($conn, $sql);

    // GET DATA Fetch the rows as array
    $user_form = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // FREE result from memory
    mysqli_free_result($result);

    // CLOSE connection
    mysqli_close($conn);
 
?>

<!DOCTYPE html>
<html>

    <?php include("templates/header.php"); ?>

    <br><h4 class="center grey-text">User Profiles</h4>

    <div class="container">
        <div class="row">

            <?php foreach($user_form as $user): ?>

                <div class="col s12 md3">
                    <div class="card">
                        <div class="card-content center">
                            <h4><?php echo htmlspecialchars($user["name"]); ?></h4>
                            <div><?php echo htmlspecialchars($user["email"]); ?></div>
                            <div><?php echo htmlspecialchars($user["phone"]); ?></div>
                            <div><?php echo htmlspecialchars($user["address"]); ?></div>
                            <div><?php echo htmlspecialchars($user["message"]); ?></div>
                        </div> 
                        <div class="card-action right-align">
                            <a class="brand-text" href="details.php?id=<?php echo $user["id"] ?>">details</a>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div>

   
</html>