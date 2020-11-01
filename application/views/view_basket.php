<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">

<body class="text-white" onload="increaseHeight()" onresize="increaseHeight()">
    <div class="container w-100 text-white mb-5" id="custom_content">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h1 class="text-center w-100">Your Basket</h1>
                <?php
                if (count($data['orders']) > 0) {
                    echo '
                    <div class="row mb-3">
                        <div class="col-12">
                            <h3>Chosen Items</h3>
                        </div>
                    </div>';
                    for ($i = 0; $i < count($data['orders']); $i++) {
                        $order = $data['orders'][$i];
                        $del_btn_attributes = [
                            'class' => 'btn btn-danger h4 text-right',
                        ];
                        $hidden = ['del_order' => $order['id']];
                        if ($order['type'] != 'cm') {
                            echo '<div class="row">
                        <div class="col-1">
                            <h5>1</h5>
                        </div>
                        <div class="col-1">
                            <h5>&#215;</h5>
                        </div>';
                            $details = $order['details'];
                            echo '<div class="col-8 col-md-5 ml-md-0 ml-4"><h5>' . ucwords($order['size'] . ' ' . $details['name']) . '</h5></div>';
                            echo '<div class="col-md-2 col-6">' . form_open('order/view_basket', '', $hidden) . form_submit('del_order_btn', 'Delete', $del_btn_attributes) . form_close() . '</div>';
                            echo '<div class="col-md-3 col-6"><h5 class="text-right">&pound;' . $details['price'] . '</h5></div>';
                            echo '</div>';
                            if ($order['type'] == 'pizza') {
                                if (count($order['topping']) > 0) {
                                    echo '<div class="row"><div class="col-12"><h5>Additional Toppings</h5></div></div>';
                                    for ($i = 0; $i < count($order['topping']); $i++) {
                                        $topping = $order['topping'][$i];
                                        echo '<div class="row">';
                                        echo '<div class="col-1"><h6>1</h6></div>';
                                        echo '<div class="col-1"><h6>&#215;</h6></div>';
                                        echo '<div class="col-6"><h6>' . ucwords($topping['name']) . '</h6></div>';
                                        echo '<div class="col-3"><h6 class="text-right">&pound;' . $topping['price'] . '</h6></div>';
                                        echo '</div>';
                                    }
                                }
                            }
                        } else {
                            echo '<div class="row">
                    <div class="col-1">
                        <h5>1</h5>
                    </div>
                    <div class="col-1">
                        <h5>&#215</h5>
                    </div>';
                            echo '<div class="col-5"><h5>' . $order['name'] . ' includes (</h5></div>';
                            echo '<div class="col-2"></div>';
                            echo '<div class="col-3"><h5 class="text-right">&pound;' . $order['total_price'] . '</div>';
                            echo '</div>';
                            $items = $order['items'];
                            if (isset($items['small_pizza'])) {
                                for ($i = 0; $i < count($items['small_pizza']); $i++) {
                                    echo '<div class="row">';
                                    echo '<div class="col-1"><h6>1</h6></div>';
                                    echo '<div class="col-1"><h6>&#215</h6></div>';
                                    echo '<div class="col-8"><h6>Small ' . ucwords($items['small_pizza'][$i]) . '</h6></div>';
                                    echo '</div>';
                                }
                            }
                            if (isset($items['medium_pizza'])) {
                                for ($i = 0; $i < count($items['medium_pizza']); $i++) {
                                    echo '<div class="row">';
                                    echo '<div class="col-1"><h6>1</h6></div>';
                                    echo '<div class="col-1"><h6>&#215</h6></div>';
                                    echo '<div class="col-8"><h6>Medium ' . ucwords($items['medium_pizza'][$i]) . '</h6></div>';
                                    echo '</div>';
                                }
                            }
                            if (isset($items['large_pizza'])) {
                                for ($i = 0; $i < count($items['large_pizza']); $i++) {
                                    echo '<div class="row">';
                                    echo '<div class="col-1"><h6>1</h6></div>';
                                    echo '<div class="col-1"><h6>&#215</h6></div>';
                                    echo '<div class="col-8"><h6>Large ' . ucwords($items['large_pizza'][$i]) . '</h6></div>';
                                    echo '</div>';
                                }
                            }
                            if (isset($items['small_side'])) {
                                for ($i = 0; $i < count($items['small_side']); $i++) {
                                    echo '<div class="row">';
                                    echo '<div class="col-1"><h6>1</h6></div>';
                                    echo '<div class="col-1"><h6>&#215</h6></div>';
                                    echo '<div class="col-8"><h6>Small ' . ucwords($items['small_side'][$i]) . '</h6></div>';
                                    echo '</div>';
                                }
                            }

                            if (isset($items['large_side'])) {
                                for ($i = 0; $i < count($items['large_side']); $i++) {
                                    echo '<div class="row">';
                                    echo '<div class="col-1"><h6>1</h6></div>';
                                    echo '<div class="col-1"><h6>&#215</h6></div>';
                                    echo '<div class="col-8"><h6>Large ' . ucwords($items['large_side'][$i]) . '</h6></div>';
                                    echo '</div>';
                                }
                            }
                            if (isset($items['small_drink'])) {
                                for ($i = 0; $i < count($items['small_drink']); $i++) {
                                    echo '<div class="row">';
                                    echo '<div class="col-1"><h6>1</h6></div>';
                                    echo '<div class="col-1"><h6>&#215</h6></div>';
                                    echo '<div class="col-8"><h6>Small ' . ucwords($items['small_drink'][$i]) . '</h6></div>';
                                    echo '</div>';
                                }
                            }

                            if (isset($items['large_drink'])) {
                                for ($i = 0; $i < count($items['large_drink']); $i++) {
                                    echo '<div class="row">';
                                    echo '<div class="col-1"><h6>1</h6></div>';
                                    echo '<div class="col-1"><h6>&#215</h6></div>';
                                    echo '<div class="col-8"><h6>Large ' . ucwords($items['large_drink'][$i]) . '</h6></div>';
                                    echo '</div>';
                                }
                            }
                            echo '<div class="row"><div class="col-6"><h5>)</h5></div>';
                            echo '<div class="col-6 text-right">' . form_open('order/view_basket', '', $hidden) . form_submit('del_order_btn', 'Delete', $del_btn_attributes) . form_close() . '</div></div>';
                        }
                        if ($i < (count($data['orders']) - 1)) {
                            echo '<div class="row"><div class="col-12"><hr class="text-warning bg-warning"></div></div>';
                        } else {
                            echo '<div class="row"><div class="col-12"><hr class="text-warning bg-warning hr-custom"></div></div>';
                        }
                    }
                    echo '<div class="row">
                    <div class="col-8">
                        <h5>Total Price</h5>
                    </div>
                    <div class="col-4">
                        <h5 class="text-right">&pound;' . $data['total_price'] . '</h5>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12 text-center">';
                    $chk_btn_attributes = [
                        'class' => 'btn btn-success',
                    ];
                    echo form_open('order/checkout');
                    echo form_submit('chk_order_btn', 'Checkout', $chk_btn_attributes);
                    echo '</div>';
                    echo form_close() . '</div></div>';
                } else {

                    echo '<div class="row mt-5 pt-5">
                        <div class="col-12">
                            <h3 class="text-center">Your basket is empty.</h3>
                            <div class="row mt-5 pt-5">
                            <a class="text-center m-auto w-100 h-100" href="' . base_url() . 'index.php/order"><button  class="btn text-center m-auto btn-success">Keep Browsing</button></a></div>
                        </div></div>';
                }
                ?>
            </div>
        </div>
    </div>
</body>