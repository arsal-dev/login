<?php include './partials/header.php'; ?>
<?php 
    include './partials/db_connect.php';


    $alert = 'flase';
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows > 0){
            $db_pass = $row['password'];
            if(password_verify($password, $db_pass)){
                session_start();
                $_SESSION['username'] = $row['username']; 
                header('Location: welcome.php');
            }
            else {
                $alert = 'true';
                $errors = 'Your Email or Password is worng!';
            }
        }
        else {
            $alert = 'true';
            $errors = 'Your Email or Password is worng!';
        }
    }


?>

    <?php if($alert == 'true'){ ?>
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> <?php echo $errors; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php } ?>


    <div class="container mt-5">
        <h3 class="text-center">Login</h3>
        <form action="./login.php" method="POST">
            <div class="form-group mt-3">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group mt-3">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            <p class="mt-2">Don't Have an Account? <a href="./register.php">Register</a></p>
            <input type="submit" value="Login" name="submit" class="btn btn-primary mt-2">
        </form>
    </div>

<?php include './partials/footer.php'; ?>