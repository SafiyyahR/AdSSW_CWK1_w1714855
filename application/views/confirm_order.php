<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">

<body class="text-white" onload="increaseHeight()" onresize="increaseHeight()">
    <div class="container w-100 text-white mb-5" id="custom_content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1 class="text-center w-100">Confirm Order</h1>
                <div class="row">
                    <div class="col-12">
                        <h3>Chosen Item</h3>
                    </div>
                </div>
                <?php
                if ($details['type'] != 'cm') {
                    echo '<div class="row">
                        <div class="col-2">
                            <h5>1</h5>
                        </div>
                        <div class="col-2">
                            <h5>&#215</h5>
                        </div>';
                    echo '<div class="col-5"><h5>' . ucwords($details['size'] . ' ' . $details['details']['name']) . '</h5></div>';
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
                    echo '<div class="row">
                    <div class="col-2">
                        <h5>1</h5>
                    </div>
                    <div class="col-2">
                        <h5>&#215</h5>
                    </div>';
                    echo '<div class="col-5"><h5>' . $details['name'] . ' includes (</h5></div>';
                    echo '<div class="col-3"><h5 class="text-right">&pound;' . $details['total_price'] . '</div>';
                    echo '</div>';
                    $items = $details['items'];
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
                    if (isset($items['small_side'])) {
                        for ($i = 0; $i < count($items['small_side']); $i++) {
                            echo '<div class="row">';
                            echo '<div class="col-2"><h6>1</h6></div>';
                            echo '<div class="col-2"><h6>&#215</h6></div>';
                            echo '<div class="col-8"><h6>Small ' . ucwords($items['small_side'][$i]) . '</h6></div>';
                            echo '</div>';
                        }
                    }

                    if (isset($items['large_side'])) {
                        for ($i = 0; $i < count($items['large_side']); $i++) {
                            echo '<div class="row">';
                            echo '<div class="col-2"><h6>1</h6></div>';
                            echo '<div class="col-2"><h6>&#215</h6></div>';
                            echo '<div class="col-8"><h6>Large ' . ucwords($items['large_side'][$i]) . '</h6></div>';
                            echo '</div>';
                        }
                    }
                    if (isset($items['small_drink'])) {
                        for ($i = 0; $i < count($items['small_drink']); $i++) {
                            echo '<div class="row">';
                            echo '<div class="col-2"><h6>1</h6></div>';
                            echo '<div class="col-2"><h6>&#215</h6></div>';
                            echo '<div class="col-8"><h6>Small ' . ucwords($items['small_drink'][$i]) . '</h6></div>';
                            echo '</div>';
                        }
                    }

                    if (isset($items['large_drink'])) {
                        for ($i = 0; $i < count($items['large_drink']); $i++) {
                            echo '<div class="row">';
                            echo '<div class="col-2"><h6>1</h6></div>';
                            echo '<div class="col-2"><h6>&#215</h6></div>';
                            echo '<div class="col-8"><h6>Large ' . ucwords($items['large_drink'][$i]) . '</h6></div>';
                            echo '</div>';
                        }
                    }
                    echo '<div class="row"><div class="col-12"><h5>)</h5></div></div>';
                }

                ?>
                <div class="row">
                    <div class="col-12">
                        <hr class="text-warning bg-warning hr-custom">
                    </div>
                </div>
                <div class='row'>
                    <div class="col-8">
                        <h5>Total Price</h5>
                    </div>
                    <div class="col-4">
                        <h5 class="text-right">&pound;<?php echo $details['total_price'] ?></h5>
                    </div>
                </div>
                <div class='row'>
                    <div class="col-6 text-right">
                        <?php
                        $hidden = ['order' => json_encode($details)];
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
                        ?>
                    </div>
                </div>
            </div>
        </div>
</body>