<?php
if (!isset($_SESSION['cart']) ) {
    $_SESSION['cart'] = array();
}

function cart_add_item($product_id, $quantity ) {
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += round($quantity, 0);
    }else{
        $_SESSION['cart'][$product_id] = round($quantity, 0);
    }
}

function cart_update_item($product_id, $quantity) {
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] = round($quantity, 0);
    }
}

function cart_remove_item($product_id) {
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

function cart_get_items() {
    $items = array();
    foreach ($_SESSION['cart'] as $product_id => $quantity ) {

        $product = get_product_by_id($product_id);
        $price = $product['price'];
        $discount = $product['discount'];
        $quantity = intval($quantity);


        $discount_amount = round($price * ($discount / 100.0), 2);
        $unit_price = $price - $discount_amount;
        $line_price = round($unit_price * $quantity, 2);


        $items[$product_id]['id'] = $product['productId'];
        $items[$product_id]['name'] = $product['productName'];
        $items[$product_id]['image'] = $product['image'];
        $items[$product_id]['description'] = $product['description'];
        $items[$product_id]['price'] = $price;
        $items[$product_id]['discount'] = $discount;
        $items[$product_id]['discount_amount'] = $discount_amount;
        $items[$product_id]['unit_price'] = $unit_price;
        $items[$product_id]['quantity'] = $quantity;
        $items[$product_id]['line_price'] = $line_price;
    }
    return $items;
}


function cart_product_count() {
    return count($_SESSION['cart']);
}



function cart_subtotal () {
    $subtotal = 0;
    $cart = cart_get_items();
    foreach ($cart as $item) {
        $subtotal += $item['unit_price'] * $item['quantity'];
    }
    return $subtotal;
}

function clear_cart() {
    $_SESSION['cart'] = array();
}

    
?>