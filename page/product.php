<?php
    $sql_showPd = "SELECT * FROM shoes ORDER BY id";
    $query_showPd = mysqli_query($mysqli, $sql_showPd);
?>

<div class="App_card">
    
    <div class="AppcardTop">
        <img src="./app/assets/nike.png" alt="" class="App_cardTopLogo">
    </div>
    <div class="App_cardTittle">
        Our Products
    </div>

    <div class="App_cardBody">
    <?php 
        while($row = mysqli_fetch_array($query_showPd)){
  
    ?>
    <div class="App_shopItem">
        <form method ="POST" action="./page/addCart.php?idpd=<?php echo $row['id'] ?>">
            <div class="App_shopItemImage" style="background-color: <?php echo $row['color'] ?>;">
                <img src="<?php echo $row['image'] ?>" alt="">
            </div>
            <div class="App_shopItemName"><?php echo $row['name'] ?></div>
            <div class="App_shopItemDescription"><?php echo $row['description'] ?></div>
            <div class="App_shopItemBottom">
                <div class="App_shopItemPrice">$<?php echo $row['price'] ?></div>
                <?php
                // Check product in cart
                $inCart = false;
                if (isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $cart_item) {
                        if ($cart_item['id'] == $row['id']) {
                            $inCart = true;
                            break;
                        }
                    }
                }
                ?>

                <?php if($inCart != true) {?>
                        <!-- -------------ADD CART-------------- -->
                            <div class="App_shopItemButton">
                                <p><input class="addToCart App_shopItemButtonInput" name="addToCart" type="submit" value="ADD TO CART"></p>
                            </div>
                <?php } else {?>
                <!-- -------------IN ACTIVE-------------- -->
                        <div class="App_inactive App_shopItemButton">
                            <div class="App_shopItemButtonCover">
                                <div class="App_shopItemButtonCoverCheckIcon"></div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
        </form>
    <?php
        }
    ?>
    </div>

</div>

