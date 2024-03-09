<?php
    session_start();
    include_once('../admin/config/connectdb.php');

    // plus
    if(isset($_GET['plus'])) {
        $id_plus = $_GET['plus'];
        foreach($_SESSION['cart'] as $cart_item) {
            if($cart_item['id'] != $id_plus) {
                $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'], 'price'=>$cart_item['price'], 'color'=>$cart_item['color'], 'image'=>$cart_item['image'], 'count'=>$cart_item['count'] );
                $_SESSION['cart'] = $product;
            } else {
                $count_plus = $cart_item['count'] +1;
                if($cart_item['count']<19) {
                    $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'], 'price'=>$cart_item['price'], 'color'=>$cart_item['color'], 'image'=>$cart_item['image'], 'count'=>$count_plus );
                } else {
                    $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'], 'price'=>$cart_item['price'], 'color'=>$cart_item['color'], 'image'=>$cart_item['image'], 'count'=>$cart_item['count'] );
                }
                $_SESSION['cart'] = $product;
            }

        }
        header('Location:../index.php');
    }
    // minus
    // if(isset($_GET['minus'])) {
    //     $id_minus = $_GET['minus'];
    //     $product = array();

    //     foreach($_SESSION['cart'] as $cart_item) {
    //         if($cart_item['id'] == $id_minus) {
    //             $count_minus = $cart_item['count'] -1;
            
    //             if($count_minus > 0) {
    //                 $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'], 'price'=>$cart_item['price'], 'color'=>$cart_item['color'], 'image'=>$cart_item['image'], 'count'=>$count_minus );
    //             } else {
    //                 $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'], 'price'=>$cart_item['price'], 'color'=>$cart_item['color'], 'image'=>$cart_item['image'], 'count'=>$cart_item['count'] );
                    
    //             }
    //         }
            
    //     }
    //     $_SESSION['cart'] = $product;
    //     header('Location:../index.php');
    // }

    if (isset($_GET['minus'])) {
        $id_minus = $_GET['minus'];
        $product = array();
    
        foreach ($_SESSION['cart'] as $cart_item) {
            if ($cart_item['id'] == $id_minus) {
                $count_minus = $cart_item['count'] - 1;
                // If count_minus > 0
                if ($count_minus > 0) {
                    $product[] = array(
                        'id'    => $cart_item['id'],
                        'name'  => $cart_item['name'],
                        'price' => $cart_item['price'],
                        'color' => $cart_item['color'],
                        'image' => $cart_item['image'],
                        'count' => $count_minus
                    );
                }
            } else {
                $product[] = array(
                    'id'    => $cart_item['id'],
                    'name'  => $cart_item['name'],
                    'price' => $cart_item['price'],
                    'color' => $cart_item['color'],
                    'image' => $cart_item['image'],
                    'count' => $cart_item['count']
                );
            }
        }
    
        $_SESSION['cart'] = $product;

        // If cart is EMPTY, destroy SESSION 'CART'
        if (empty($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
        header('Location:../index.php');
    }

    // remove pd
    if(isset($_SESSION['cart'])&& isset($_GET['remove'])) {
        $id_rev = $_GET['remove'];
        foreach($_SESSION['cart'] as $cart_item) {
            if($cart_item['id'] != $id_rev) {
                $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'], 'price'=>$cart_item['price'], 'color'=>$cart_item['color'], 'image'=>$cart_item['image'], 'count'=>$cart_item['count'] );
            }

        $_SESSION['cart'] = $product;
        header('Location:../index.php');
        }
    }

    // clear all pd
    if(isset($_GET['clearall']) && $_GET['clearall']==1) {
        unset($_SESSION['cart']);
        header('Location:../index.php');
    }

    // add to cart
    if(isset($_POST['addToCart'])) {
        // session_destroy();
        $id = $_GET['idpd'];
        $count = 1;
        $sql = "SELECT * FROM shoes WHERE id = '".$id."' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($query);

        if($row) {
            $new_pd = array(array('id'=>$id,'name'=>$row['name'], 'price'=>$row['price'], 'color'=>$row['color'], 'image'=>$row['image'], 'count'=>$count ));
            // check cart
            if(isset($_SESSION['cart'])) {
                $found = false;
                foreach($_SESSION['cart'] as $cart_item) {
                    // Data duplicate
                    if($cart_item['id'] == $id) {
                        $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'], 'price'=>$cart_item['price'], 'color'=>$cart_item['color'], 'image'=>$cart_item['image'], 'count'=>$count+1 );
                        $found = true;
                        // Data not duplicate
                    }else {
                        $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'], 'price'=>$cart_item['price'], 'color'=>$cart_item['color'], 'image'=>$cart_item['image'], 'count'=>$count );
                    }
                }

                if($found == false) {
                    // Merge Data
                    $_SESSION['cart'] = array_merge($product, $new_pd);
                }else {
                    $_SESSION['cart'] = $product;
                }
            }else {
                $_SESSION['cart'] = $new_pd;
            }
        }

        // print_r($_SESSION['cart']);
        header('Location:../index.php');

    }
?>