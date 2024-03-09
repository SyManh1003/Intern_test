<?php
    session_start();
    // session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="stylesheet" href="./css/index.css">

    <title>Gshoes</title>
</head>
<body>
    <!-- <script> 
        function animateProductAdded() {
            $("#productAddedAlert").fadeIn(300).delay(1500).fadeOut(300);
        }

        // Call this function after adding a product to the cart
        animateProductAdded();
    </script> -->
    <div class="App_mainContent">
        <?php
            include("./admin/config/connectdb.php");
            include("./page/product.php");
            include("./page/cart.php");
        ?>
        
    </div>
</body>
</html>