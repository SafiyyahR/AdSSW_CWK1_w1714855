<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<!DOCtype html>
<html lang="en">

<body class="text-white">
    <div class="container w-100 text-white" id='custom_content'>
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
        $attributes = array('class' => 'order_form form-control', 'id' => 'make_order_form');
        $add_to_cart_attr_pizz = [
            'class' => 'btn btn-success w-100'
        ];
        $add_to_cart_attr = [
            'class' => 'btn btn-success my-3 w-100'
        ];
        foreach ($data as $table_name => $table_data) {
            if ($table_name != 'toppings' && $table_name != 'combo_meals') {
                echo '<h1 id="' . $table_name . '">' . ucwords($table_name) . '</h1>';
            } else if ($table_name == 'combo_meals') {
                echo '<h1 id="deals">Combo Meal Deals</h1>';
            }
            switch ($table_name) {
                case 'pizza':
                    echo '<div class="row">';
                    //echo json_encode($table_data[0]['pizza_id']);
                    for ($i = 0; $i < count($table_data); $i++) {
                        echo '<div class="col-12 col-md-6 col-lg-4">';
                        $attributes = ['class' => 'pizza_form', 'id' => 'pizza_form_' . $table_data[$i]['pizza_id']];
                        $hidden = ['new_type' => 'pizza', 'new_id' => $table_data[$i]['pizza_id']];
                        echo form_open('order/view_basket', $attributes, $hidden);
                        echo '<h4>' . $table_data[$i]['pizza_name'] . '</h4>';
                        $options = array(
                            'small'         => 'Small Pizza  - &#163;' . $table_data[$i]['pizza_pr_small'],
                            'medium'          => 'Medium Pizza - &#163;' . $table_data[$i]['pizza_pr_medium'],
                            'large'        => 'Large Pizza - &#163;' . $table_data[$i]['pizza_pr_large']
                        );
                        $js = [
                            'id'       => 'pizza_' . $table_data[$i]['pizza_id'],
                            'class' => 'w-100 form-control'
                        ];
                        // array_push($screen_pizza_price, $table_data[$i]['pizza_pr_small']);
                        echo form_dropdown('new_size', $options, 'small', $js);
                        $btn_attr = [
                            'id' => 'customise_topping_btn_' . $i,
                            'onClick' => 'toggleToppingsBtn(' . $i . ')',
                            'class' => 'btn btn-light my-3 w-100 w-100'
                        ];
                        echo form_button('customise_topping_btn_' . $i, 'Add Toppings', $btn_attr) . '<br>';
                        echo '<div class="pizza_topping_btns" id="pizza_topping_btn_' . $i . '">';
                        for ($j = 0; $j < count($data['toppings']); $j++) {
                            $topping_data = $data['toppings'][$j];
                            $toppings = array(
                                'name'          => 'new_topping_' . $j,
                                'id'            => 'new_topping_' . $j,
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
                        echo '</div>';
                    }
                    echo '</div>';
                    break;
                case 'sides':
                    echo '<div class="row">';
                    for ($i = 0; $i < count($table_data); $i++) {
                        $attributes = ['class' => 'side_form', 'id' => 'side_form_' . $table_data[$i]['side_id']];
                        $hidden = ['new_type' => 'side', 'new_id' => $table_data[$i]['side_id']];
                        echo '<div class="col-12 col-md-6 col-lg-4">';
                        echo form_open('order/view_basket', $attributes, $hidden);
                        echo '<h3>' . $table_data[$i]['side_name'] . '</h3>';
                        echo '<div class="row">';
                        echo '<div class="col-12 col-md-6 m-auto w-100 p-0">';
                        echo '<h3 class="">&#163;' . $table_data[$i]['side_price'] . '</h3></div>';
                        echo '<div class="col-12 col-md-6 p-0">';
                        echo form_submit('side_submit_btn',  'Add To Cart', $add_to_cart_attr);
                        echo '</div></div>';
                        echo form_close();
                        echo '</div>';
                    }
                    echo '</div>';
                    break;
                case 'drinks':
                    echo '<div class="row">';
                    for ($i = 0; $i < count($table_data); $i++) {
                        $attributes = ['class' => 'drink_form', 'id' => 'drink_form_' . $table_data[$i]['drink_id']];
                        $hidden = ['new_type' => 'drink', 'new_id' => $table_data[$i]['drink_id']];
                        echo '<div class="col-12 col-md-6 col-lg-4">';
                        echo form_open('order/view_basket', $attributes, $hidden);
                        echo '<h3>' . $table_data[$i]['drink_name'] . '</h3>';
                        echo '<div class="row">';
                        echo '<div class="col-12 col-md-6 m-auto w-100 p-0">';
                        echo '<h3 class="">&#163;' . $table_data[$i]['drink_price'] . '</h3></div>';
                        echo '<div class="col-12 col-md-6 p-0">';
                        echo form_submit('drink_submit_btn',  'Add To Cart', $add_to_cart_attr);
                        echo '</div></div>';
                        echo form_close();
                        echo '</div>';
                    }
                    echo '</div>';
                    break;
                case 'combo_meals':
                    for ($i = 0; $i < count($table_data); $i++) {

                        $attributes = ['class' => 'cm_form', 'id' => 'cm_form_' . $table_data[$i]['cm_id']];
                        $hidden = ['new_type' => 'cm', 'new_id' => $table_data[$i]['cm_id']];
                        echo form_open('order/view_basket', $attributes, $hidden);
                        echo '<div class="row">';
                        echo '<div class="col-12">';
                        echo '<h3>' . $table_data[$i]['cm_name'] . '</h3>';
                        echo '</div></div>';
                        echo '<div class="row"><div class="col-12"><hr class="text-warning bg-warning"></div></div>';
                        echo '<div class="row">';
                        echo '<div class="col-12">';
                        echo '<h4>' . $table_data[$i]['cm_description'] . '</h4>';
                        echo '</div></div>';
                        echo '<div class="row">';
                        for ($k = 0; $k < $table_data[$i]['cm_no_small_pizza']; $k++) {
                            echo '<div class="col-12 col-md-6 col-lg-4">';
                            if ($table_data[$i]['cm_no_small_pizza'] > 1) {
                                echo '<h4>Small Pizza ' . ($k + 1) . '</h4>';
                            } else {
                                echo '<h4>Small Pizza</h4>';
                            }
                            $js = [
                                'id' => 'choose_s_pizza_btn_' . $i . '_' . $k,
                                'onClick' => "toggleChooseOptionBtn('choose_s_pizza_btn_" . $i . '_' . $k . "','choose_s_pizza_div_" . $i . '_' . $k . "')",
                                'class' => 'btn btn-light my-3 w-100'
                            ];
                            echo form_button('choose_s_pizza_btn_' . $i . '_' . $k, 'Choose Option', $js) . '<br>';
                            echo '<div class="choose_options_div" id="choose_s_pizza_div_' . $i . '_' . $k . '">';
                            for ($j = 0; $j < count($data['pizza']); $j++) {
                                $pizza_data = $data['pizza'][$j];
                                $pizza = array(
                                    'name'          => 'new_cm_small_pizza_' . $k,
                                    'id'            => 'new_cm_small_pizza_' . $k,
                                    'value'         => $pizza_data['pizza_name'],
                                    'checked'       => FALSE,
                                    'style'         => 'margin:10px'
                                );
                                echo form_radio($pizza);
                                echo form_label($pizza_data['pizza_name'], 'new_cm_small_pizza_' . $pizza_data['pizza_id']) . '<br>';
                            }

                            echo '</div></div>';
                        }
                        for ($k = 0; $k < $table_data[$i]['cm_no_medium_pizza']; $k++) {
                            echo '<div class="col-12 col-md-6 col-lg-4">';
                            if ($table_data[$i]['cm_no_medium_pizza'] > 1) {
                                echo '<h4>Medium Pizza ' . ($k + 1) . '</h4>';
                            } else {
                                echo '<h4>Medium Pizza</h4>';
                            }
                            $js = [
                                'id' => 'choose_m_pizza_btn_' . $i . '_' . $k,
                                'onClick' => "toggleChooseOptionBtn('choose_m_pizza_btn_" . $i . '_' . $k . "','choose_m_pizza_div_" . $i . '_' . $k . "')",
                                'class' => 'btn btn-light my-3 w-100'
                            ];
                            echo form_button('choose_m_pizza_btn_' . $i . '_' . $k, 'Choose Option', $js) . '<br>';
                            echo '<div class="choose_options_div" id="choose_m_pizza_div_' . $i . '_' . $k . '">';

                            for ($j = 0; $j < count($data['pizza']); $j++) {
                                $pizza_data = $data['pizza'][$j];
                                $pizza = array(
                                    'name'          => 'new_cm_medium_pizza_' . $k,
                                    'id'            => 'new_cm_medium_pizza_' . $k,
                                    'value'         => $pizza_data['pizza_name'],
                                    'checked'       => FALSE,
                                    'style'         => 'margin:10px'
                                );
                                echo form_radio($pizza);
                                echo form_label($pizza_data['pizza_name'], 'new_cm_medium_pizza_' . $pizza_data['pizza_id']) . '<br>';
                            }

                            echo '</div></div>';
                        }
                        for ($k = 0; $k < $table_data[$i]['cm_no_large_pizza']; $k++) {
                            echo '<div class="col-12 col-md-6 col-lg-4">';
                            if ($table_data[$i]['cm_no_large_pizza'] > 1) {
                                echo '<h4>Large Pizza ' . ($k + 1) . '</h4>';
                            } else {
                                echo '<h4>Large Pizza</h4>';
                            }
                            $js = [
                                'id' => 'choose_l_pizza_btn_' . $i . '_' . $k,
                                'onClick' => "toggleChooseOptionBtn('choose_l_pizza_btn_" . $i . '_' . $k . "','choose_l_pizza_div_" . $i . '_' . $k . "')",
                                'class' => 'btn btn-light my-3 w-100'
                            ];
                            echo form_button('choose_l_pizza_btn_' . $i . '_' . $k, 'Choose Option', $js) . '<br>';
                            echo '<div class="choose_options_div" id="choose_l_pizza_div_' . $i . '_' . $k . '">';
                            for ($j = 0; $j < count($data['pizza']); $j++) {
                                $pizza_data = $data['pizza'][$j];
                                $pizza = array(
                                    'name'          => 'new_cm_large_pizza_' . $k,
                                    'id'            => 'new_cm_large_pizza_' . $k,
                                    'value'         => $pizza_data['pizza_name'],
                                    'checked'       => FALSE,
                                    'style'         => 'margin:10px'
                                );
                                echo form_radio($pizza);
                                echo form_label($pizza_data['pizza_name'], 'new_cm_large_pizza_' . $pizza_data['pizza_id']) . '<br>';
                            }

                            echo '</div></div>';
                        }
                        for ($k = 0; $k < $table_data[$i]['cm_no_side']; $k++) {
                            echo '<div class="col-12 col-md-6 col-lg-4">';
                            if ($table_data[$i]['cm_no_side'] > 1) {
                                echo '<h4>Side ' . ($k + 1) . '</h4>';
                            } else {
                                echo '<h4>Side</h4>';
                            }
                            $js = [
                                'id' => 'choose_side_btn_' . $i . '_' . $k,
                                'onClick' => "toggleChooseOptionBtn('choose_side_btn_" . $i . '_' . $k . "','choose_side_div_" . $i . '_' . $k . "')",
                                'class' => 'btn btn-light my-3 w-100'
                            ];
                            echo form_button('choose_side_btn_' . $i . '_' . $k, 'Choose Option', $js) . '<br>';
                            echo '<div class="choose_options_div" id="choose_side_div_' . $i . '_' . $k . '">';
                            for ($j = 0; $j < count($data['sides']); $j++) {
                                $side_data = $data['sides'][$j];
                                $side = array(
                                    'name'          => 'new_cm_side_' . $k,
                                    'id'            => 'new_cm_side_' . $k,
                                    'value'         => $side_data['side_name'],
                                    'checked'       => FALSE,
                                    'style'         => 'margin:10px'
                                );
                                echo form_radio($side);
                                echo form_label($side_data['side_name'], 'new_cm_side_' . $side_data['side_id']) . '<br>';
                            }

                            echo '</div></div>';
                        }

                        for ($k = 0; $k < $table_data[$i]['cm_no_drink']; $k++) {
                            echo '<div class="col-12 col-md-6 col-lg-4">';
                            if ($table_data[$i]['cm_no_drink'] > 1) {
                                echo '<h4>Drink ' . ($k + 1) . '</h4>';
                            } else {
                                echo '<h4>Drink</h4>';
                            }

                            $js = [
                                'id' => 'choose_s_drink_btn_' . $i . '_' . $k,
                                'onClick' => "toggleChooseOptionBtn('choose_drink_btn_" . $i . '_' . $k . "','choose_drink_div_" . $i . '_' . $k . "')",
                                'class' => 'btn btn-light my-3 w-100'
                            ];
                            echo form_button('choose_drink_btn_' . $i . '_' . $k, 'Choose Option', $js) . '<br>';
                            echo '<div class="choose_options_div" id="choose_drink_div_' . $i . '_' . $k . '">';

                            for ($j = 0; $j < count($data['drinks']); $j++) {
                                $drink_data = $data['drinks'][$j];
                                $drink = array(
                                    'name'          => 'new_cm_drink_' . $k,
                                    'id'            => 'new_cm_drink_' . $k,
                                    'value'         => $drink_data['drink_name'],
                                    'checked'       => FALSE,
                                    'style'         => 'margin:10px'
                                );
                                echo form_radio($drink);
                                echo form_label($drink_data['drink_name'], 'new_cm_drink_' . $drink_data['drink_id']) . '<br>';
                            }
                            echo '</div></div>';
                        }
                        $js = [
                            'id' => 'cm_submit_btn_' . $i,
                            'class' => 'btn btn-success my-3 w-100'
                        ];
                        echo '</div>';
                        echo '<div class="row">
                        <div class="col-12 col-md-6 col-lg-4 offset-lg-4">';
                        echo form_submit('cm_submit_btn',  'Add To Cart', $js);
                        echo '</div></div>';
                        echo form_close();
                    }
                    break;
            }
        }
        ?>
    </div>
</body>

</html>