<?php

include("config/db_connect.php");

define("PAT_PASS", "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/");
define("PAT_NAME", "/^[a-zA-Z-' ]*$/");
define("PAT_PHONE", "/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/");
define("PAT_ZIP", "/^[0-9]{5}(?:-[0-9]{4})?$/");

function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$errors = ["email"=>"", "password"=>"", "confirm_password"=>"", "first_name"=>"", "last_name"=>"", "phone_number"=>"", "zip_code"=>""];
$email = $password = $confirm_password = $first_name = $last_name = $phone_number = $zip_code = '';

// on submit
if (isset($_POST["email"])) {
    $email = clean_input($_POST["email"]);
    $password = clean_input($_POST["password"]);
    $confirm_password = clean_input($_POST["confirm_password"]);
    $first_name = clean_input($_POST["first_name"]);
    $last_name = clean_input($_POST["last_name"]);
    $phone_number = clean_input($_POST["phone_number"]);
    $zip_code = clean_input($_POST["zip_code"]);

    // validate email
    if (empty($email)) {
        $errors["email"] = "must enter email!";
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        $errors["email"] = "Email invalid!";
    }

    // validate password
    if (empty($password)) {
        $errors["password"] = "must enter a password!";
    }
    else if (!preg_match(PAT_PASS, $password)) {
        $errors["password"] = "min 8 characters, atleast 1 number and letter!";
    }

    if ($password != $confirm_password) {
        $errors["confirm_password"] = "passwords must match!";
    }

    // validate name
    if (empty($first_name)) {
        $errors["first_name"] = "must enter first name!";
    }
    else if (!preg_match(PAT_NAME, $first_name)) {
        $errors["first_name"] = "only letters and white space allowed!";
    }

    if (empty($last_name)) {
        $errors["last_name"] = "must enter last name!";
    }
    else if (!preg_match(PAT_NAME, $first_name)) {
        $errors["last_name"] = "only letters and white space allowed!";
    }

    // validate phone number
    if (empty($phone_number)) {
        $errors["phone_number"] = "must enter phone number!";
    }
    else if (!preg_match(PAT_PHONE, $phone_number)) {
        $errors["phone_number"] = "enter valid phone number!";
    }

    // validate zip code
    if (empty($zip_code)) {
        $errors["zip_code"] = "must enter zip code";
    }
    else if (!preg_match(PAT_ZIP, $zip_code)) {
        $errors["zip_code"] = "enter valid zip code!";
    }

    // if no errors
    if (!array_filter($errors)) {
        $sql_check = "SELECT email FROM users WHERE email='$email'";
        $sql_insert = "INSERT INTO users(email, password, first_name, last_name, phone_number, zip_code)
                VALUES ('$email', '$password', '$first_name', '$last_name', '$phone_number', '$zip_code')";

        $result = mysqli_query($conn, $sql_check);

        // bad error managment
        if (!$result) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
        if (mysqli_num_rows($result) == 0) {
            if (!mysqli_query($conn, $sql_insert)) {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            header("Location: index.php");
        }   
        else {
            $errors["email"] = "email already exists!";
        }

        mysqli_free_result($result);
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html>
    <?php include("templates/header.php"); ?>

    <section class="container">
        <form action="signup.php" method="post">
            <ul class="collection with-header">
                <li class="collection-header"><h4>Sign Up</h4></li>
                <li class="collection-item">Account Information</li>
                <div class="signup input-field">
                    <input id="email" type="email" name="email" class="validate" value="<?php echo $email; ?>">
                    <label for="email">Email</label>
                    <div class="red-text"><?php echo $errors["email"]; ?></div>
                </div>
                <div class="signup input-field">
                    <input id="password" type="password" name="password" class="validate">
                    <label for="password">Password</label>
                    <div class="red-text"><?php echo $errors["password"]; ?></div>
                </div>
                <div class="signup input-field">
                    <input id="password" type="password" name="confirm_password" class="validate">
                    <label for="confirm_password">Confirm Password</label>
                    <div class="red-text"><?php echo $errors["confirm_password"]; ?></div>
                </div>
                <li class="collection-item">Your Information</li>
                <div class="signup input-field">
                    <input type="text" name="first_name" class="validate" value="<?php echo $first_name; ?>">
                    <label for="first_name">First Name</label>
                    <div class="red-text"><?php echo $errors["first_name"]; ?></div>
                </div>
                <div class="signup input-field">
                    <input type="text" name="last_name" class="validate" value="<?php echo $last_name; ?>">
                    <label for="last_name">Last Name</label>
                    <div class="red-text"><?php echo $errors["last_name"]; ?></div>
                </div>
                <div class="signup input-field">
                    <input type="tel" name="phone_number" class="validate" value="<?php echo $phone_number; ?>">
                    <label for="phone_number">Phone Number</label>
                    <div class="red-text"><?php echo $errors["phone_number"]; ?></div>
                </div>
                <div class="signup input-field">
                    <input type="text" name="zip_code" class="validate" value="<?php echo $zip_code; ?>">
                    <label for="zip_code">Zip Code</label>
                    <div class="red-text"><?php echo $errors["zip_code"]; ?></div>
                </div>
                <div class="row center">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Submit</button>
                </div>
            </ul>
        </form>
    </section>

    <?php include("templates/footer.php"); ?>
</body>
</html>