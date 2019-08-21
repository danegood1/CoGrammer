<?php

  include("config/db_connect.php");

  // Form and Error Array
  $name = $phone = $email = $address = $message = "";
  $errors = array("name" => "", "phone" => "", "email" => "", "address" => "", "message" => "");

  if(isset($_POST["submit"])){
   
    // check name
    if(empty($_POST["name"])){
      $errors["name"] = "This field is required.";
    } else {
      $name = $_POST["name"];
      if(!preg_match("/^[a-zA-Z\s]+$/", $name)){
        $errors["name"] = "Name must be letters and spaces only.";
      }
    }

    // check phone
    if(empty($_POST["phone"])){
      $errors["phone"] = "This field is required.";
    } else {
      $phone = $_POST["phone"];
      if(!filter_var($phone, FILTER_VALIDATE_FLOAT)){
        $errors["phone"] = "Phone Number must be a number.";
      }
    }

    // check email
    if(empty($_POST["email"])){
      $errors["email"] = "This field is required.";
    } else {
      $email = $_POST["email"];
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors["email"] = "Email must be a valid email address.";
      } 
    }

    // check address
    if(empty($_POST["address"])){
      $errors["address"] = "This field is required.";
    } else {
      $address = $_POST["address"];
      if(!preg_match("/^[a-zA-Z0-9,.!? ]*$/", $address)){
        $errors["address"] = "Address must be letters and numbers only.";
      } 
    }

    // check message
    if(empty($_POST["message"])){
      $errors["message"] = "This field is required.";
    } else {
      $message = $_POST["message"];
      if(!preg_match("/^([a-zA-Z\s]+)(.\s*[a-zA-Z\s]*)*$/", $message)){
        $errors["message"] = "Message must be letters and spaces only.";
      }
    }

    // Redirect
    if(array_filter($errors)){
    } else {

      $name = mysqli_real_escape_string($conn, $_POST["name"]);
      $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
      $email = mysqli_real_escape_string($conn, $_POST["email"]);
      $address = mysqli_real_escape_string($conn, $_POST["address"]);
      // Confuscate message
      $message = mysqli_real_escape_string($conn, strrev(str_replace(array("e","E"), "", $_POST["message"])));

      // create sql
      $sql = "INSERT INTO user_form(name, phone, email, address, message) VALUES('$name','$phone','$email','$address','$message')";

      // save sql to db
      if(mysqli_query($conn, $sql)){
        // success
        header("Location: add.php");
      } else {
        // error
        echo "query error: " . mysqli_error($conn); 
      }
    }

    // End of POST check
  }

?>

<!DOCTYPE html>
<html>
    <?php include("templates/header.php"); ?>

    <section class="container grey-text">
        <div class="row">
            <form class="white" action="index.php" method="POST">
                <div class="row">

                        <label>Full Name:</label>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
                        <div class="red-text"><?php echo $errors['name']; ?></div>

                        <label>Phone Number:</label>
                        <input type="text" name="phone" value="<?php echo htmlspecialchars($phone) ?>">
                        <div class="red-text"><?php echo $errors['phone']; ?></div>

                        <label>Email:</label>
                        <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
                        <div class="red-text"><?php echo $errors['email']; ?></div>

                        <label>Address:</label>
                        <input type="text" name="address" value="<?php echo htmlspecialchars($address) ?>">
                        <div class="red-text"><?php echo $errors['address']; ?></div>

                        <label>Message:</label>
                        <input type="text" name="message" size="10000" value="<?php echo htmlspecialchars($message) ?>">
                        <div class="red-text"><?php echo $errors['message']; ?></div>
                    <br>
                    <div class="center">
                        <input type="submit" name="submit" value="Submit"class="btn grey darken-2">
                    </div> 

                </div>
            </form>
        </div>
    </section>
</html>