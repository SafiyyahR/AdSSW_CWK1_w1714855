<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">

<body class="text-white" onload="increaseHeight()" onresize="increaseHeight()">
    <div class="container w-100 text-white mb-5" id="custom_content">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h1 class="text-center w-100">Enter Your Details</h1>
                <?php
                $hidden = ['del_session' => 'true'];
                $place_order_attributes = [
                    'class' => 'btn btn-success text-center',
                ];
                $label_attr = [
                    'class' => 'h4',
                ];
                $attributes = array(
                    'First Name' => array(
                        'id' => 'fname',
                        'name' => 'fname',
                        'placeholder'         => 'Safiyyah',
                        'maxlength'     => '100',
                        'required' => true,
                        'style' => 'margin-left:10px; width:100%;height:100%'
                    ),
                    'Last Name' => array(
                        'id' => 'lname',
                        'name' => 'lname',
                        'placeholder'         => 'Thur Rahman',
                        'maxlength'     => '100',
                        'required' => true,
                        'style' => 'margin-left:10px; width:100%;height:100%'
                    ),
                    'Flat or house number' => array(
                        'id' => 'house_no',
                        'name' => 'house_no',
                        'placeholder'         => '74',
                        'maxlength'     => '20',
                        'required' => true,
                        'style' => 'margin-left:10px; width:100%;height:100%'
                    ),
                    'Business or building name' => array(
                        'id' => 'business',
                        'name' => 'business',
                        'placeholder' => 'The Hub',
                        'maxlength'     => '350',
                        'required' => false,
                        'style' => 'margin-left:10px; width:100%;height:100%'
                    ),
                    'Street Address' => array(
                        'id' => 'street_add',
                        'name' => 'street_add',
                        'placeholder'         => 'Locket Road',
                        'maxlength'     => '350',
                        'required' => true,
                        'style' => 'margin-left:10px; width:100%;height:100%'
                    ),
                    'Postcode' => array(
                        'id' => 'postcode',
                        'name' => 'postcode',
                        'placeholder'         => 'HA3 7NL',
                        'maxlength'     => '7',
                        'required' => true,
                        'style' => 'margin-left:10px; width:100%;height:100%'
                    ),
                    'Phone Number' => array(
                        'id' => 'phone_no',
                        'name' => 'phone_no',
                        'placeholder'         => '0734553123',
                        'maxlength'     => '10',
                        'required' => true,
                        'style' => 'margin-left:10px; width:100%;height:100%'
                    ),
                );

                echo form_open('order/order_complete', '', $hidden);
                foreach ($attributes as $key => $value) {
                    if ('Flat or house number' == $key) {
                        echo '<div class="row mt-3"><div class="col-12"><h2>Delivery Address</h2></div></div>';
                    }
                    echo '<div class="row my-2">';
                    echo '<div class="col-6">';
                    echo form_label($key, $value['id'], $label_attr);
                    echo '</div><div class="col-6 text-right">';
                    echo form_input($value) . '<br/>';
                    echo '</div></div>';
                }
                echo '<div class="row w-100 text-center mt-5"><div class="col-12">' . form_submit('place_order_btn', 'Place Order', $place_order_attributes) . '</div></div>' . form_close(); ?>
            </div>
        </div>
    </div>
</body>