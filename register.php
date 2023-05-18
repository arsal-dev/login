    <?php
        include './partials/header.php';  
        include './partials/db_connect.php';

        $alert = 'false';
        $success = 'false';
        if(isset($_POST['submit'])){
            $name = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];

            if($password != $cpassword){
                $alert = 'true';
                $errors = 'Passwords do not match!';
            }
            else {
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    $alert = 'true';
                    $errors = 'Email Already Exists Please <a href="./login.php">Login</a>!';
                }
                else {
                    $sql = "INSERT INTO `users` (`username`, `email`, `password`) VALUES ('$name', '$email', '$password');";
                    $result = $conn->query($sql);
                    // $result == 1, $result == true, $result == 'true
                    if($result){
                        $success = 'true';
                        $successMsg = 'Your Data Has been successfully saved you can now <a href="./login.php">Login</a>!';
                    }
                }
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

    <?php if($success == 'true'){ ?>
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> <?php echo $successMsg; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php } ?>

    <div class="container mt-5">
        <h3 class="text-center">Register Yourself</h3>
        <form action="./register.php" method="POST">
            <div class="form-group">
                <label for="name">Username</label>
                <input type="text" id="name" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group mt-3">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group mt-3">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            <div class="form-group mt-3">
                <label for="cpassword">Confirm Password</label>
                <input type="password" id="cpassword" name="cpassword" class="form-control" placeholder="Enter Password">
            </div>
            <p class="mt-2">Already Have an Account? <a href="./login.php">Login</a></p>
            <input type="submit" value="Register" name="submit" class="btn btn-primary mt-2">
        </form>
    </div>

    <?php include './partials/footer.php'; ?>