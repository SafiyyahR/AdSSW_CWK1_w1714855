<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">

<body class="text-white">
    <div class="container w-100 text-white">
        <div class="row w-100">
            <h1 class="text-center w-100">Order Now</h1>
        </div>
        <?php
        $attributes = array('class' => 'order_form', 'id' => 'take_order_form');
        foreach ($data as $table_name => $table_data) {
            echo '<h1>' . ucwords($table_name) . '</h1>';
            $screen_pizza_price = array();
            $screen_side_price = array();
            $screen_drink_price = array();
            switch ($table_name) {
                case 'pizza':
                    //echo json_encode($table_data[0]['pizza_id']);
                    for ($i = 0; $i < count($table_data); $i++) {
                        $attributes = ['class' => 'pizza_form', 'id' => 'pizza_form_' . $table_data[$i]['pizza_id']];
                        $hidden = ['type' => 'pizza', 'id' => $table_data[$i]['pizza_id']];
                        echo json_encode($hidden);
                        echo form_open('order/confirm_order', $attributes, $hidden);
                        echo '<h4>' . $table_data[$i]['pizza_name'] . '</h4>';
                        echo '<h5>' . $table_data[$i]['pizza_description'] . '</h5>';
                        $options = array(
                            'small'         => 'Small Pizza  - &#163;' . $table_data[$i]['pizza_pr_small'],
                            'medium'          => 'Medium Pizza - &#163;' . $table_data[$i]['pizza_pr_medium'],
                            'large'        => 'Large Pizza - &#163;' . $table_data[$i]['pizza_pr_large']
                        );
                        $js = [
                            'id'       => 'pizza_' . $table_data[$i]['pizza_id']
                        ];
                        // array_push($screen_pizza_price, $table_data[$i]['pizza_pr_small']);
                        echo form_dropdown('size', $options, 'small', $js) . '<br>';
                        $js = [
                            'id' => 'customise_topping_btn_' . $i,
                            'onClick' => 'toggleToppingsBtn(' . $i . ')'
                        ];
                        echo form_button('customise_topping_btn_' . $i, 'Add Toppings', $js) . '<br>';
                        echo '<div class="pizza_topping_btns" id="pizza_topping_btn_' . $i . '">';

                        for ($j = 0; $j < count($data['toppings']); $j++) {
                            $topping_data = $data['toppings'][$j];
                            $toppings = array(
                                'name'          => 'topping_' . $j,
                                'id'            => 'topping_' . $j,
                                'value'         => $topping_data['topping_id'],
                                'checked'       => FALSE,
                                'style'         => 'margin:10px',
                            );

                            echo form_checkbox($toppings);
                            echo form_label($topping_data['topping_name'], 'topping' . $topping_data['topping_id']) . '<br>';
                        }
                        echo '</div>';
                        echo form_submit('pizza_submit_btn', 'Add To Cart');
                        echo form_close();
                    }
                    break;
                case 'sides':
                    for ($i = 0; $i < count($table_data); $i++) {
                        echo '<h3>' . $table_data[$i]['side_name'] . '</h3>';
                        echo form_input(['type' => 'number', 'name' => 'side_quantity' . $table_data[$i]['side_id']]);
                        $options = array(
                            'small'         => 'Small Side  - ' . $table_data[$i]['side_pr_small'],
                            'large'         => 'Large Side - ' . $table_data[$i]['side_pr_large']
                        );
                        array_push($screen_side_price, $table_data[$i]['side_pr_small']);
                        echo form_dropdown('side', $options, 'small') . '<br>';
                        $js = 'onClick="some_function()"';
                        echo form_button('side_btn' . $table_data[$i]['side_id'], 'Add to Cart&nbsp;&nbsp;&nbsp;&nbsp;' . $screen_side_price[$i], $js);
                    }
                    break;
                case 'drinks':
                    for ($i = 0; $i < count($table_data); $i++) {
                        echo '<h3>' . $table_data[$i]['drink_name'] . '</h3>';
                        //echo '<h4>' . $table_data[$i]['drink_description'] . '</h4>';
                        echo form_input(['type' => 'number', 'name' => 'drink_quantity' . $table_data[$i]['drink_id']]);
                        $options = array(
                            'small'         => 'Small Drink  - ' . $table_data[$i]['drink_pr_small'],
                            'large'         => 'Large Drink - ' . $table_data[$i]['drink_pr_large']
                        );
                        array_push($screen_drink_price, $table_data[$i]['drink_pr_small']);
                        echo form_dropdown('drink', $options, 'small') . '<br>';
                        $js = 'onClick="some_function()"';
                        echo form_button('drink_btn' . $table_data[$i]['drink_id'], 'Add to Cart&nbsp;&nbsp;&nbsp;&nbsp;' . $screen_drink_price[$i], $js);
                    }
                    break;
                case 'combo_meals':
                    for ($i = 0; $i < count($table_data); $i++) {
                        echo '<h3>' . $table_data[$i]['cm_name'] . '</h3>';
                        echo '<h4>' . $table_data[$i]['cm_description'] . '</h4>';
                        for ($k = 0; $k < $table_data[$i]['cm_no_small_pizza']; $k++) {
                            if ($table_data[$i]['cm_no_small_pizza'] > 1) {
                                echo '<h4>Small Pizza ' . ($k + 1) . '</h4>';
                            } else {
                                echo '<h4>Small Pizza</h4>';
                            }
                            for ($j = 0; $j < count($data['pizza']); $j++) {
                                $pizza_data = $data['pizza'][$j];
                                $pizza = array(
                                    'name'          => 'cm_small_pizza' . $k,
                                    'id'            => 'cm_small_pizza' . $k,
                                    'value'         => $pizza_data['pizza_id'],
                                    'checked'       => FALSE,
                                    'style'         => 'margin:10px'
                                );
                                echo form_radio($pizza);
                                echo form_label($pizza_data['pizza_name'], 'cm_small_pizza' . $pizza_data['pizza_id']) . '<br>';
                            }
                        }
                        for ($k = 0; $k < $table_data[$i]['cm_no_medium_pizza']; $k++) {
                            if ($table_data[$i]['cm_no_medium_pizza'] > 1) {
                                echo '<h4>Medium Pizza ' . ($k + 1) . '</h4>';
                            } else {
                                echo '<h4>Medium Pizza</h4>';
                            }
                            for ($j = 0; $j < count($data['pizza']); $j++) {
                                $pizza_data = $data['pizza'][$j];
                                $pizza = array(
                                    'name'          => 'cm_medium_pizza' . $k,
                                    'id'            => 'cm_medium_pizza' . $k,
                                    'value'         => $pizza_data['pizza_id'],
                                    'checked'       => FALSE,
                                    'style'         => 'margin:10px'
                                );
                                echo form_radio($pizza);
                                echo form_label($pizza_data['pizza_name'], 'cm_medium_pizza' . $pizza_data['pizza_id']) . '<br>';
                            }
                        }
                        for ($k = 0; $k < $table_data[$i]['cm_no_large_pizza']; $k++) {
                            if ($table_data[$i]['cm_no_large_pizza'] > 1) {
                                echo '<h4>Large Pizza ' . ($k + 1) . '</h4>';
                            } else {
                                echo '<h4>Large Pizza</h4>';
                            }
                            for ($j = 0; $j < count($data['pizza']); $j++) {
                                $pizza_data = $data['pizza'][$j];
                                $pizza = array(
                                    'name'          => 'cm_large_pizza' . $k,
                                    'id'            => 'cm_large_pizza' . $k,
                                    'value'         => $pizza_data['pizza_id'],
                                    'checked'       => FALSE,
                                    'style'         => 'margin:10px'
                                );
                                echo form_radio($pizza);
                                echo form_label($pizza_data['pizza_name'], 'cm_large_pizza' . $pizza_data['pizza_id']) . '<br>';
                            }
                        }
                        for ($k = 0; $k < $table_data[$i]['cm_no_small_side']; $k++) {
                            if ($table_data[$i]['cm_no_small_side'] > 1) {
                                echo '<h4>Small Side ' . ($k + 1) . '</h4>';
                            } else {
                                echo '<h4>Small Side</h4>';
                            }
                            for ($j = 0; $j < count($data['sides']); $j++) {
                                $side_data = $data['sides'][$j];
                                $side = array(
                                    'name'          => 'cm_small_side' . $k,
                                    'id'            => 'cm_small_side' . $k,
                                    'value'         => $side_data['side_id'],
                                    'checked'       => FALSE,
                                    'style'         => 'margin:10px'
                                );
                                echo form_radio($side);
                                echo form_label($side_data['side_name'], 'cm_small_side' . $side_data['side_id']) . '<br>';
                            }
                        }
                        for ($k = 0; $k < $table_data[$i]['cm_no_large_side']; $k++) {
                            if ($table_data[$i]['cm_no_large_side'] > 1) {
                                echo '<h4>Large Side ' . ($k + 1) . '</h4>';
                            } else {
                                echo '<h4>Large Side</h4>';
                            }
                            for ($j = 0; $j < count($data['sides']); $j++) {
                                $side_data = $data['sides'][$j];
                                $side = array(
                                    'name'          => 'cm_large_side' . $k,
                                    'id'            => 'cm_large_side' . $k,
                                    'value'         => $side_data['side_id'],
                                    'checked'       => FALSE,
                                    'style'         => 'margin:10px'
                                );
                                echo form_radio($side);
                                echo form_label($side_data['side_name'], 'cm_large_side' . $side_data['side_id']) . '<br>';
                            }
                        }
                        for ($k = 0; $k < $table_data[$i]['cm_no_small_drink']; $k++) {
                            if ($table_data[$i]['cm_no_small_drink'] > 1) {
                                echo '<h4>Small Drink ' . ($k + 1) . '</h4>';
                            } else {
                                echo '<h4>Small Drink</h4>';
                            }
                            for ($j = 0; $j < count($data['drinks']); $j++) {
                                $drink_data = $data['drinks'][$j];
                                $drink = array(
                                    'name'          => 'cm_small_drink' . $k,
                                    'id'            => 'cm_small_drink' . $k,
                                    'value'         => $drink_data['drink_id'],
                                    'checked'       => FALSE,
                                    'style'         => 'margin:10px'
                                );
                                echo form_radio($drink);
                                echo form_label($drink_data['drink_name'], 'cm_small_drink' . $drink_data['drink_id']) . '<br>';
                            }
                        }
                        for ($k = 0; $k < $table_data[$i]['cm_no_large_drink']; $k++) {
                            if ($table_data[$i]['cm_no_large_drink'] > 1) {
                                echo '<h4>Large Drink ' . ($k + 1) . '</h4>';
                            } else {
                                echo '<h4>Large Drink</h4>';
                            }
                            for ($j = 0; $j < count($data['drinks']); $j++) {
                                $drink_data = $data['drinks'][$j];
                                $drink = array(
                                    'name'          => 'cm_large_drink' . $k,
                                    'id'            => 'cm_large_drink' . $k,
                                    'value'         => $drink_data['drink_id'],
                                    'checked'       => FALSE,
                                    'style'         => 'margin:10px'
                                );
                                echo form_radio($drink);
                                echo form_label($drink_data['drink_name'], 'cm_large_drink' . $drink_data['drink_id']) . '<br>';
                            }
                        }
                        $js = 'onClick="some_function()"';
                        echo form_button('cm_btn' . $table_data[$i]['cm_id'], 'Add to Cart&nbsp;&nbsp;&nbsp;&nbsp;' . $table_data[$i]['cm_price'], $js);
                    }
                    break;
            }
        }
        ?>
    </div>
</body>

</html>