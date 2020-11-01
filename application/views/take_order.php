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
        <div>
            <ul class="nav justify-content-center h4">
                <li class="nav-item">
                    <a class="nav-link" href="#pizza">Pizza</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#sides">Sides</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#drinks">Drinks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#deals">Deals</a>
                </li>
            </ul>
        </div>
        <?php
        $attributes = array('class' => 'order_form form-control', 'id' => 'take_order_form');
        $add_to_cart_attr_pizz = [
            'class' => 'btn btn-success'
        ];
        $add_to_cart_attr = [
            'class' => 'btn btn-success my-3'
        ];
        foreach ($data as $table_name => $table_data) {
            if ($table_name != 'toppings' && $table_name != 'combo_meals') {
                echo '<h1 id="' . $table_name . '">' . ucwords($table_name) . '</h1>';
            } else if ($table_name == 'combo_meals') {
                echo '<h1 id="deals">Combo Meal Deals</h1>';
            }
            switch ($table_name) {
                case 'pizza':
                    //echo json_encode($table_data[0]['pizza_id']);
                    for ($i = 0; $i < count($table_data); $i++) {
                        $attributes = ['class' => 'pizza_form', 'id' => 'pizza_form_' . $table_data[$i]['pizza_id']];
                        $hidden = ['type' => 'pizza', 'id' => $table_data[$i]['pizza_id']];
                        echo form_open('order/confirm_order', $attributes, $hidden);
                        echo '<h4>' . $table_data[$i]['pizza_name'] . '</h4>';
                        echo '<h5>' . $table_data[$i]['pizza_description'] . '</h5>';
                        $options = array(
                            'small'         => 'Small Pizza  - &#163;' . $table_data[$i]['pizza_pr_small'],
                            'medium'          => 'Medium Pizza - &#163;' . $table_data[$i]['pizza_pr_medium'],
                            'large'        => 'Large Pizza - &#163;' . $table_data[$i]['pizza_pr_large']
                        );
                        $js = [
                            'id'       => 'pizza_' . $table_data[$i]['pizza_id'],
                            'class' => ''
                        ];
                        // array_push($screen_pizza_price, $table_data[$i]['pizza_pr_small']);
                        echo form_dropdown('size', $options, 'small', $js) . '<br>';
                        $btn_attr = [
                            'id' => 'customise_topping_btn_' . $i,
                            'onClick' => 'toggleToppingsBtn(' . $i . ')',
                            'class' => 'btn btn-light my-3'
                        ];
                        echo form_button('customise_topping_btn_' . $i, 'Add Toppings', $btn_attr) . '<br>';
                        echo '<div class="pizza_topping_btns" id="pizza_topping_btn_' . $i . '">';
                        for ($j = 0; $j < count($data['toppings']); $j++) {
                            $topping_data = $data['toppings'][$j];
                            $toppings = array(
                                'name'          => 'topping_' . $j,
                                'id'            => 'topping_' . $j,
                                'value'         => $topping_data['topping_id'],
                                'checked'       => FALSE,
                                'style'         => 'margin:10px'
                            );

                            echo form_checkbox($toppings);
                            echo form_label($topping_data['topping_name'], 'topping' . $topping_data['topping_id']) . '<br>';
                        }
                        echo '</div>';
                        echo form_submit('pizza_submit_btn',  'Add To Cart', $add_to_cart_attr_pizz);
                        echo form_close();
                    }
                    break;
                case 'sides':
                    for ($i = 0; $i < count($table_data); $i++) {
                        $attributes = ['class' => 'side_form', 'id' => 'side_form_' . $table_data[$i]['side_id']];
                        $hidden = ['type' => 'side', 'id' => $table_data[$i]['side_id']];
                        echo form_open('order/confirm_order', $attributes, $hidden);
                        echo '<h3>' . $table_data[$i]['side_name'] . '</h3>';
                        $options = array(
                            'small'         => 'Small Side  - ' . $table_data[$i]['side_pr_small'],
                            'large'         => 'Large Side - ' . $table_data[$i]['side_pr_large']
                        );
                        $js = [
                            'id'       => 'side_' . $table_data[$i]['side_id'],
                            'class' => ''
                        ];
                        echo form_dropdown('size', $options, 'small', $js) . '<br>';
                        echo form_submit('side_submit_btn',  'Add To Cart', $add_to_cart_attr);
                        echo form_close();
                    }
                    break;
                case 'drinks':
                    for ($i = 0; $i < count($table_data); $i++) {
                        $attributes = ['class' => 'drink_form', 'id' => 'drink_form_' . $table_data[$i]['drink_id']];
                        $hidden = ['type' => 'drink', 'id' => $table_data[$i]['drink_id']];
                        echo form_open('order/confirm_order', $attributes, $hidden);
                        echo '<h3>' . $table_data[$i]['drink_name'] . '</h3>';
                        $options = array(
                            'small'         => 'Small Drink  - ' . $table_data[$i]['drink_pr_small'],
                            'large'         => 'Large Drink - ' . $table_data[$i]['drink_pr_large']
                        );
                        $js = [
                            'id'       => 'drink_' . $table_data[$i]['drink_id'],
                            'class' => ''
                        ];
                        echo form_dropdown('size', $options, 'small', $js) . '<br>';
                        echo form_submit('drink_submit_btn',  'Add To Cart', $add_to_cart_attr);
                        echo form_close();
                    }
                    break;
                case 'combo_meals':
                    for ($i = 0; $i < count($table_data); $i++) {
                        $attributes = ['class' => 'cm_form', 'id' => 'cm_form_' . $table_data[$i]['cm_id']];
                        $hidden = ['type' => 'cm', 'id' => $table_data[$i]['cm_id']];
                        echo form_open('order/confirm_order', $attributes, $hidden);
                        echo '<h3>' . $table_data[$i]['cm_name'] . '</h3>';
                        echo '<h4>' . $table_data[$i]['cm_description'] . '</h4>';
                        for ($k = 0; $k < $table_data[$i]['cm_no_small_pizza']; $k++) {
                            if ($table_data[$i]['cm_no_small_pizza'] > 1) {
                                echo '<h4>Small Pizza ' . ($k + 1) . '</h4>';
                            } else {
                                echo '<h4>Small Pizza</h4>';
                            }
                            $js = [
                                'id' => 'choose_s_pizza_btn_' . $i . '_' . $k,
                                'onClick' => "toggleChooseOptionBtn('choose_s_pizza_btn_" . $i . '_' . $k . "','choose_s_pizza_div_" . $i . '_' . $k . "')",
                                'class' => 'btn btn-light my-3'
                            ];
                            echo form_button('choose_s_pizza_btn_' . $i . '_' . $k, 'Choose Option', $js) . '<br>';
                            echo '<div class="choose_options_div" id="choose_s_pizza_div_' . $i . '_' . $k . '">';
                            for ($j = 0; $j < count($data['pizza']); $j++) {
                                $pizza_data = $data['pizza'][$j];
                                $pizza = array(
                                    'name'          => 'cm_small_pizza_' . $k,
                                    'id'            => 'cm_small_pizza_' . $k,
                                    'value'         => $pizza_data['pizza_name'],
                                    'checked'       => FALSE,
                                    'style'         => 'margin:10px'
                                );
                                echo form_radio($pizza);
                                echo form_label($pizza_data['pizza_name'], 'cm_small_pizza_' . $pizza_data['pizza_id']) . '<br>';
                            }

                            echo '</div>';
                        }
                        for ($k = 0; $k < $table_data[$i]['cm_no_medium_pizza']; $k++) {
                            if ($table_data[$i]['cm_no_medium_pizza'] > 1) {
                                echo '<h4>Medium Pizza ' . ($k + 1) . '</h4>';
                            } else {
                                echo '<h4>Medium Pizza</h4>';
                            }
                            $js = [
                                'id' => 'choose_m_pizza_btn_' . $i . '_' . $k,
                                'onClick' => "toggleChooseOptionBtn('choose_m_pizza_btn_" . $i . '_' . $k . "','choose_m_pizza_div_" . $i . '_' . $k . "')",
                                'class' => 'btn btn-light my-3'
                            ];
                            echo form_button('choose_m_pizza_btn_' . $i . '_' . $k, 'Choose Option', $js) . '<br>';
                            echo '<div class="choose_options_div" id="choose_m_pizza_div_' . $i . '_' . $k . '">';

                            for ($j = 0; $j < count($data['pizza']); $j++) {
                                $pizza_data = $data['pizza'][$j];
                                $pizza = array(
                                    'name'          => 'cm_medium_pizza_' . $k,
                                    'id'            => 'cm_medium_pizza_' . $k,
                                    'value'         => $pizza_data['pizza_name'],
                                    'checked'       => FALSE,
                                    'style'         => 'margin:10px'
                                );
                                echo form_radio($pizza);
                                echo form_label($pizza_data['pizza_name'], 'cm_medium_pizza_' . $pizza_data['pizza_id']) . '<br>';
                            }

                            echo '</div>';
                        }
                        for ($k = 0; $k < $table_data[$i]['cm_no_large_pizza']; $k++) {
                            if ($table_data[$i]['cm_no_large_pizza'] > 1) {
                                echo '<h4>Large Pizza ' . ($k + 1) . '</h4>';
                            } else {
                                echo '<h4>Large Pizza</h4>';
                            }
                            $js = [
                                'id' => 'choose_l_pizza_btn_' . $i . '_' . $k,
                                'onClick' => "toggleChooseOptionBtn('choose_l_pizza_btn_" . $i . '_' . $k . "','choose_l_pizza_div_" . $i . '_' . $k . "')",
                                'class' => 'btn btn-light my-3'
                            ];
                            echo form_button('choose_l_pizza_btn_' . $i . '_' . $k, 'Choose Option', $js) . '<br>';
                            echo '<div class="choose_options_div" id="choose_l_pizza_div_' . $i . '_' . $k . '">';
                            for ($j = 0; $j < count($data['pizza']); $j++) {
                                $pizza_data = $data['pizza'][$j];
                                $pizza = array(
                                    'name'          => 'cm_large_pizza_' . $k,
                                    'id'            => 'cm_large_pizza_' . $k,
                                    'value'         => $pizza_data['pizza_name'],
                                    'checked'       => FALSE,
                                    'style'         => 'margin:10px'
                                );
                                echo form_radio($pizza);
                                echo form_label($pizza_data['pizza_name'], 'cm_large_pizza_' . $pizza_data['pizza_id']) . '<br>';
                            }

                            echo '</div>';
                        }
                        for ($k = 0; $k < $table_data[$i]['cm_no_small_side']; $k++) {
                            if ($table_data[$i]['cm_no_small_side'] > 1) {
                                echo '<h4>Small Side ' . ($k + 1) . '</h4>';
                            } else {
                                echo '<h4>Small Side</h4>';
                            }
                            $js = [
                                'id' => 'choose_s_side_btn_' . $i . '_' . $k,
                                'onClick' => "toggleChooseOptionBtn('choose_s_side_btn_" . $i . '_' . $k . "','choose_s_side_div_" . $i . '_' . $k . "')",
                                'class' => 'btn btn-light my-3'
                            ];
                            echo form_button('choose_s_side_btn_' . $i . '_' . $k, 'Choose Option', $js) . '<br>';
                            echo '<div class="choose_options_div" id="choose_s_side_div_' . $i . '_' . $k . '">';
                            for ($j = 0; $j < count($data['sides']); $j++) {
                                $side_data = $data['sides'][$j];
                                $side = array(
                                    'name'          => 'cm_small_side_' . $k,
                                    'id'            => 'cm_small_side_' . $k,
                                    'value'         => $side_data['side_name'],
                                    'checked'       => FALSE,
                                    'style'         => 'margin:10px'
                                );
                                echo form_radio($side);
                                echo form_label($side_data['side_name'], 'cm_small_side_' . $side_data['side_id']) . '<br>';
                            }

                            echo '</div>';
                        }
                        for ($k = 0; $k < $table_data[$i]['cm_no_large_side']; $k++) {
                            if ($table_data[$i]['cm_no_large_side'] > 1) {
                                echo '<h4>Large Side ' . ($k + 1) . '</h4>';
                            } else {
                                echo '<h4>Large Side</h4>';
                            }
                            $js = [
                                'id' => 'choose_l_side_btn_' . $i . '_' . $k,
                                'onClick' => "toggleChooseOptionBtn('choose_l_side_btn_" . $i . '_' . $k . "','choose_l_side_div_" . $i . '_' . $k . "')",
                                'class' => 'btn btn-light my-3'
                            ];
                            echo form_button('choose_l_side_btn_' . $i . '_' . $k, 'Choose Option', $js) . '<br>';
                            echo '<div class="choose_options_div" id="choose_l_side_div_' . $i . '_' . $k . '">';
                            for ($j = 0; $j < count($data['sides']); $j++) {
                                $side_data = $data['sides'][$j];
                                $side = array(
                                    'name'          => 'cm_large_side_' . $k,
                                    'id'            => 'cm_large_side_' . $k,
                                    'value'         => $side_data['side_name'],
                                    'checked'       => FALSE,
                                    'style'         => 'margin:10px'
                                );
                                echo form_radio($side);
                                echo form_label($side_data['side_name'], 'cm_large_side_' . $side_data['side_id']) . '<br>';
                            }

                            echo '</div>';
                        }
                        for ($k = 0; $k < $table_data[$i]['cm_no_small_drink']; $k++) {
                            if ($table_data[$i]['cm_no_small_drink'] > 1) {
                                echo '<h4>Small drink ' . ($k + 1) . '</h4>';
                            } else {
                                echo '<h4>Small drink</h4>';
                            }

                            $js = [
                                'id' => 'choose_s_drink_btn_' . $i . '_' . $k,
                                'onClick' => "toggleChooseOptionBtn('choose_s_drink_btn_" . $i . '_' . $k . "','choose_s_drink_div_" . $i . '_' . $k . "')",
                                'class' => 'btn btn-light my-3'
                            ];
                            echo form_button('choose_s_drink_btn_' . $i . '_' . $k, 'Choose Option', $js) . '<br>';
                            echo '<div class="choose_options_div" id="choose_s_drink_div_' . $i . '_' . $k . '">';

                            for ($j = 0; $j < count($data['drinks']); $j++) {
                                $drink_data = $data['drinks'][$j];
                                $drink = array(
                                    'name'          => 'cm_small_drink_' . $k,
                                    'id'            => 'cm_small_drink_' . $k,
                                    'value'         => $drink_data['drink_name'],
                                    'checked'       => FALSE,
                                    'style'         => 'margin:10px'
                                );
                                echo form_radio($drink);
                                echo form_label($drink_data['drink_name'], 'cm_small_drink_' . $drink_data['drink_id']) . '<br>';
                            }

                            echo '</div>';
                        }
                        for ($k = 0; $k < $table_data[$i]['cm_no_large_drink']; $k++) {
                            if ($table_data[$i]['cm_no_large_drink'] > 1) {
                                echo '<h4>Large drink ' . ($k + 1) . '</h4>';
                            } else {
                                echo '<h4>Large drink</h4>';
                            }
                            $js = [
                                'id' => 'choose_l_drink_btn_' . $i . '_' . $k,
                                'onClick' => "toggleChooseOptionBtn('choose_l_drink_btn_" . $i . '_' . $k . "','choose_l_drink_div_" . $i . '_' . $k . "')",
                                'class' => 'btn btn-light my-3'
                            ];
                            echo form_button('choose_l_drink_btn_' . $i . '_' . $k, 'Choose Option', $js) . '<br>';
                            echo '<div class="choose_options_div" id="choose_l_drink_div_' . $i . '_' . $k . '">';

                            for ($j = 0; $j < count($data['drinks']); $j++) {
                                $drink_data = $data['drinks'][$j];
                                $drink = array(
                                    'name'          => 'cm_large_drink_' . $k,
                                    'id'            => 'cm_large_drink_' . $k,
                                    'value'         => $drink_data['drink_name'],
                                    'checked'       => FALSE,
                                    'style'         => 'margin:10px'
                                );
                                echo form_radio($drink);
                                echo form_label($drink_data['drink_name'], 'cm_large_drink_' . $drink_data['drink_id']) . '<br>';
                            }

                            echo '</div>';
                        }
                        $js = [
                            'id' => 'cm_submit_btn_' . $i,
                            'class' => 'btn btn-success my-3'
                        ];
                        echo form_submit('cm_submit_btn',  'Add To Cart', $js);
                        echo form_close();
                    }
                    break;
            }
        }
        ?>
    </div>
</body>

</html>