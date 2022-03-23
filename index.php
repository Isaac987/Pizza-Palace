<?php 

include("config/db_connect.php");

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

// bad error managment
if (!$result) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
    <?php include("templates/header.php"); ?>

    <div class="row red lighten-3">
        <div class="col s12"><h1 class="center">Why Pizza?</h1></div>
        <div class="col s4"><h3 class="center">Because Pizza</h3></div>
        <div class="col s4"><p class="center"><i class="material-icons medium">local_pizza</i></p></div>
        <div class="col s4"><h3 class="center">Is Life.</h3></div>
    </div>
    <div class="container">
        <section>
            <table class="striped">
                <thead>
                <tr>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Zip Code</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($data as $user) { ?>
                <tr>
                    <td><?php echo $user["email"]; ?></td>
                    <td><?php echo $user["password"]; ?></td>
                    <td><?php echo $user["first_name"] . ' ' . $user["last_name"]; ?></td>
                    <td><?php echo $user["phone_number"]; ?></td>
                    <td><?php echo $user["zip_code"]; ?></td>
                </tr>
                <?php }?>
                </tbody>
            </table>
        </section>
    </div>

    <?php include("templates/footer.php"); ?>
</body>
</html>