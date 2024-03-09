<?php
    // if(isset($_SESSION['cart'])) {
    //     // echo"<pre>";
    //     //     // print_r($_SESSION['cart']);
    //     // echo"</pre>";
    // }
?>

<div class="App_card">
    <div class="AppcardTop">
        <img src="./app/assets/nike.png" alt="" class="App_cardTopLogo">
    </div>
    
    <div class="App_cardTittle">
        Your Cart
        <span id="totalAmount" class="App_cardTittleAmount"></span>
    </div>

    <div class="App_cardBody">
        <?php 
        if(isset($_SESSION['cart'])) {
            $i = 0;
            $totalAmount = 0;

            foreach($_SESSION['cart'] as $cart_item) {
                $toAmount = $cart_item['count'] * $cart_item['price'];
                $totalAmount += $toAmount;
                $i++;
        ?>
        <!-- ----------NOT EMPTY---------- -->
        <div>
            <div>
                <div id="productAddedAlert" class="App_cartItem">
                    <div class="App_cartItemLeft">
                        <div class="App_cartItemImage cartItemImage" style="background-color: <?php echo $cart_item['color'] ?>">
                            <div class="App_cartItemImageBlock">
                                <img src="<?php echo $cart_item['image'] ?>" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="App_cartItemRight cartItemRight">
                        <div class="App_cartItemName cartItemName"><?php echo $cart_item['name'] ?></div>
                        <div class="App_cartItemPrice cartItemPrice">$<?php echo $cart_item['price'] ?></div>
                        <div class="App_cartItemActions cartItemActions">
                            <div class="App_cartItemCount cartItemCount">
                                <div class="App_cartItemCountButton">
                                    <a href="./page/addCart.php?minus=<?php echo $cart_item['id'] ?>"><img src="./app/assets/minus.png" alt=""></a>
                                </div>
                                <div class="App_cartItemCountNumber"><?php echo $cart_item['count'] ?></div>
                                <div class="App_cartItemCountButton">
                                    <a href="./page/addCart.php?plus=<?php echo $cart_item['id'] ?>"><img src="./app/assets/plus.png" alt=""></a>
                                </div>
                            </div>
                            <div class="App_cartItemRemove cartItemRemove">
                                <a href="./page/addCart.php?remove=<?php echo $cart_item['id'] ?>"><img src="./app/assets/trash.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            }
            ?>  
                <!-- <input type="text" value="<?php echo number_format($totalAmount, 2)  ?>"> -->
                <p class="btn_clearCart"><a href="./page/addCart.php?clearall=1">Clear</a></p>
            <?php
        }else {
        ?>
        <!-- ----------CART IS EMPTY---------- -->
        <div class="App_cartEmpty">
            <p class="App_cartEmptyText">Your cart is empty.</p>
        </div>
        <?php
        }
        ?>
    </div>

</div>

<script>
    function updateTotalAmount() {
        var totalAmount = 0;

        <?php foreach ($_SESSION['cart'] as $cart_item) : ?>
            var toAmount<?php echo $cart_item['id']; ?> = <?php echo $cart_item['count'] * $cart_item['price']; ?>;
            totalAmount += toAmount<?php echo $cart_item['id']; ?>;
        <?php endforeach; ?>

        totalAmount = totalAmount.toFixed(2);
        // Update the totalAmount directly
        document.getElementById('totalAmount').innerText = '$' + totalAmount;

        console.log('Total amount updated successfully!');
    }

    window.onload = updateTotalAmount;
</script>