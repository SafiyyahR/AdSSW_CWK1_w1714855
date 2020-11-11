<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">
<!-- $options = array(
                            'small'         => 'Small Pizza  - &#163;' . $table_data[$i]['pizza_pr_small'],
                            'medium'          => 'Medium Pizza - &#163;' . $table_data[$i]['pizza_pr_medium'],
                            'large'        => 'Large Pizza - &#163;' . $table_data[$i]['pizza_pr_large']
                        );
                        $js = [
                            'id'       => 'pizza_' . $table_data[$i]['pizza_id'],
                            'class' => ''
                        ];
                        // array_push($screen_pizza_price, $table_data[$i]['pizza_pr_small']);
                        echo form_dropdown('size', $options, 'small', $js) . '<br>'; -->

<body class="text-white" onload="increaseHeight()" onresize="increaseHeight()">
    <div class="container w-100 text-white mb-5" id="custom_content">
        <div class="row">
            <div class="col-12">
                <div class="mb-4">
                    <h1 class="text-center w-100">Your Basket</h1>
                </div>
                <?php
                if (count($data['orders']) > 0) {
                    for ($i = 0; $i < count($data['orders']); $i++) {
                        $order = $data['orders'][$i];
                        $upd_btn_attributes = [
                            'class' => 'btn btn-warning h4 text-right',
                            'id' => 'update_btn_' . $order['id'],
                            'style' => 'display:none;font-weight:bold',

                        ];
                        $form_class = [
                            'class' => 'm-0',

                        ];
                        $hidden = ['update_order' => $order['id']];
                        $options = array(
                            'remove'         => 'Remove'
                        );
                        for ($opt = 1; $opt < 11; $opt++) {
                            $options[$opt] = $opt;
                        }

                        $js = [
                            'id'       => 'quantity_' . $order['id'],
                            'onChange' => 'toggleUpdateOrderBtn(' . $order["id"] . ',' . $order['quantity'] . ')',
                            'style' => 'width:100%'

                        ];
                        if ($order['type'] != 'cm') {
                            echo form_open('order/view_basket', $form_class, $hidden);
                            echo '<div class="row"><div class="col-md-2 col-3">';

                            echo form_dropdown('quantity', $options, $order['quantity'], $js);
                            echo '</div>';
                            echo '<div class="col-1"><h5>&#215;</h5></div>';
                            $details = $order['details'];
                            if (isset($order['size'])) {
                                echo '<div class="col-7 col-md-5"><h5>' . ucwords($order['size'] . ' ' . $details['name']) . '</h5></div>';
                            } else {
                                echo '<div class="col-7 col-md-5"><h5>' . ucwords($details['name']) . '</h5></div>';
                            }
                            echo '<div class="col-md-2 col-6">';

                            echo form_submit('upd_order_btn', 'Update', $upd_btn_attributes) . '</div>';
                            echo '<div class="col-md-2 col-6"><h5 class="text-right ">&pound;' . $order['total_price'] . '</h5></div>';
                            echo '</div>';
                            echo form_close();
                            if ($order['type'] == 'pizza') {
                                if (count($order['topping']) > 0) {
                                    echo '<div class="row"><div class="col-12"><h5>Additional Toppings</h5></div></div>';
                                    for ($j = 0; $j < count($order['topping']); $j++) {
                                        $topping = $order['topping'][$j];
                                        echo '<div class="row">';
                                        echo '<div class="col-2"><h6>1</h6></div>';
                                        echo '<div class="col-1"><h6>&#215;</h6></div>';
                                        echo '<div class="col-5"><h6>' . ucwords($topping['name']) . '</h6></div>';
                                        echo '<div class="col-4"><h6 class="text-right">&pound;' . $topping['tp_total_price'] . '</h6></div>';
                                        echo '</div>';
                                    }
                                }
                            }
                        } else {
                            echo form_open('order/view_basket', $form_class, $hidden);
                            echo '<div class="row"><div class="col-md-2 col-3">';

                            echo form_dropdown('quantity', $options, $order['quantity'], $js);
                            echo '</div>';
                            echo '<div class="col-1"><h5>&#215;</h5></div>';
                            echo '<div class="col-7 col-md-5"><h5>' . $order['details']['name'] . ' includes (</h5></div>';
                            echo '<div class="col-md-2 col-6">';

                            echo form_submit('upd_order_btn', 'Update', $upd_btn_attributes) . '</div>';
                            echo '<div class="col-md-2 col-6"><h5 class="text-right ">&pound;' . $order['total_price'] . '</h5></div>';
                            echo '</div>';
                            echo form_close();
                            $items = $order['details']['items'];
                            if (isset($items['small_pizza'])) {
                                for ($k = 0; $k < count($items['small_pizza']); $k++) {
                                    echo '<div class="row">';
                                    echo '<div class="col-md-2 col-3"><h6>' . $order['quantity'] . '</h6></div>';
                                    echo '<div class="col-1"><h6>&#215</h6></div>';
                                    echo '<div class="col-md-5 col-7"><h6>Small ' . ucwords($items['small_pizza'][$k]) . '</h6></div>';
                                    echo '</div>';
                                }
                            }
                            if (isset($items['medium_pizza'])) {
                                for ($k = 0; $k < count($items['medium_pizza']); $k++) {
                                    echo '<div class="row">';
                                    echo '<div class="col-md-2 col-3"><h6>' . $order['quantity'] . '</h6></div>';
                                    echo '<div class="col-1"><h6>&#215</h6></div>';
                                    echo '<div class="col-md-5 col-7"><h6>Medium ' . ucwords($items['medium_pizza'][$k]) . '</h6></div>';
                                    echo '</div>';
                                }
                            }
                            if (isset($items['large_pizza'])) {
                                for ($k = 0; $k < count($items['large_pizza']); $k++) {
                                    echo '<div class="row">';
                                    echo '<div class="col-md-2 col-3"><h6>' . $order['quantity'] . '</h6></div>';
                                    echo '<div class="col-1"><h6>&#215</h6></div>';
                                    echo '<div class="col-md-5 col-7"><h6>Large ' . ucwords($items['large_pizza'][$k]) . '</h6></div>';
                                    echo '</div>';
                                }
                            }
                            if (isset($items['side'])) {
                                for ($k = 0; $k < count($items['side']); $k++) {
                                    echo '<div class="row">';
                                    echo '<div class="col-md-2 col-3"><h6>' . $order['quantity'] . '</h6></div>';
                                    echo '<div class="col-1"><h6>&#215</h6></div>';
                                    echo '<div class="col-md-5 col-7"><h6>' . ucwords($items['side'][$k]) . '</h6></div>';
                                    echo '</div>';
                                }
                            }

                            if (isset($items['drink'])) {
                                for ($k = 0; $k < count($items['drink']); $k++) {
                                    echo '<div class="row">';
                                    echo '<div class="col-md-2 col-3"><h6>' . $order['quantity'] . '</h6></div>';
                                    echo '<div class="col-1"><h6>&#215</h6></div>';
                                    echo '<div class="col-md-5 col-7"><h6>1l ' . ucwords($items['drink'][$k]) . '</h6></div>';
                                    echo '</div>';
                                }
                            }
                            echo '<div class="row"><div class="col-6"><h5>)</h5></div>';
                            echo '<div class="col-6 text-right">' . form_open('order/view_basket', '', $hidden) . form_submit('upd_order_btn', 'Update', $upd_btn_attributes) . form_close() . '</div></div>';
                        }
                        if ($i < (count($data['orders']) - 1)) {
                            echo '<div class="row"><div class="col-12"><hr class="text-warning bg-warning"></div></div>';
                        } else {
                            echo '<div class="row"><div class="col-12"><hr class="text-warning bg-warning hr-custom"></div></div>';
                        }
                    }
                    echo '<div class="row"><div class="col-8"><h5>Total Price</h5></div><div class="col-4"><h5 class="text-right">&pound;' . $data['total_price'] . '</h5></div></div>';
                } else if (!count($data['new_order']) > 0) {
                    echo '<div class="row mt-5 pt-5">
                        <div class="col-12">
                            <h3 class="text-center">Your basket is empty.</h3>
                            <div class="row mt-5 pt-5">
                            <a class="text-center m-auto w-100 h-100" href="' . base_url() . 'index.php/order"><button  class="btn text-center m-auto btn-success">Keep Browsing</button></a></div>
                        </div></div>';
                }
                if (count($data['new_order']) > 0) {
                    $details = $data['new_order'];
                    echo ' <div class="row"><div class="col-12"><h4>Confirm New Item</h4></div></div>';
                    if ($details['type'] != 'cm') {
                        echo '<div class="row"><div class="col-2"><h5>1</h5></div><div class="col-2"><h5>&#215</h5></div>';
                        if (isset($details['size'])) {
                            echo '<div class="col-5"><h5>' . ucwords($details['size'] . ' ' . $details['details']['name']) . '</h5></div>';
                        } else {
                            echo '<div class="col-5"><h5>' . ucwords($details['details']['name']) . '</h5></div>';
                        }
                        echo '<div class="col-3"><h5 class="text-right">&pound;' . $details['details']['price'] . '</h5></div>';
                        echo '</div>';
                        if ($details['type'] == 'pizza') {
                            if (count($details['topping']) > 0) {
                                echo '<div class="row"><div class="col-12"><h5>Additional Toppings</h5></div></div>';
                                for ($i = 0; $i < count($details['topping']); $i++) {
                                    $topping = $details['topping'][$i];
                                    echo '<div class="row">';
                                    echo '<div class="col-2"><h6>1</h6></div>';
                                    echo '<div class="col-2"><h6>&#215</h6></div>';
                                    echo '<div class="col-5"><h6>' . ucwords($topping['name']) . '</h6></div>';
                                    echo '<div class="col-3"><h6 class="text-right">&pound;' . $topping['price'] . '</h6></div>';
                                    echo '</div>';
                                }
                            }
                        }
                    } else {
                        echo '<div class="row"><div class="col-2"><h5>1</h5></div><div class="col-2"><h5>&#215</h5></div>';
                        echo '<div class="col-5"><h5>' . $details['details']['name'] . ' includes (</h5></div>';
                        echo '<div class="col-3"><h5 class="text-right">&pound;' . $details['total_price'] . '</div>';
                        echo '</div>';
                        $items = $details['details']['items'];
                        if (isset($items['small_pizza'])) {
                            for ($i = 0; $i < count($items['small_pizza']); $i++) {
                                echo '<div class="row">';
                                echo '<div class="col-2"><h6>1</h6></div>';
                                echo '<div class="col-2"><h6>&#215</h6></div>';
                                echo '<div class="col-8"><h6>Small ' . ucwords($items['small_pizza'][$i]) . '</h6></div>';
                                echo '</div>';
                            }
                        }
                        if (isset($items['medium_pizza'])) {
                            for ($i = 0; $i < count($items['medium_pizza']); $i++) {
                                echo '<div class="row">';
                                echo '<div class="col-2"><h6>1</h6></div>';
                                echo '<div class="col-2"><h6>&#215</h6></div>';
                                echo '<div class="col-8"><h6>Medium ' . ucwords($items['medium_pizza'][$i]) . '</h6></div>';
                                echo '</div>';
                            }
                        }
                        if (isset($items['large_pizza'])) {
                            for ($i = 0; $i < count($items['large_pizza']); $i++) {
                                echo '<div class="row">';
                                echo '<div class="col-2"><h6>1</h6></div>';
                                echo '<div class="col-2"><h6>&#215</h6></div>';
                                echo '<div class="col-8"><h6>Large ' . ucwords($items['large_pizza'][$i]) . '</h6></div>';
                                echo '</div>';
                            }
                        }
                        if (isset($items['side'])) {
                            for ($i = 0; $i < count($items['side']); $i++) {
                                echo '<div class="row">';
                                echo '<div class="col-2"><h6>1</h6></div>';
                                echo '<div class="col-2"><h6>&#215</h6></div>';
                                echo '<div class="col-8"><h6>' . ucwords($items['side'][$i]) . '</h6></div>';
                                echo '</div>';
                            }
                        }
                        if (isset($items['drink'])) {
                            for ($i = 0; $i < count($items['drink']); $i++) {
                                echo '<div class="row">';
                                echo '<div class="col-2"><h6>1</h6></div>';
                                echo '<div class="col-2"><h6>&#215</h6></div>';
                                echo '<div class="col-8"><h6>1l ' . ucwords($items['drink'][$i]) . '</h6></div>';
                                echo '</div>';
                            }
                        }
                        echo '<div class="row"><div class="col-12"><h5>)</h5></div></div>';
                    }
                    echo '<div class="row"><div class="col-12"><hr class="text-warning bg-warning hr-custom"></div></div><div class="row"><div class="col-8"><h5>Price</h5></div><div class="col-4"><h5 class="text-right">&pound;' . $details['total_price'] . '</h5></div></div><div class="row"><div class="col-6 text-right">';
                    $hidden = ['new_order' => json_encode($details)];
                    $con_btn_attributes = [
                        'class' => 'btn btn-success',
                    ];
                    echo form_open('order/', '', $hidden);
                    echo form_submit('confirm_order_btn', 'Confirm', $con_btn_attributes);
                    echo '</div>';
                    $can_btn_attributes = [
                        'class' => 'btn btn-danger',
                    ];
                    echo  '<div class="col-6">';
                    echo form_submit('confirm_order_btn', 'Cancel', $can_btn_attributes);
                    echo '</div>';
                    echo form_close();
                    echo '</div>';
                } else if (count($data['orders']) > 0) {
                    echo '<div class="row mt-5"><div class="col-12 text-center">';
                    $chk_btn_attributes = [
                        'class' => 'btn btn-success',
                    ];
                    echo form_open('order/checkout');
                    echo form_submit('chk_order_btn', 'Checkout', $chk_btn_attributes);
                    echo '</div>';
                    echo form_close() . '</div></div>';
                }
                ?>
            </div>
        </div>
    </div>
</body>