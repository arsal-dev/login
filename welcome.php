<?php include './partials/header.php'; ?>

    <?php 
        
        if(!isset($_SESSION['username'])){
            header('Location: login.php');
        }
    
    ?>

    <h3 class="text-center mt-3">Welcome <?php echo $_SESSION['username'] ?></h3>

<?php include './partials/footer.php'; ?>