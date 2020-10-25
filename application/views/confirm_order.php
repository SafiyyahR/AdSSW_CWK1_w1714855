<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">

<body class="text-white">
    <div class="container w-100 text-white">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1 class="text-center w-100">Confirm Order</h1>
                <h2>Chosen Item</h2>
                <div class='row'>
                    <div class="col-2">1</div>
                    <div class="col-2">&#215</div>
                    <?php
                    if ($details['type'] != 'cm') {
                        echo '<div class="col-5">' . ucwords($details['size'] . ' ' . $details['details']['name']) . '</div>';
                        echo '<div class="col-3">&pound;' . $details['details']['price'] . '</div>';
                        echo '</div>';
                        if ($details['type'] == 'pizza') {
                            if (count($details['topping']) > 0) {
                                echo '<h2>Additional Toppings</h2>';
                                for ($i = 0; $i < count($details['topping']); $i++) {
                                    $topping = $details['topping'][$i];
                                    echo '<div class="row">';
                                    echo '<div class="col-2">1</div>';
                                    echo '<div class="col-2">&#215</div>';
                                    echo '<div class="col-5">' . ucwords($topping['name']) . '</div>';
                                    echo '<div class="col-3">&pound;' . $topping['price'] . '</div>';
                                    echo '</div>';
                                }
                            }
                        }
                    }
                    ?>
                    <div class='row'>
                        <div class="col-8">Total Price</div>
                        <div class="col-4">&pound;<?php echo $details['total_price'] ?></div>
                    </div>
                    <?php
                    $hidden = ['id' => json_encode($details)];
                    echo form_open('order/', '', $hidden);
                    echo form_submit('pizza_submit_btn', 'Confirm');
                    echo form_submit('pizza_submit_btn', 'Cancel');
                    echo form_close();
                    ?>

                </div>
            </div>
        </div>
</body>